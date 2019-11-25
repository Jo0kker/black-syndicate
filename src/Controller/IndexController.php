<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('common/homepage.html.twig');
    }

    /**
     * @Route("/about", name="about")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function about()
    {
        return $this->render('common/about.html.twig');
    }

    /**
     * @Route("/faq", name="faq")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function faq()
    {
        return $this->render('common/faq.html.twig');
    }
}
