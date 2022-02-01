<?php

namespace App\Service; 

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService 
{
    private $client; 

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAllFranceData(): array
    {
        $response = $this->client->request(
            'GET',
            'https://coronavirusapifr.herokuapp.com/data/live/france'
        );

        return $response->toArray();
    }
}