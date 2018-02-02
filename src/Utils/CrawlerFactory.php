<?php

namespace App\Utils;

use App\Entity\Character;
use App\Entity\Guild;
use App\Entity\Setting;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CrawlerFactory
 */
class CrawlerFactory
{
    private const SWGOH_API = 'swgoh';

    /**
     * @param $crawler
     * @param EntityManagerInterface $em
     *
     * @return CharacterCrawler|GuildCrawler|UserCrawler|null
     */
    public static function get($crawler, EntityManagerInterface $em)
    {
        $instance = null;

        $settings = self::getSettings($em);

        switch ($crawler) {
            case 'character':
                $instance = new CharacterCrawler($settings, $em, $em->getRepository(Character::class));
                break;
            case 'guild':
                $instance = new GuildCrawler($settings, $em, $em->getRepository(Guild::class));
                break;
            case 'user':
                $instance = new UserCrawler($settings, $em, $em->getRepository(User::class));
                break;
        }

        return $instance;
    }

    /**
     * @param EntityManager $em
     *
     * @return mixed
     */
    private function getSettings(EntityManager $em)
    {
        return $em->getRepository(Setting::class)->findOneByCode(self::SWGOH_API);
    }

}
