<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Products::where('on_home', 1)->get();
        return view('home')->with('products', $products);
    }
}
