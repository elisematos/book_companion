<?php

namespace App\Controller;

use App\Entity\Progress;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $progressList = $doctrine->getRepository(Progress::class)->findBy(['user' => $user]);
        return $this->render('list/index.html.twig', [
            'progressList' => $progressList
        ]);
    }
}
