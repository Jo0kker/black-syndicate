<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('admin/login.html.twig');
    }

    /**
     * Logout
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
