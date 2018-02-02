<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\Setting;
use App\Handler\ApiHandler;
use App\Utils\BaseCrawler;
use App\Utils\CharacterCrawler;
use App\Utils\GuildCrawler;
use App\Utils\UserCrawler;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
}
