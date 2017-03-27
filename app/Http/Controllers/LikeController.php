<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id) {
        $post = Post::find($id);

        $like =  Like::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post->id,
        ]);

        return Like::find($like->id);
    }

    public function unlike($id) {

        $like = Like::where('user_id', Auth::user()->id)
            ->where('post_id', $id)
            ->first();

        $like->delete();

        return $like->id;
    }
}
