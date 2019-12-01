<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        return $this->render('admin/login.html.twig',[
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Logout
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }

    /**
     * @Route("/register", name="register")
     * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pwd = $encoder->encodePassword($user, $user->getPwd());
            $user->setPwd($pwd);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'success',
                'Demande de compte effectuée, en attente d approbation'
            );
            return $this->redirectToRoute('homepage');
        }

        return $this->render('admin/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/setAdmin/{id}", name="setAdmin")
     * @param User $user
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
     * @IsGranted("ROLE_ADMIN")
     */
    public function setAdmin(User $user, EntityManagerInterface $manager)
    {
        $roleAdmin = array("ROLE_ADMIN");
        $user->setRoles($roleAdmin);
        $manager->persist($user);
        $manager->flush();
        return $this->redirectToRoute('homepage');
    }
}
