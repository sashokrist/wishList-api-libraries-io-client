<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishListsController extends Controller
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
        $response = $this->client->get('http://wishlist.test/api/wishlists');
        $wishlists = json_decode($response->getBody()->getContents());

        return view('wishlists.index', compact('wishlists'));
    }

    public function create()
    {
        $response = $this->client->get('http://wishlist.test/api/libraries');
        $libraries = json_decode($response->getBody()->getContents());

        return view('wishlists.create', compact('libraries'));
    }

    public function store(Request $request)
    {
        $response = $this->client->post('http://wishlist.test/api/wishlists', [
            'form_params' => [
                'user_id' => 1,
                'name' => $request->name,
                'description' => $request->description,
                'library_id' => $request->library_id
            ],
        ]);

        Session::flash('success', 'Wish List was created successfully.');
        return redirect()->route('wishlists');
    }

    public function destroy($wishList)
    {
        $response = $this->client->delete('http://wishlist.test/api/wishlists/' . $wishList);

        Session::flash('success', 'Wish List was deleted successfully.');
        return redirect()->back();
    }
}
