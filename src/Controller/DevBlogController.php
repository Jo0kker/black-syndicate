<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DevBlogController extends AbstractController
{
    /**
     * @Route("/devblog", name="dev_blog")
     */
    public function index()
    {
        return $this->render('dev_blog/index.html.twig');
    }

    /**
     * @Route("devblog/update-name", name="show_blog")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show()
    {
        return $this->render('dev_blog/show.html.twig');
    }
}
