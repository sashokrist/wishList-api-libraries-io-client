<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class WishlistController extends Controller
{
    public function index()
    {
        $token = "becf21e3b26f49e963530ff2e26aa9e7";
        $user = "sashokrist";
        $repository = "wishList-api-libraries-io";

        $client = new Client();

        $response = $client->request('GET', "https://libraries.io/api/wishlists", [
            'query' => [
                'platform' => 'Packagist',
                'user' => $user,
                'api_key' => $token,
                'repository' => $repository
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
            print_r($data);
        } else {
            echo "Error: Could not retrieve data. HTTP status code: {$response->getStatusCode()}";
        }
    }
}
