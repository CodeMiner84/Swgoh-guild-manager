<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\GuildSquad;
use App\Handler\GuildSquadHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/guild-squads")
 */
class GuildSquadController extends FOSRestController
{
    /**
     * @Route("/", name="api_guild_squads")
     * @Method("POST")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the top 12 products from store",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=GuildSquad::class, groups={"users"})
     *     )
     * )
     * @SWG\Tag(name="guild")
     */
    public function post(Request $request)
    {
        return $this->getHandler()->createEntry($request->request->all(), ['guild_squad']);
    }

    /**
     * @Route("/", name="api_guild_squads_all")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the top 12 products from store",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=GuildSquad::class, groups={"users"})
     *     )
     * )
     * @SWG\Tag(name="guild")
     */
    public function cget()
    {
        return $this->getHandler()->collect(['guild_squad']);
    }

    /**
     * @Route("/{id}", name="api_update_guild_squad")
     * @Method("PATCH")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Update guild squad",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=GuildSquad::class, groups={"users"})
     *     )
     * )
     * @SWG\Tag(name="guild")
     */
    public function patch(Request $request, GuildSquad $guildSquad)
    {
        return $this->getHandler()->updateEntry($guildSquad->getId(), $request->request->all(), ['guild_squad']);
    }

    public function getHandler()
    {
        return $this->get(GuildSquadHandler::class)->init(GuildSquad::class);
    }
}
