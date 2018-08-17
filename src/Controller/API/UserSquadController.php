<?php

namespace App\Controller\API;

use App\Entity\UserSquad;
use App\Entity\UserSquadGroup;
use App\Handler\UserSquadHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/user-squad/{squad_id}", requirements={"squad_id"="\d+"}, name="user_squad_list.")
 * @ParamConverter("userSquadGroup", options={"mapping"={"squad_id"="id"}})
 */
class UserSquadController extends FOSRestController
{
    /**
     * @Route("/", name="list")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get user squad  groups",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquadGroup::class, groups={"user_squad_list"})
     *     )
     * )
     * @SWG\Tag(name="user_squad_list")
     */
    public function cget(UserSquadGroup $userSquadGroup)
    {
        return $this->getHandler()->collect(['user_squad_list']);
    }

    /**
     * @Route("/add", name="create")
     * @Method("POST")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Insert new squad",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquad::class, groups={"user_squad"})
     *     )
     * )
     * @SWG\Tag(name="user_squad")
     */
    public function post(Request $request, UserSquadGroup $userSquadGroup)
    {
        return $this->getHandler()->createEntry($request->request->all(), ['user_squad_list'], true, [
            'setGroup' => $userSquadGroup,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="update")
     * @Method("PATCH")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Update user squad",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquad::class, groups={"user_squad_list"})
     *     )
     * )
     * @SWG\Tag(name="user_squad_list")
     */
    public function patch(Request $request, UserSquad $userSquad)
    {
        return $this->getHandler()->updateEntry($userSquad->getId(), $request->request->all(), ['user_squad_list']);
    }

    /**
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     *
     * @SWG\Response(
     *     response=200,
     *     description="DELETE user squad",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquad::class, groups={"user_squad_list"})
     *     )
     * )
     * @SWG\Tag(name="user_squad_list")
     */
    public function delete(UserSquad $userSquad, Request $request)
    {
        return $this->getHandler()->remove($userSquad)->success();
    }

    public function getHandler()
    {
        return $this->get(UserSquadHandler::class)->init(UserSquad::class);
    }
}
