<?php

namespace App\Utils;

use App\Entity\Character;
use App\Entity\Guild;
use App\Entity\Mod;
use App\Entity\Setting;
use App\Entity\User;
use App\Entity\UserCharacter;
use App\Utils\API\ApiConnector;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

/**
 * Class CrawlerFactory.
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
    public static function get($crawler, EntityManagerInterface $em, ApiConnector $apiConnector)
    {
        $instance = null;
        $client = new Client();

        $settings = self::getSettings($em);

        switch ($crawler) {
            case 'character':
                $instance = new CharacterCrawler($apiConnector, $client, $settings, $em, $em->getRepository(Character::class));
                break;
            case 'guild':
                $instance = new GuildCrawler($apiConnector, $client, $settings, $em, $em->getRepository(Guild::class));
                break;
            case 'user':
                $instance = new UserCrawler($apiConnector, $client, $settings, $em, $em->getRepository(User::class));
                break;
            case 'user-character':
                $instance = new UserCharacterCrawler($apiConnector, $client, $settings, $em, $em->getRepository(UserCharacter::class));
                break;
            case 'single-user-character':
                $instance = new SingleUserCrawler($apiConnector, $client, $settings, $em, $em->getRepository(UserCharacter::class));
                break;
            case 'mod':
                $instance = new ModCrawler($apiConnector, $client, $settings, $em, $em->getRepository(Mod::class));
                break;
        }

        return $instance;
    }

    /**
     * @param EntityManager $em
     *
     * @return mixed
     */
    private static function getSettings(EntityManager $em)
    {
        return $em->getRepository(Setting::class)->findOneBy([
            'code' => self::SWGOH_API,
        ]);
    }
}
