<?php

namespace App\Controller\API;

use App\Entity\Mod;
use App\Handler\ModHandler;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/api/mod")
 */
class ModController extends FOSRestController
{
    /**
     * @Route("/settings", name="api_mods_settings")
     * @Method("GET")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get mods settings",
     * )
     * @SWG\Tag(name="mods")
     */
    public function settings()
    {
        return JsonResponse::create($this->getHandler()->getConfig());
    }

    public function getHandler()
    {
        return $this->get(ModHandler::class)->init(Mod::class);
    }
}
