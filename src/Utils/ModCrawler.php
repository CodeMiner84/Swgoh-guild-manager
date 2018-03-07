<?php

namespace App\Utils;

use App\Entity\Account;
use App\Entity\Character;
use App\Entity\Guild;
use App\Entity\User;
use App\Factory\ModFactory;
use App\Factory\ModTypeFactory;
use App\Factory\UserFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ModCrawler.
 */
class ModCrawler extends BaseCrawler implements CrawlerInterface
{
    private $user;

    public function crawl()
    {
        $this->collectGuildsDOM($this->getModUrl($this->user), 1);

        $this->repository->remove();

        foreach ($this->buffer as $collectionHtml) {
            $crawler = new Crawler($collectionHtml);
            preg_match('/\/g\/(\d+)\/(.*)\//', $crawler->filter('a')->getNode(0)->getAttribute('href'), $match);

            preg_match('/\/(.*)\/collection\/(.*)\//', $crawler->filter('a.statmod-char-portrait')->getNode(0)->getAttribute('href'), $characterCode);

            $character = $this->em->getRepository(Character::class)->findOneByCode($characterCode[2]);
            $account = $this->em->getRepository(Account::class)->find(6);
            //if (!$this->checkGuild($match[2], $match[1])) {
            if ($character instanceof Character) {
                $imageNode = $crawler->filter('img.statmod-img')->getNode(0);
                $mod = ModFactory::create([
                    'image' => $imageNode->getAttribute('src'),
                    'name' => $imageNode->getAttribute('alt'),
                    'user' => $this->user,
                    'account' => $account,
                    'character' => $character,
                ]);

                $primary = $crawler->filter('.statmod-details .statmod-stats-1');
                $valueText = $primary->filter('.statmod-stat-value')->text();
                $value = str_replace('+', '', $valueText);
                $label = $primary->filter('.statmod-stat-label')->text();

                $modType = ModTypeFactory::create([
                    'mod' => $mod,
                    'name' => $label,
                    'value' => str_replace('%', '', $value),
                    'type' => preg_match('/\%/', $valueText),
                    'kind' => 0
                ]);
                $this->em->persist($modType);

                $sec = $crawler->filter('.statmod-details .statmod-stats-2');

                foreach ($sec->filter('.statmod-stat') as $secondary) {
                    $subCrawl = new Crawler($secondary);

                    $valueText = $subCrawl->filter('.statmod-stat-value')->text();
                    $value = str_replace('+', '', $valueText);
                    $label = $subCrawl->filter('.statmod-stat-label')->text();

                    $modType = ModTypeFactory::create([
                        'mod' => $mod,
                        'name' => $label,
                        'value' => str_replace('%', '', $value),
                        'type' => preg_match('/\%/', $valueText),
                        'kind' => 1
                    ]);
                    $this->em->persist($modType);
                }
                $this->em->persist($mod);
            }
        }
        $this->em->flush();
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
            $domElements = $crawler->filter('li.collection-mod-list > div > div.col-xs-12 ');

            if (count($domElements) > 0) {
                foreach ($domElements as $domElement) {
                    $this->buffer[] = $domElement->ownerDocument->saveHTML($domElement);
                }
                $this->collectGuildsDOM($url, ++$page);
            }
        } catch (\Exception $e) {
        }
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param User $user
     *
     * @return string
     */
    private function getModUrl(User $user)
    {
        return sprintf('%s%s/%s%s/',
            $this->settings->getApi(),
            $this->settings->getUserSuffix(),
            $user->getUuid(),
            $this->settings->getModsUrl()
        );
    }

    /**
     * @param Guild $guild
     */
    private function removeUsers(Guild $guild): void
    {
        $this->repository->removeFromGuild($guild);
    }

    /**
     * @param Guild $guild
     * @param array $usersList
     * @param $matchCode
     */
    private function fetchUsers(Guild $guild, Crawler $usersList): void
    {
        $this->removeUsers($guild);

        foreach ($usersList as $user) {
            preg_match('/\/u\/(.*)\//', $user->getAttribute('href'), $matchCode);

            $entity = UserFactory::create([
                'uuid' => $matchCode[1],
                'name' => trim($user->nodeValue),
                'guild' => $guild,
            ]);
            $this->em->persist($entity);
        }
        $this->em->flush();
    }
}
