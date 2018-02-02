<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\User;
use App\Handler\ApiHandler;
use App\Utils\UserCrawler;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * @Route("/api/users")
 */
class UserController extends FOSRestController
{
    /**
     * @Route("/", name="api_user")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns guild users",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=User::class, groups={"users"})
     *     )
     * )
     * @SWG\Tag(name="users")
     */
    public function cget()
    {
        return $this->getHandler()->collect(['users']);
    }

    public function getHandler()
    {
        return $this->get(ApiHandler::class)->init(User::class);
    }
}
