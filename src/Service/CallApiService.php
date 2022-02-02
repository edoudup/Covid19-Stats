<?php

namespace App\Service; 

use DateTime;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService 
{
    private $client; 

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    //data for France
    public function getFranceData(): array
    {
        return $this->getApi('live/france');
    }

    //data for department 
    public function getAllData(): array
    {
        return $this->getApi('live/departements');
    }

    //data by date 
    public function getAllDataByDate($date): array
    {
        return $this->getApi('departements-by-date/' . $date);
    }
    
    public function getDepartmentData($department): array
    {
        return $this->getApi('departement/' . $department);
    }


    
    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'https://coronavirusapifr.herokuapp.com/data/' . $var
        );
    return $response->toArray();

    }
}