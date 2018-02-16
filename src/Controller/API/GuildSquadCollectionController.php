<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\GuildSquad;
use App\Entity\GuildSquadCollection;
use App\Handler\GuildSquadCollectionHandler;
use App\Handler\GuildSquadHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/guild-squads-collection")
 */
class GuildSquadCollectionController extends FOSRestController
{
    /**
     * @Route("/{id}/collection", name="api_update_guild_squad_collection")
     * @Method("PATCH")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Update guild squad collection",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=GuildSquad::class, groups={"guild_squad_collection"})
     *     )
     * )
     * @SWG\Tag(name="guild_squad_collection")
     */
    public function patchCollection(Request $request, GuildSquad $guildSquad)
    {
        $this->getHandler()->updateCollection($guildSquad, $request->request->all(), ['guild_squad_collection']);

        return JsonResponse::create(['success']);
    }

    /**
     * @Route("/{id}/collection", name="api_get_guild_squad_collection")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Fetch guild squad collection",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=GuildSquad::class, groups={"guild_squad_collection"})
     *     )
     * )
     * @SWG\Tag(name="guild_squad_collection")
     */
    public function getCollection(GuildSquad $guildSquad)
    {
        return $this->getHandler()->collect(['guild_squad_collection']);
    }

    public function getHandler()
    {
        return $this->get(GuildSquadCollectionHandler::class)->init(GuildSquadCollection::class);
    }
}
