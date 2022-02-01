<?php

namespace App\Controller;

use App\Entity\Progress;
use App\Service\BooksApiService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function index(ManagerRegistry $doctrine, BooksApiService $booksApiService): Response
    {
        $user = $this->getUser();
        $progressList = $doctrine->getRepository(Progress::class)->findBy(['user' => $user]);
        $bookList = [];
        foreach ($progressList as $progress)
        {
            $book = $booksApiService->getBookById($progress->getBookId());
            array_push($bookList, $book);
        }
        return $this->render('list/index.html.twig', [
            'progressList' => $progressList,
            'bookList' => $bookList
        ]);
    }
}
