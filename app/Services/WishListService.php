<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class WishListService
{
    protected $client;
    protected $base_uri = 'http://wishlist.test/api/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->base_uri,
        ]);
    }

    public function getAll()
    {
//        $response = $this->client->get('wishlists');
//        return json_decode($response->getBody()->getContents());
        $cacheKey = 'libraries.all'; // A unique key for this cache entry
        $cacheTime = 60 * 60; // Time to cache the response (in seconds)

        return Cache::remember($cacheKey, $cacheTime, function () {
            $response = $this->client->get('wishlists');
            return json_decode($response->getBody()->getContents());
        });
    }

    public function getLibraries()
    {
        $response = $this->client->get('libraries');
        return json_decode($response->getBody()->getContents());
    }

    public function create($data)
    {
        $response = $this->client->post('wishlists', [
            'form_params' => $data,
        ]);

        Session::flash('success', 'Wish List was created successfully.');
        return $response->getStatusCode() === 201;
    }

    public function delete($id)
    {
        $response = $this->client->delete('wishlists/' . $id);

        Session::flash('success', 'Wish List was deleted successfully.');
        return $response->getStatusCode() === 204;
    }
}
