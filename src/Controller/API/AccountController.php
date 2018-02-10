<?php

namespace App\Controller\API;

use App\Entity\Guild;
use App\Entity\User;
use App\Handler\ApiHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;

/**
 * @Route("/api/account")
 */
class AccountController extends FOSRestController
{
    /**
     * @Route("/", name="api_account")
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
    public function postAction()
    {
        die("A");
        return $this->getHandler()->collect(['users']);
    }

    public function getHandler()
    {
        return $this->get(ApiHandler::class)->init(User::class);
    }
}
