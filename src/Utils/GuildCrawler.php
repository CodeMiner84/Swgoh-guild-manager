<?php

namespace App\Utils;

use App\Entity\Character;
use App\Entity\Guild;
use App\Entity\Setting;
use App\Factory\CharacterFactory;
use App\Factory\GuildFactory;
use App\Repository\RepositoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class GuildCrawler
 */
class GuildCrawler extends BaseCrawler implements CrawlerInterface
{
    public function crawl()
    {
        $this->collectGuildsDOM($this->settings->getApi().$this->settings->getGuildSuffix(), 36);

        $this->removeGuilds();

        foreach ($this->buffer as $collectionHtml) {
            $crawler = new Crawler($collectionHtml);
            preg_match('/\/g\/(\d+)\/(.*)\//', $crawler->filter('a')->getNode(0)->getAttribute('href'), $match);

            $guild = GuildFactory::create([
                'name' => $crawler->filter('h3')->text(),
                'uuid' => $match[1],
                'code' => $match[2]
            ]);

            $this->em->persist($guild);
        }
        $this->em->flush();
    }

    private function removeGuilds(): void
    {
        $this->em->getRepository(Guild::class)->remove();
    }


    /**
     * @param string $url
     * @param int $page
     */
    private function collectGuildsDOM(string $url, $page = 1): void
    {
        $this->iter ++;
        try {
            $crawler = new Crawler($this->getSiteHtml(sprintf("%s?page=%s", $url, $page)));
            $domElements = $crawler->filter('ul.list-group li.character');

            if (count($domElements) > 0) {
                foreach ($domElements as $domElement) {
                    $this->buffer[] = $domElement->ownerDocument->saveHTML($domElement);
                }
                $this->collectGuildsDOM($url, ++$page);
            }
        } catch (\Exception $e) {

        }
    }

    /**
     * @param Guild $guild
     * @param array $domList
     */
    private function fetchGuilds( $dom): void
    {
        die("A");
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

    private function removeCharacters(): void
    {
        $this->em->getRepository(Character::class)->remove();
    }
}
