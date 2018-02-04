<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopController extends Controller
{
    /**
     * @Route("/shop", name="guilds")
     * @Route("/users/{code}", name="users")
     * @Route("/users", name="users")
     * @Route("/characters", name="characters")
     * @Route("/user/{code}", name="user-characters")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('shop/index.html.twig', [
            ]);
    }
}
