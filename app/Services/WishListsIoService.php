<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WishListsIoService
{
    public function getLibraryList()
    {
        $response = Http::get('https://libraries.io/api/search', [
            'q' => 'wishList-api-libraries.io',
            'api_key' => 'becf21e3b26f49e963530ff2e26aa9e7',
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new Exception('Failed to retrieve library list from libraries.io API');
        }
    }

//    protected $baseUrl = 'https://libraries.io/api/';
//    protected $client;
//    protected $token;
//
//    public function __construct()
//    {
//        $this->client = new Client(['base_uri' => $this->baseUrl]);
//        $this->token = config('services.libraries_io.token');
//    }
//
//    public function getWishlists()
//    {
//        $cacheKey = 'libraries_io_wishlists';
//        $cacheDuration = 60 * 60; // Cache for 1 hour
//
//        return Cache::remember($cacheKey, $cacheDuration, function () {
//            $response = $this->client->get('user/wishlists', [
//                'query' => [
//                    'api_key' => $this->token,
//                ],
//            ]);
//
//            return json_decode($response->getBody(), true);
//        });
//    }
}
