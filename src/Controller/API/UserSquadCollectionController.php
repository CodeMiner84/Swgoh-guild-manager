<?php

namespace App\Controller\API;

use App\Entity\UserSquad;
use App\Entity\UserSquadCollection;
use App\Entity\UserSquadGroup;
use App\Handler\UserSquadCollectionHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/user-squad/{squad_id}/collection", requirements={"squad_id"="\d+"}, name="user_squad_list.")
 * @ParamConverter("userSquadGroup", options={"mapping"={"squad_id"="id"}})
 */
class UserSquadCollectionController extends FOSRestController
{
    /**
     * @Route("/{id}", name="squad_collection")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Fetch user squad collection",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquad::class, groups={"users"})
     *     )
     * )
     * @SWG\Tag(name="guild_squad_collection")
     */
    public function getCollection(UserSquadGroup $userSquadGroup, UserSquad $userSquad)
    {
        return $this->getHandler()->getCollection($userSquadGroup, $userSquad, ['user_squad_list']);
    }

    /**
     * @Route("/{id}", name="update_squad_collection")
     * @Method("PATCH")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Update guild squad collection",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquad::class, groups={"guild_squad_collection"})
     *     )
     * )
     * @SWG\Tag(name="guild_squad_collection")
     */
    public function patchCollection(Request $request, UserSquadGroup $userSquadGroup, UserSquad $userSquad)
    {
        $this->getHandler()->updateCollection($userSquad, $request->request->all(), ['user_squad_list']);

        return JsonResponse::create(['success']);
    }

    public function getHandler()
    {
        return $this->get(UserSquadCollectionHandler::class)->init(UserSquadCollection::class);
    }
}
