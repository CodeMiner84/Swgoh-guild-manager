<?php

namespace App\Utils;

use App\Entity\Character;
use App\Entity\Guild;
use App\Entity\User;
use App\Factory\UserCharacterFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class UserCharacterCrawler.
 */
class UserCharacterCrawler extends BaseCrawler implements CrawlerInterface
{
    /**
     * @var Guild
     */
    private $guild;

    /**
     * @var User
     */
    private $user;

    public function crawl()
    {
        $crawler = new Crawler($this->getUserCharacters($this->user));
        $usersTableList = $crawler->filter('.collection-char');

        $this->fetchCharacters($this->user, $usersTableList);
    }

    public function crawlGuild()
    {
        foreach ($this->guild->getUsers() as $user) {
            $crawler = new Crawler($this->getUserCharacters($user));
            $usersTableList = $crawler->filter('.collection-char');

            $this->fetchCharacters($user, $usersTableList);
        }
    }

    public function crawlGuildUser(User $user)
    {
        $crawler = new Crawler($this->getUserCharacters($user));
        $usersTableList = $crawler->filter('.collection-char');

        $this->fetchCharacters($user, $usersTableList);
    }

    /**
     * @param Guild $guild
     *
     * @return $this
     */
    public function setGuild(Guild $guild)
    {
        $this->guild = $guild;

        return $this;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param Guild $guild
     *
     * @return string
     */
    private function getUserCharacters(User $user): string
    {
        return @file_get_contents(sprintf('%s%s/%s/collection/',
            $this->settings->getApi(),
            $this->settings->getUserSuffix(),
            $user->getUuid()
        ));
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
    private function fetchCharacters(User $user, Crawler $usersList): void
    {
        ini_set('dispaly_errors', 0);
        foreach ($usersList as $collectionHtml) {
            try {
                $domHTML = new Crawler($collectionHtml);

                $active = !preg_match('/collection\-char\-missing/', $collectionHtml->getAttribute('class'));
                preg_match('/u\/(.*)\/collection\/(.*)\/(.*)\//',
                    $domHTML->filter('a')->getNode(0)->getAttribute('href'), $matchChar);

                if (!isset($matchChar[3])) {
                    continue;
                }
                $characterCode = $matchChar[3];

                $character = $this->em->getRepository(Character::class)->findOneByCode($characterCode);
                preg_match('/title\=\"Power (.*)\"/', $domHTML->filter('.collection-char')->html(), $powerMatch);
                $power = explode('/', str_replace(',', '', $powerMatch[1]));

                $data = [
                    'stars' => count($domHTML->filter('div.star:not(.star-inactive)')),
                    'user' => $user,
                    'character' => $character,
                    'active' => $active,
                    'level' => $domHTML->filter('.char-portrait-full-level')->text(),
                    'gear' => $this->mapGear($domHTML->filter('.char-portrait-full-gear-level')->text()),
                    'power' => trim(str_replace(',', '.', $power[0])),
                ];

                if ($this->characterExists($user, $character)) {
                    $this->repository->updateToon($user, $data);
                } else {
                    $this->em->persist(UserCharacterFactory::create($data));
                }
            } catch (\Exception $e) {
                var_dump($e->getMessage());
                //die();
            }
        }
        $this->em->flush();
    }

    /**
     * @param User      $user
     * @param Character $character
     *
     * @return int
     */
    public function characterExists(User $user, Character $character)
    {
        return count($this->repository->findOneBy([
            'user' => $user,
            'character' => $character,
        ]));
    }

    /**
     * @param $number
     *
     * @return int|mixed
     */
    public function mapGear($number)
    {
        $symbols = [
            'M' => 1000,
            'D' => 500,
            'C' => 100,
            'L' => 50,
            'X' => 10,
            'V' => 5,
            'I' => 1,
        ];

        $a = str_split($number);

        $i = 0;
        $temp = 0;
        $value = 0;
        $q = count($a);
        while ($i < $q) {
            $thys = $symbols[$a[$i]];
            if (isset($a[$i + 1])) {
                $next = $symbols[$a[$i + 1]];
            } else {
                $next = 0;
            }

            if ($thys < $next) {
                $value -= $thys;
            } else {
                $value += $thys;
            }

            $temp = $thys;
            ++$i;
        }

        return $value;
    }
}
