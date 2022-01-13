<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BooksApiService;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(BooksApiService $booksApiService): Response
    {
//     dd($booksApiService->getBooks());
        return $this->render('search/index.html.twig', [
            'data' => $booksApiService->getBooks(),
        ]);
    }
}
