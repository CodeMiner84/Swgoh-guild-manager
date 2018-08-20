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
    private const API_URL = 'https://apiv2.swgoh.help/swgoh/data';
    private const API_PARAMS = [
        'collection' => 'unitsList',
        'language' => 'eng_us'
    ];

    public function crawl(): void
    {
        $crawler = new Crawler($this->getSiteHtml($this->settings->getApi()));
        $this->fetchCharacters($crawler->filter('li.character'));
        $this->updateUnitsFromApi();
    }

    private function updateUnitsFromApi(): void
    {
        $data = $this->apiConnector->getResource(self::API_URL, self::API_PARAMS);

        foreach ($data as $unit) {
            $character = $this->em->getRepository(Character::class)->findOneByName(strtolower($unit->name));
            if ($character instanceof Character) {
                $character->setApiCode($unit->baseId);
            }
        }

        $this->em->flush();
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
            //$this->uploadCharacterImage($originalImagePath, $characterImageName);

            if ($this->checkCharacter($matches[1])) {
                $this->update($matches[1], [
                    'name' => $domElement->getAttribute('data-name-lower'),
                    'apiCode' => '',
                    'description' => strip_tags($liCrawler->filter('p.character-description')->html()),
                    'side' => 'Light Side' === trim($side[0]) ? 1 : 0,
                    //'image' => Character::CHARACTER_PATH .$characterImageName,
                    'tags' => $tags,
                ]);
            } else {
                $character = CharacterFactory::create([
                    'code' => $matches[1],
                    'apiCode' => '',
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
        $fs->copy($source, 'pubic/'.Character::CHARACTER_PATH . $filename);
    }
}
