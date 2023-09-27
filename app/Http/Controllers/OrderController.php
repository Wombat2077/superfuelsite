<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Products_orders;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
        /* address: "1212121"
        first_name: "1212"
        last_name: "12121"
        passport_id: "2121"
        product_id: "0"
        product_count: "1"
        ​​ */
    function make_order(Request $request){


            $product_id = $request->input('product_id');
            $product = Products::find($product_id);
            $product_count = $request->input('product_count');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $passport_id = $request->input('passport_id');
            $address = $request->input('address');
            $user_id = Auth::user()==null?1:Auth::user()->id; //debug statement - delete later
            $status = 0;
            $order = Orders::create([
                'user_id' => $user_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'passport_id' => $passport_id,
                'address' => $address,
                'summary_cost' => $product->cost*$product_count,
                'status' => $status
            ]);
            $order = $order->fresh();
            Products_orders::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'product_count' => $product_count
            ]);
            return response()->json(["status" => "success"], 200, ["Content-type" => "text/plain",]);


    }
}
