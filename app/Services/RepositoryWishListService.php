<?php

namespace App\Services;

use GuzzleHttp\Client;

class RepositoryWishListService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://libraries.io/'
        ]);
    }

    public function getWishLists()
    {
        $response = $this->client->request('GET', 'github/sashokrist/wishList-api-libraries-io', [
            'headers' => [
                'Authorization' => 'token becf21e3b26f49e963530ff2e26aa9e7',
                'Accept' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function createWishList($data)
    {
        $response = $this->client->request('POST', 'github/sashokrist/wishList-api-libraries-io', [
            'headers' => [
                'Authorization' => 'token becf21e3b26f49e963530ff2e26aa9e7',
                'Accept' => 'application/json'
            ],
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function deleteWishList($wishListId)
    {
        $response = $this->client->request('DELETE', 'github/sashokrist/wishList-api-libraries-io/' . $wishListId, [
            'headers' => [
                'Authorization' => 'token becf21e3b26f49e963530ff2e26aa9e7',
                'Accept' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function getLibraries()
    {
        $response = $this->client->request('GET', 'api/github/sashokrist/wishList-api-libraries-io/libraries', [
            'headers' => [
                'Authorization' => 'token becf21e3b26f49e963530ff2e26aa9e7',
                'Accept' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function createLibrary($data)
    {
        $response = $this->client->request('POST', 'api/github/sashokrist/wishList-api-libraries-io/libraries', [
            'headers' => [
                'Authorization' => 'token becf21e3b26f49e963530ff2e26aa9e7',
                'Accept' => 'application/json'
            ],
            'json' => $data
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function deleteLibrary($libraryId)
    {
        $response = $this->client->request('DELETE', 'api/github/sashokrist/wishList-api-libraries-io/libraries/' . $libraryId, [
            'headers' => [
                'Authorization' => 'token becf21e3b26f49e963530ff2e26aa9e7',
                'Accept' => 'application/json'
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
