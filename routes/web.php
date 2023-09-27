<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;

use App\Models\products;
use App\Models\orders;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/catalog', function () {
    $products = Products::all();
    return view('catalog', )->with('products', $products);
})->name('catalog');

Route::get('/about', function(){
    return view('about');
})->name('about');

Route::get('/my_orders', function(){
    $orders = Orders::where('user_id', Auth::user()->id)->get();
    return view('my_orders')->with('orders', $orders);
})->name('my_orders');

Route::get('/reviews', [ReviewController::class, 'review'])->name('reviews');
Route::post('/reviews', [ReviewController::class, 'create_review'])->name('create_review');

Route::post('/order', [OrderController::class, 'make_order'])->name("make_order");

Auth::routes();
Route::get('/logout', [LoginController::class, 'logout'])->name('log_out');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
