<?php

namespace App\Consumer;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TypicodeConsumer
{
    const BASE_URL = 'https://jsonplaceholder.typicode.com/';

    public function __construct(
        private HttpClientInterface $client
    )
    {
        $this->client = $client->withOptions([
            'base_uri' => self::BASE_URL,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function getPosts(): array
    {
        $response = $this->client->request('GET', 'posts');

        return $response->toArray();
    }

    public function getUsers(): array
    {
        $response = $this->client->request('GET', 'users');

        return $response->toArray();
    }
}