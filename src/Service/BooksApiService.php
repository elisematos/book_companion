<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Dotenv\Dotenv;

class BooksApiService
{
    private $client;
    const API_KEY = "AIzaSyAF_ZiJtyS6sjfNaW12xx7a8yJOeHzFJQ8";

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getBooks(): array {
        $response = $this->client->request(
            'GET',
            'https://www.googleapis.com/books/v1/volumes?', [
                'query' => [
                    'q' => 'mousquetaire',
                    'key' => BooksApiService::API_KEY
                ]
            ]
        );
        return $response->toArray();
    }
}
