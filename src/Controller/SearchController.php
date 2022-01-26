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
        $search='';
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $search = $form->get('searchField')->getData();
        }
        return $this->render('search/index.html.twig', [
            'data' => $booksApiService->getBooks($search),
            'searchForm' => $form->createView()
        ]);
    }
}
