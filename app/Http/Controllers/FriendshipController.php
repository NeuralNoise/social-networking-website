<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequestAccepted;
use App\Notifications\NewFriendRequest;
use Illuminate\Http\Request;
use App\User;
use Auth;

class FriendshipController extends Controller
{

    public function check ($id)
    {
        if(Auth::user()->isFriendsWith($id) === 1) {
            return ["status" => "friends"];
        }

        if(Auth::user()->hasPendingFriendRequestSentTo($id)) {
            return ["status" => "waiting"];
        }

        if(Auth::user()->hasPendingFriendRequestFrom($id)) {
            return ["status" => "pending"];
        }

        return ["status" => 0] ;

    }

    public function addFriend($id) {
        $response =  Auth::user()->addFriend($id);

        User::find($id)->notify(new \App\Notifications\NewFriendRequest(Auth::user()));

        return $response;
    }

    public function acceptFriend($id) {
        $response =  Auth::user()->acceptFriend($id);

        User::find($id)->notify(new \App\Notifications\FriendRequestAccepted(Auth::user()));

        return $response;
    }
}
