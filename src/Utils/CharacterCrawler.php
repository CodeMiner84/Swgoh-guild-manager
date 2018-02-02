<?php

namespace App\Utils;

use App\Entity\Character;
use App\Entity\Guild;
use App\Entity\Setting;
use App\Entity\User;
use App\Factory\CharacterFactory;
use App\Factory\UserFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class CharacterCrawler
 * @package App\Utils
 */
class CharacterCrawler extends BaseCrawler implements CrawlerInterface
{
    public function crawl()
    {
        $crawler = new Crawler($this->getSiteHtml($this->settings->getApi()));
        $this->fetchCharacters($crawler->filter('li.character'));
    }

    private function removeCharacters(): void
    {
        $this->em->getRepository(Character::class)->remove();
    }

    /**
     * @param Guild $guild
     * @param array $domList
     */
    private function fetchCharacters( $dom): void
    {
        $this->removeCharacters();
        /** @var \DOMElement $item */
        foreach ($dom as $key => $domElement) {
            if ($key > 1) {
                $html = $domElement->ownerDocument->saveHTML($domElement);
                $liCrawler = new Crawler($html);

                $side = explode("·", $liCrawler->filter('.media-heading > small > span')->html());
                preg_match("/\/characters\/(.*)\//", $liCrawler->filter('a')->getNode(0)->getAttribute('href'), $matches);

                $character = CharacterFactory::create([
                    'code' => $matches[1],
                    'name' => $domElement->getAttribute('data-name-lower'),
                    'description' => strip_tags($liCrawler->filter('p.character-description')->html()),
                    'side' => 'Light Side' === trim($side[0]) ? 1 : 0,
                    'image' => $liCrawler->filter('img.char-portrait-img')->getNode(0)->getAttribute('src'),
                ]);

                $this->em->persist($character);
            }
        }
        $this->em->flush();
    }
}
