<?php

namespace App\Controller;

use App\Entity\PostDev;
use App\Form\DevblogType;
use App\Repository\PostDevRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevBlogController extends AbstractController
{
    /**
     * @Route("/devblog", name="dev_blog")
     * @param PostDevRepository $repo
     * @return Response
     */
    public function index(PostDevRepository $repo)
    {
        $devblog = $repo->findAllDesc();
        return $this->render('dev_blog/index.html.twig', [
            'devblog' => $devblog
        ]);
    }

    /**
     * @Route("/devblog/add", name="add_blog")
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return Response
     */
    public function addDevBlog(EntityManagerInterface $manager,  Request $request)
    {
        $post = new PostDev();
        $form = $this->createForm(DevblogType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $manager->persist($post);
            $manager->flush();
            $this->addFlash(
                'success',
                'Annonce crée ! Sa va, pas trop dur ?'
            );
            return $this->redirectToRoute('dev_blog');
        }
        return $this->render('dev_blog/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/devblog/{slug}", name="show_blog")
     * @param PostDev $post
     * @return Response
     */
    public function show(PostDev $post)
    {
        return $this->render('dev_blog/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/devblog/{slug}/del", name="del_blog")
     * @param PostDev $post
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
     */
    public function delete(PostDev $post, EntityManagerInterface $manager)
    {
        $manager->remove($post);
        $manager->flush();
        $this->addFlash(
            'success',
            'Article supprimer'
        );
        return $this->redirectToRoute("dev_blog");
    }
}
