<?php

namespace App\Utils;

use App\Entity\Guild;
use App\Factory\UserFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class SingleUserCrawler.
 */
class SingleUserCrawler extends BaseCrawler implements CrawlerInterface
{
    private $code;

    public function crawl()
    {
        $crawler = new Crawler($this->getUserUrl());
        $usersTableList = $crawler->filter('table.table a');

        $this->fetchUsers($this->guild, $usersTableList);
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function setGuild(Guild $guild)
    {
        $this->guild = $guild;

        return $this;
    }

    private function getUserUrl(): string
    {
        return file_get_contents(sprintf('%s%s/%s',
            $this->settings->getApi(),
            $this->settings->getUserSuffix(),
            $this->code
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
     * @param Crawler $usersList
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
