<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function store(Request $request){
        return Post::create([
            'user_id' => Auth::user()->id,
            'content' => $request["content"]
        ]);

    }
}
