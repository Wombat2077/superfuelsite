<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;

use App\Models\User;
use App\Models\products;
use App\Models\orders;
use App\Models\Status_table;


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
Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('/', function(){
        $usr_count = User::all()->count();
        $prd_count = Products::all()->count();
        $ord_count = Orders::all()->count();
        return view('admin.home')->with(['usr_count' => $usr_count, 'prd_count' => $prd_count, 'ord_count' => $ord_count]);
    });
    //users routes
    Route::get('/users', function(){
        $users = User::all();
        return view('admin.users')->with('users', $users);
    })->name('users');
    Route::patch('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::post('/users', [UserController::class, 'create']);
    //products routes
    Route::get('/products', function(){
        $products = Products::all();
        return view('admin.products')->with('products', $products);
    })->name('products');
    Route::patch('/products/{id}', [ProductsController::class, 'update']);
    Route::delete('/products/{id}', [ProductsController::class, 'delete']);
    Route::post('/products', [ProductsController::class, 'create']);

    //orders routes
    Route::get('/orders', function(){
        $users = User::all();
        $products = Products::all();
        $statuses = Status_table::all();
        $orders = Orders::all();
        return view('admin.orders')->with([
            "users" => $users,
            "products" => $products,
            "statuses" => $statuses,
            "orders" => $orders
        ]);
    })->name("orders");
    Route::patch('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'delete']);

});

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
