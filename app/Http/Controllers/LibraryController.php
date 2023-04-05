<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LibraryController extends Controller
{
    protected $client;
    protected $base_uri = 'http://wishlist.test';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->base_uri,
        ]);
    }

    public function index()
    {
        $response = $this->client->get('http://wishlist.test/api/libraries');
        $libraries = json_decode($response->getBody()->getContents());

        return view('libraries.index', compact('libraries'));
    }

    public function create()
    {
        return view('libraries.create');
    }

    public function store(Request $request)
    {
        $response = $this->client->post('http://wishlist.test/api/libraries', [
            'form_params' => [
                'name' => $request->name,
                'description' => $request->description,
                'url' => $request->url
            ],
        ]);

        Session::flash('success', 'Library was created successfully.');
        return redirect()->route('libraries');
    }

    public function destroy($wishList)
    {
        $response = $this->client->delete('http://wishlist.test/api/libraries/' . $wishList);

        Session::flash('success', 'Library was deleted successfully.');
        return redirect()->back();
    }
}
