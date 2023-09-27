<?php

namespace App\Http\Controllers;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function create_review(Request $request){
        $content = $request->input('content');
        $user = Auth::user();
        Comments::create([
            'content' => $content,
            'user_id' => $user->id
        ]);
        return back();
    }
    function review(){
        $comments = Comments::all();
        return view("reviews")->with("comments", $comments);
    }
}
