<?php

namespace App\Controller\API;

use App\Entity\Character;
use App\Entity\Guild;
use App\Handler\CharacterHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;

/**
 * @Route("/api/characters")
 */
class CharacterController extends FOSRestController
{
    /**
     * @Route("/", name="api_characters")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the top 12 products from store",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Guild::class, groups={"characters"})
     *     )
     * )
     * @SWG\Tag(name="characters")
     */
    public function cget()
    {
        return $this->getHandler()->collect(['characters']);
    }

    public function getHandler()
    {
        return $this->get(CharacterHandler::class)->init(Character::class);
    }
}
