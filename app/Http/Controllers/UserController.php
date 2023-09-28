<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function create(Request $request){
        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
        ]);
        return response()->json(["status" => "success"], 200, ["Content-type" => "text/plain",]);

    }
    //
    function update(Request $request, $id){
        $user = User::find($id);
        $user->update([
            "name" => $request->name,
            "password" => $request->password==null?$user->password:Hash::make($request->password),
            "is_admin" => $request->is_admin

        ]);
        return response()->json(["status" => "success"], 200, ["Content-type" => "text/plain",]);
    }
    function delete(Request $request, $id){
        User::find($id)->delete();
        return response()->json(["status" => "success"], 200, ["Content-type" => "text/plain",]);
    }
}
