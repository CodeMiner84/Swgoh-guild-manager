<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\Setting;
use App\Handler\ApiHandler;
use App\Utils\AbstractCrawler;
use App\Utils\CharacterCrawler;
use App\Utils\GuildCrawler;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/hook")
 */
class HookController extends FOSRestController
{
    /**
     * @Route("/fetch-guild", name="api_guild_collect_users")
     */
    public function fetchGuilds(GuildCrawler $crawler)
    {
        $guilds = $this->getDoctrine()->getRepository(Guild::class)->findAll();
        foreach ($guilds as $guild) {
            $crawler->crawl($guild);
        }

        return JsonResponse::create(['success']);
    }
    /**
     * @Route("/fetch-characters", name="api_collect_characters")
     */
    public function fetchCharacters(CharacterCrawler $crawler)
    {
        $settings = $this->getDoctrine()->getRepository(Setting::class)->findOneByCode('swgoh');
        $crawler->crawl($settings);

        return JsonResponse::create(['success']);
    }
}
