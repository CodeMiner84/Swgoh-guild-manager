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
class UserSquadController extends FOSRestController
{
    /**
     * @Route("/", name="api_user_squad")
     * @Method("POST")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Insert user squad",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserSquad::class, groups={"user_squad"})
     *     )
     * )
     * @SWG\Tag(name="user_squad")
     */
    public function post(Request $request)
    {
        return $this->getHandler()->createEntry($request->request->all(), ['guild_squad']);
    }

    public function getHandler()
    {
        return $this->get(GuildSquadHandler::class)->init(GuildSquad::class);
    }
}
