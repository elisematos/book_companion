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
        $author='';
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $search = $form->get('searchField')->getData();
            $author = $form->get('author')->getData();
        }
        return $this->render('search/index.html.twig', [
            'data' => $booksApiService->getBooks($search, $author),
            'searchForm' => $form->createView()
        ]);
    }
}
