<?php

namespace App\Utils;

use App\Entity\Guild;
use App\Entity\User;
use App\Factory\UserFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class GuildCrawler
 * @package App\Utils
 */
class GuildCrawler extends AbstractCrawler
{
    /**
     * @param Guild $guild
     */
    public function crawl(Guild $guild)
    {
        $crawler = new Crawler($this->getGuildUrl($guild));
        $usersTableList = $crawler->filter('table.table a');

        $this->fetchUsers($guild, $usersTableList);
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
     * @param $usersList
     * @param $matchCode
     */
    private function fetchUsers(Guild $guild, $usersList): void
    {
        $this->removeUsers($guild);

        foreach ($usersList as $user) {
            preg_match('/\/u\/(.*)\//', $user->getAttribute('href'), $matchCode);

            $entity = UserFactory::create([
                'uuid' => $matchCode[1],
                'title' => trim($user->nodeValue),
                'guild' => $guild,
            ]);
            $this->em->persist($entity);
        }
        $this->em->flush();
    }
}
