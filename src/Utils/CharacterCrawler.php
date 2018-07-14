<?php

namespace App\Utils;

use App\Entity\Character;
use App\Entity\Guild;
use App\Factory\CharacterFactory;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class CharacterCrawler.
 */
class CharacterCrawler extends BaseCrawler implements CrawlerInterface
{
    public function crawl(): void
    {
        $crawler = new Crawler($this->getSiteHtml($this->settings->getApi()));
        $this->fetchCharacters($crawler->filter('li.character'));
    }

    /**
     * @param string $code
     * @return Character|null
     */
    private function checkCharacter(string $code): ?Character
    {
        return $this->em->getRepository(Character::class)->findOneByCode($code);
    }

    /**
     * @param string $code
     * @param array $data
     */
    private function update(string $code, array $data): void
    {
        $this->em->getRepository(Character::class)->update($code, $data);
    }

    /**
     * @param Guild $guild
     * @param array $domList
     */
    private function fetchCharacters($dom): void
    {
        /* @var \DOMElement $item */
        foreach ($dom as $key => $domElement) {
            $html = $domElement->ownerDocument->saveHTML($domElement);
            $liCrawler = new Crawler($html);

            $side = explode('·', $liCrawler->filter('.media-heading > small > span')->html());
            $tags = $liCrawler->filter('.media-heading > small')->text();
            preg_match("/\/characters\/(.*)\//", $liCrawler->filter('a')->getNode(0)->getAttribute('href'), $matches);

            $originalImagePath = preg_replace('/^\/\//', 'http://', $liCrawler->filter('img.char-portrait-img')->getNode(0)->getAttribute('data-src'));
            $characterImageName = preg_replace('/^tex\.charui_/', '', basename($originalImagePath));
            $this->uploadCharacterImage($originalImagePath, $characterImageName);

            if ($this->checkCharacter($matches[1])) {
                $this->update($matches[1], [
                    'name' => $domElement->getAttribute('data-name-lower'),
                    'description' => strip_tags($liCrawler->filter('p.character-description')->html()),
                    'side' => 'Light Side' === trim($side[0]) ? 1 : 0,
                    'image' => Character::CHARACTER_PATH .$characterImageName,
                    'tags' => $tags,
                ]);
            } else {
                $character = CharacterFactory::create([
                    'code' => $matches[1],
                    'name' => $domElement->getAttribute('data-name-lower'),
                    'description' => strip_tags($liCrawler->filter('p.character-description')->html()),
                    'side' => 'Light Side' === trim($side[0]) ? 1 : 0,
                    'image' => Character::CHARACTER_PATH .$characterImageName,
                    'tags' => $tags,
                ]);
                $this->em->persist($character);
            }
        }
        $this->em->flush();
    }

    /**
     * @param string $source
     * @param string $filename
     */
    private function uploadCharacterImage(string $source, string $filename): void
    {
        $fs = new Filesystem();
        $fs->copy($source, Character::CHARACTER_PATH . $filename);
    }
}
