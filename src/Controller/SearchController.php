<?php

namespace App\Controller;

use App\Form\SearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\BooksApiService;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(BooksApiService $booksApiService, Request $request): Response
    {
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);
        return $this->render('search/index.html.twig', [
            'data' => $booksApiService->getBooks(),
            'searchForm' => $form->createView()
        ]);
    }
}
