<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Handler\ApiHandler;
use App\Utils\BaseCrawler;
use App\Utils\UserCrawler;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * @Route("/api/guild")
 */
class GuildController extends FOSRestController
{
    /**
     * @Route("/", name="api_guild")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the top 12 products from store",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Guild::class, groups={"users"})
     *     )
     * )
     * @SWG\Tag(name="guild")
     */
    public function cget()
    {
        return $this->getHandler()->collect(['guild']);
    }

    /**
     * @Route("/collect", name="api_guild_collect_users")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the top 12 products from store",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Guild::class, groups={"users"})
     *     )
     * )
     * @SWG\Tag(name="guild")
     */
    public function collect(UserCrawler $guildCrawler)
    {
        $guilds = $this->getDoctrine()->getRepository(Guild::class)->findAll();

        foreach ($guilds as $guild) {
            $guildCrawler->crawl($guild);
        }
        return $this->getHandler()->collect(['guild']);
    }

    public function getHandler()
    {
        return $this->get(ApiHandler::class)->init(Guild::class);
    }
}
