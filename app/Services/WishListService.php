<?php

namespace App\Services;

use GuzzleHttp\Client;
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

    public function getWishLists()
    {
        $response = $this->client->get('wishlists');
        return json_decode($response->getBody()->getContents());
    }

    public function getLibraries()
    {
        $response = $this->client->get('libraries');
        return json_decode($response->getBody()->getContents());
    }

    public function createWishList($data)
    {
        $response = $this->client->post('wishlists', [
            'form_params' => $data,
        ]);

        Session::flash('success', 'Wish List was created successfully.');
    }

    public function deleteWishList($id)
    {
        $response = $this->client->delete('wishlists/' . $id);

        Session::flash('success', 'Wish List was deleted successfully.');
    }
}
