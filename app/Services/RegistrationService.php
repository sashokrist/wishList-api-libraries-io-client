<?php

namespace App\Services;

use GuzzleHttp\Client;

class RegistrationService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function register($data)
    {
        $response = $this->client->post('http://wishlist.test/register', [
            'form_params' => $data
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
