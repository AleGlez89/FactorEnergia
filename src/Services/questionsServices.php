<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use App\Constants\externalServices;
use App\Services\helperServices;

class questionsServices
{
    public function getData($fromdate,$todate,$tagged){
        $helperServices = new helperServices();
        $query = $helperServices->prepareParameterByQuery($fromdate,$todate,$tagged);

        $client = HttpClient::create();
        $data  = $client->request(
            'GET',
            externalServices::URL_STACK_OVERFLOW,
            [
                'query' => $query
            ]
        );
        return $data->toArray();
    }
}