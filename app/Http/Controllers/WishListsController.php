<?php

namespace App\Http\Controllers;

use App\Services\WishListService;
use Illuminate\Http\Request;

class WishListsController extends Controller
{
    protected $wishListService;

    public function __construct(WishListService $wishListService)
    {
        $this->wishListService = $wishListService;
    }

    public function index()
    {
        $wishlists = $this->wishListService->getAll();
        return view('wishlists.index', compact('wishlists'));
    }

    public function create()
    {
        $libraries = $this->wishListService->getLibraries();
        return view('wishlists.create', compact('libraries'));
    }

    public function store(Request $request)
    {
        $data = [
            'user_id' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'library_id' => $request->library_id
        ];
        $this->wishListService->create($data);

        return redirect()->route('wishlists');
    }

    public function destroy($wishList)
    {
        $this->wishListService->delete($wishList);

        return redirect()->back();
    }
}
