<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class WishListService
{
    protected $client;
    protected $base_uri = 'http://wishlist.test/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->base_uri,
        ]);
    }

    public function getAll()
    {
        $result = $this->client->post('oauth/token');
        $access_token = json_decode((string) $result->getBody(), true)['access_token'];
        $response = $this->client->get('api/wishlists', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer $access_token",
            ]
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function getLibraries()
    {
        $result = $this->client->post('oauth/token');
        $access_token = json_decode((string) $result->getBody(), true)['access_token'];
        $response = $this->client->get('api/libraries', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer $access_token",
            ]
        ]);
        return json_decode($response->getBody()->getContents());
    }

    public function create($data)
    {
        $result = $this->client->post('oauth/token');
        $access_token = json_decode((string) $result->getBody(), true)['access_token'];
        $response = $this->client->post('api/wishlists', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer $access_token",
            ],
            'form_params' => $data,
        ]);
        Session::flash('success', 'Wish List was created successfully.');
        return $response->getStatusCode() === 201;
    }

    public function delete($id)
    {
        $result = $this->client->post('oauth/token');
        $access_token = json_decode((string) $result->getBody(), true)['access_token'];
        $response = $this->client->delete('api/wishlists' . $id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer $access_token",
            ]
        ]);

        Session::flash('success', 'Wish List was deleted successfully.');
        return $response->getStatusCode() === 204;
    }
}
