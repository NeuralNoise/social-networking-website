<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Events\NewPostCreated;

class PostsController extends Controller
{
    public function store(Request $request){
        $post =  Post::create([
            'user_id' => Auth::user()->id,
            'content' => $request["content"]
        ]);

        $post = Post::find($post->id);

        broadcast(new NewPostCreated($post))->toOthers();

        return $post;

    }
}
