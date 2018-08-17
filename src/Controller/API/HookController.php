<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\User;
use App\Utils\CharacterCrawler;
use App\Utils\GuildCrawler;
use App\Utils\UserCharacterCrawler;
use App\Utils\UserCrawler;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/hook")
 */
class HookController extends FOSRestController
{
    /**
     * @Route("/fetch-guilds", name="api_fetch_guilds")
     */
    public function fetchGuilds(GuildCrawler $crawler)
    {
        $crawler->crawl();

        return JsonResponse::create(['success']);
    }

    /**
     * @Route("/fetch-characters", name="api_collect_characters")
     */
    public function fetchCharacters(CharacterCrawler $crawler)
    {
        $crawler->crawl();

        return JsonResponse::create(['success']);
    }

    /**
     * @Route("/fetch-users/{guild}", name="api_fetch_guild")
     * @ParamConverter("guild", options={"mapping"={"guild"="code"}})
     */
    public function fetchUsersFromGuild(Guild $guild, UserCrawler $crawler)
    {
        $crawler->setGuild($guild)->crawl();

        return JsonResponse::create(['success']);
    }

    /**
     * @Route("/fetch-user-character/{user}", name="api_fetch_user_characters")
     * @ParamConverter("user", options={"mapping"={"user"="uuid"}})
     */
    public function fetchUserCharacters(User $user, UserCharacterCrawler $crawler)
    {
        $crawler->setUser($user)->crawl();

        return JsonResponse::create(['success']);
    }

    /**
     * @Route("/fetch-guild-collection/{guild}", name="api_fetch_guild_collection")
     * @ParamConverter("guild", options={"mapping"={"guild"="code"}})
     */
    public function fetchGuildCollection(Guild $guild, UserCharacterCrawler $crawler)
    {
        $crawler->setGuild($guild)->crawlGuild();

        return JsonResponse::create(['success']);
    }
}
