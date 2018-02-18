<?php

namespace App\Utils;

use App\Entity\Character;
use App\Entity\Guild;
use App\Factory\GuildFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class GuildCrawler.
 */
class GuildCrawler extends BaseCrawler implements CrawlerInterface
{
    public function crawl()
    {
        $this->collectGuildsDOM($this->settings->getApi().$this->settings->getGuildSuffix(), 1);

        foreach ($this->buffer as $collectionHtml) {
            $crawler = new Crawler($collectionHtml);
            preg_match('/\/g\/(\d+)\/(.*)\//', $crawler->filter('a')->getNode(0)->getAttribute('href'), $match);

            if (!$this->checkGuild($match[2], $match[1])) {
                $guild = GuildFactory::create([
                    'name' => $crawler->filter('h3')->text(),
                    'uuid' => $match[1],
                    'code' => $match[2],
                ]);
                $this->em->persist($guild);
            }

        }
        $this->em->flush();
    }

    public function checkGuild(string $code, string $uuid)
    {
        return $this->em->getRepository(Guild::class)->findOneBy([
            'code' => $code,
            'uuid' => $uuid,
        ]);
    }

    private function removeGuilds(): void
    {
        $this->em->getRepository(Guild::class)->remove();
    }

    /**
     * @param string $url
     * @param int    $page
     */
    private function collectGuildsDOM(string $url, $page = 1): void
    {
        ++$this->iter;
        try {
            $crawler = new Crawler($this->getSiteHtml(sprintf('%s?page=%s', $url, $page)));
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
}
