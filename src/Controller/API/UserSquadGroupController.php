<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\UserSquadGroup;
use App\Handler\UserSquadGroupHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/user-squad-group")
 */
class UserSquadGroupController extends FOSRestController
{
    /**
     * @Route("/", name="api_get_user_squad_group")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get user squad  groups",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquadGroup::class, groups={"user_squad_group"})
     *     )
     * )
     * @SWG\Tag(name="user_squad_group")
     */
    public function getCollection()
    {
        return $this->getHandler()->collect(['user_squad_group']);
    }

    /**
     * @Route("/add", name="api_user_squad_group")
     * @Method("POST")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Insert user squad group",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquadGroup::class, groups={"user_squad_group"})
     *     )
     * )
     * @SWG\Tag(name="user_squad_group")
     */
    public function post(Request $request)
    {
        return $this->getHandler()->createEntry($request->request->all(), ['user_squad_group'], true);
    }

    /**
     * @Route("/edit/{id}", name="api_update_user_squad_group")
     * @Method("PATCH")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Update user squad group",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquadGroup::class, groups={"user_squad_group"})
     *     )
     * )
     * @SWG\Tag(name="guild")
     */
    public function patch(Request $request, UserSquadGroup $userSquadGroup)
    {
        return $this->getHandler()->updateEntry($userSquadGroup->getId(), $request->request->all(), ['user_squad_group']);
    }

    /**
     * @Route("/{id}", name="api_delete_user_squad_group")
     * @Method("DELETE")
     *
     * @SWG\Response(
     *     response=200,
     *     description="DELETE user squad group",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquadGroup::class, groups={"user_squad_group"})
     *     )
     * )
     * @SWG\Tag(name="guild")
     */
    public function delete(UserSquadGroup $userSquadGroup, Request $request)
    {
        return $this->getHandler()->remove($userSquadGroup)->success();
    }

    public function getHandler()
    {
        return $this->get(UserSquadGroupHandler::class)->init(UserSquadGroup::class);
    }
}
