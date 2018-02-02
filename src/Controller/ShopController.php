<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopController extends Controller
{
    /**
     * @Route("/shop", name="guilds")
     * @Route("/users/{code}", name="users")
     * @Route("/users", name="users2")
     * @Route("/characters", name="users2")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('shop/index.html.twig', [
            ]);
    }
}
