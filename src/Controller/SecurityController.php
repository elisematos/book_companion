<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('list');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/delete-account", name="delete_account")
     */
    public function deleteAccount(ManagerRegistry $doctrine): RedirectResponse
    {
        $em = $doctrine->getManager();
        $userEmail = $this->getUser()->getUserIdentifier();
        $user = $em->getRepository(User::class)->findOneBy(['email' => $userEmail]);
        $this->container->get('security.token_storage')->setToken(null);

        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Votre compte utilisateur a bien été supprimé !');

        return $this->redirectToRoute('home');
    }
}
