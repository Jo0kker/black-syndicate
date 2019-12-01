<?php

namespace App\Controller;

use App\Repository\PostDevRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param PostDevRepository $repo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PostDevRepository $repo)
    {
        $freshNews = $repo->findFresh();
        return $this->render('common/homepage.html.twig', [
            'news' => $freshNews
        ]);
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
