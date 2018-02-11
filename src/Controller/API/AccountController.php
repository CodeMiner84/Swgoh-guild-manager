<?php

namespace App\Controller\API;

use App\Entity\Account;
use App\Entity\Guild;
use App\Entity\User;
use App\Handler\AccountHandler;
use App\Handler\ApiHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/account")
 */
class AccountController extends FOSRestController
{
    /**
     * @Route("/", name="api_account")
     * @Method("PATCH")
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
    public function patchAction(Request $request)
    {
        return $this->getHandler()->updateEntry($request->request->all(), $this->getUser()->getId(), ['account_show']);
    }

    /**
     * @Route("/{id}", name="api_get_account")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns account",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Account::class, groups={"account_show"})
     *     )
     * )
     * @SWG\Tag(name="account_show")
     */
    public function getAccount(string $id)
    {
        $user = $this->getUser();
        if ('me' === $id) {
            $id = $user->getId();
        }

        return $this->getHandler()->collect(['account_show'], $id);
    }

    public function getHandler()
    {
        return $this->get(AccountHandler::class)->init(Account::class);
    }
}
