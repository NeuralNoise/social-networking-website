<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class FeedsController extends Controller
{
    public function feed(){
        $friends = Auth::user()->friends()->all();
        $feed = array();

        foreach ($friends as $friend) {
            $user = User::find($friend->id);

            foreach ($user->posts as $post) {
                array_push($feed, $post);
            }
        }

        foreach (Auth::user()->posts as $post){
            array_push($feed, $post);
        }


        usort($feed, function ($p1, $p2) {
            return $p1->id < $p2->id;
        });

        return $feed;

    }


    public function users_feed($id){
        $user = User::find($id);

        $feed = array();

        foreach ($user->posts as $post){
            array_push($feed, $post);
        }

        return $feed;
    }
}
