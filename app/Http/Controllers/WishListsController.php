<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishListRequest;
use App\Services\LibraryService;
use App\Services\WishListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class WishListsController extends Controller
{
    protected $wishListService;

    public function __construct(WishListService $wishListService)
    {
        $this->middleware('auth');
        $this->wishListService = $wishListService;
    }

    public function index()
    {
        if (Cache::has('wishlist')) {
            // data is cached, retrieve it from cache
            $wishlists = Cache::get('wishlist');
        } else {
            // data is not cached, fetch it from form WishlistService
            $wishlists = $this->wishListService->getAll();
        }

        return view('wishlists.index', compact('wishlists'));
    }

    public function create(LibraryService $libraryService)
    {
        $libraries = $libraryService->all();
        return view('wishlists.create', compact('libraries'));
    }

    public function store(WishListRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
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

    public function deactivate(Request $request)
    {
       // dd($request->all());
        $user = auth::user();
        $user->is_active = false;
        $user->save();
        auth::logout();

        Session::flash('success', 'Account was deactivated successfully.');
        return redirect()->route('register');
    }
}
