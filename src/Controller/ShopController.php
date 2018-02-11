<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopController extends Controller
{
    /**
     * @Route("/login", name="app_login")
     * @Route("/logout", name="app_logout")
     * @Route("/account", name="app_account")
     * @Route("/collection", name="app_collection")
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
