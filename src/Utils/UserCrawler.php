<?php

namespace App\Utils;

use App\Entity\Guild;
use App\Entity\Setting;
use App\Entity\User;
use App\Factory\UserFactory;
use App\Repository\RepositoryInterface;
use App\Repository\UserRepository;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class GuildCrawler
 * @package App\Utils
 */
class UserCrawler extends BaseCrawler implements CrawlerInterface
{
    private $guild;

    /**
     * @param Settings $settings
     * @param Guild $guild
     */
    public function crawl()
    {
        $crawler = new Crawler($this->getGuildUrl($this->guild));
        $usersTableList = $crawler->filter('table.table a');

        $this->fetchUsers($this->guild, $usersTableList);
    }

    public function setGuild(Guild $guild)
    {
        $this->guild = $guild;

        return $this;
    }


    /**
     * @param Guild $guild
     *
     * @return string
     */
    private function getGuildUrl(Guild $guild): string
    {
        return file_get_contents(sprintf("%s%s/%s/%s/",
            $this->settings->getApi(),
            $this->settings->getGuildSuffix(),
            $guild->getUuid(),
            $guild->getCode()
        ));
    }

    /**
     * @param Guild $guild
     */
    private function removeUsers(Guild $guild): void
    {
        $this->em->getRepository(User::class)->removeFromGuild($guild);
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
