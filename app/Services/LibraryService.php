<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class LibraryService
{
    protected $client;
    protected $base_uri = 'http://wishlist.test/api';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->base_uri,
        ]);
    }

    public function all()
    {
        $response = $this->client->get('http://wishlist.test/api/libraries');
        return json_decode($response->getBody()->getContents());
    }

    public function create($data)
    {
        $response = $this->client->post('http://wishlist.test/api/libraries', [
            'form_params' => [
                'name' => $data['name'],
                'description' => $data['description'],
                'url' => $data['url']
            ],
        ]);

        Session::flash('success', 'Library was created successfully.');
        return $response->getStatusCode() == 201;
    }

    public function delete($id)
    {
        $response = $this->client->delete('http://wishlist.test/api/libraries/' . $id);

        Session::flash('success', 'Library was deleted successfully.');
        return $response->getStatusCode() == 204;
    }
}
