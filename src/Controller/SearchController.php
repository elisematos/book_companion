<?php

namespace App\Controller;

use App\Entity\Progress;
use App\Form\SearchFormType;
use Doctrine\Persistence\ManagerRegistry;
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
        $data=[];
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $search = $form->get('searchField')->getData();
            $data = $booksApiService->getBooks($search);
        }
        return $this->render('search/index.html.twig', [
            'data' => $data,
            'searchForm' => $form->createView()
        ]);
    }

    #[Route('/search/addBook/{id}', name: 'add_book')]
    public function addBookToUserList(ManagerRegistry $doctrine, $bookId): Response
    {
        $entityManager = $doctrine->getManager();
        $progress = new Progress();
        $progress->setUser($this->getUser());
        $progress->setBookId($bookId);
        $progress->setPagesRead(0);

        $entityManager->persist($progress);
        $entityManager->flush();

        return new Response("ADDED new book to reading list");
    }
}
