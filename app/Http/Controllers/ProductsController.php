<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;

class ProductsController extends Controller
{
    function create(Request $request){
        Products::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "cost" => $request->cost,
            "on_home" => $request->on_home,
            "home_desc" => $request->home_desc,
        ]);
        return response()->json(["status" => "success"], 200, ["Content-type" => "text/plain",]);

    }
    //
    function update(Request $request, $id){
        $product = Products::find($id);
        $product->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "cost" => $request->cost,
            "on_home" => $request->on_home,
            "home_desc" => $request->home_desc,

        ]);
        return response()->json(["status" => "success"], 200, ["Content-type" => "text/plain",]);
    }
    function delete(Request $request, $id){
        Products::find($id)->delete();
        return response()->json(["status" => "success"], 200, ["Content-type" => "text/plain",]);
    }
}

