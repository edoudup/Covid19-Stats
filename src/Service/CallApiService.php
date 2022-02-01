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

    public function getFranceData(): array
    {
        return $this->getApi('france');
    }

    public function AllLiveData(): array
    {
        return $this->getApi('departements');
    }

    public function getDepartmentData($department): array
    {
        return $this->getApi('departement/' . $department);
    }

    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'https://coronavirusapifr.herokuapp.com/data/live/' . $var
        );

        return $response->toArray();
    }

    
}