<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Entity\UserCharacter;
use App\Handler\UserCharacterHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;

/**
 * @Route("/api/collection")
 */
class UserCharacterController extends FOSRestController
{
    /**
     * @Route("/{user}", name="api_user_character")
     * @ParamConverter("user", options={"mapping"={"user"="uuid"}})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns user characters list",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserCharacter::class, groups={"user_character"})
     *     )
     * )
     * @SWG\Tag(name="user_character")
     */
    public function cget(User $user)
    {
        return $this->getHandler()->setParams(['userId' => $user->getId()])->collect(['user_character']);
    }

    /**
     * @Route("/", name="api_user_collection")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns user characters list",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=UserCharacter::class, groups={"user_character"})
     *     )
     * )
     * @SWG\Tag(name="user_character")
     */
    public function getUserCollection()
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneByUuid($this->getUser()->getUuid());

        return $this->getHandler()->setParams(['userId' => $user->getId()])->collect(['user_character']);
    }

    public function getHandler()
    {
        return $this->get(UserCharacterHandler::class)->init(UserCharacter::class);
    }
}
