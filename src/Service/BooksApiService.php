<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class BooksApiService
{
    private $client;
    const API_KEY = "AIzaSyAF_ZiJtyS6sjfNaW12xx7a8yJOeHzFJQ8";

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getBooks($q): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.googleapis.com/books/v1/volumes?', [
                'query' => [
                    'q' => $q,
                    'key' => BooksApiService::API_KEY
                ]
            ]
        );
        return $response->toArray();
    }

    public function getBookById($bookId): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.googleapis.com/books/v1/volumes/' . $bookId
        );
        return $response->toArray();
    }
}
