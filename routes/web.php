<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WishListsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists');

Route::post('/api-register', [ RegisterController::class, 'registerApi'])->name('api-register');
Route::post('/api-login', [ LoginController::class, 'login'])->name('api-login');

Route::get('/wishlists', [WishListsController::class, 'index'])->name('wishlists');
Route::get('/wishlists/create', [WishListsController::class, 'create'])->name('wishlists/create');
Route::post('/wishlists/store', [WishListsController::class, 'store'])->name('/wishlists/store');
Route::delete('/wishlists/{wishList}',[WishListsController::class, 'destroy'])->name('wishlists-destroy');

Route::get('/libraries', [LibraryController::class, 'index'])->name('libraries');
Route::get('/libraries/create', [LibraryController::class, 'create'])->name('libraries/create');
Route::post('/libraries/store', [LibraryController::class, 'store'])->name('/libraries/store');
Route::delete('/libraries/{library}',[LibraryController::class, 'destroy'])->name('destroy');
