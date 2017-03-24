<?php

namespace App\Traits;

use App\Friendship;
use App\User;
use Illuminate\Support\Facades\DB;

trait Friendable {

    public function addFriend($user_requested_id) {

        if($this->id === $user_requested_id) {
            return 0;
        }

        if($this->hasPendingFriendRequestFrom($user_requested_id)) {
            return $this->acceptFriend($user_requested_id);
        }

        if($this->hasPendingFriendRequestSentTo($user_requested_id)) {
            return "Already sent a friend Request";
        }

        if($this->isFriendsWith($user_requested_id)) {
            return "Already friends with the user";
        }

        $friendship = Friendship::create([
            'requester' => $this->id,
            'user_requested' => $user_requested_id
        ]);

        if($friendship) {
            return 1;
        }
        return 0;
    }

    public function acceptFriend($requester) {
        if($this->hasPendingFriendRequestFrom($requester) === 0) {
            return 0;
        }

        $friendship = Friendship::where('user_requested', $this->id)->where('requester', $requester)->first();

        if($friendship) {
            $friendship->update([
               'status' => 1
            ]);

            return 1;
        }
        return 0;
    }

    public function friends() {
        $userAsRequested  = collect(DB::table('users')->whereIn('id', Friendship::where('status',1)->where('requester', $this->id)->pluck('user_requested'))->get());
        $users  = $userAsRequested->merge(collect(DB::table('users')->whereIn('id', Friendship::where('status',1)->where('user_requested', $this->id)->pluck('requester'))->get()));

        return $users;
    }

    public function pendingRequest() {
        $userAsRequested  = collect(DB::table('users')->whereIn('id', Friendship::where('status',0)->where('requester', $this->id)->pluck('user_requested'))->get());
        $users  = $userAsRequested->merge(collect(DB::table('users')->whereIn('id', Friendship::where('status',0)->where('user_requested', $this->id)->pluck('requester'))->get()));
        return $users;
    }

    public function friendsIds(){
        return collect($this->friends())->pluck('id');
    }

    public function isFriendsWith($user_id) {
        if(in_array($user_id, $this->friendsIds()->toArray())){
            return 1;
        } else {
            return 0;
        }
    }

    public function pendingRequestsId() {
        return collect($this->pendingRequest())->pluck('id');
    }

    public function pendingFriendRequestsSent() {
        $users  = DB::table('users')->whereIn('id', Friendship::where('status',0)->where('requester', $this->id)->pluck('user_requested'))->get();

        return $users;
    }

    public function pendingFriendRequestsSentIds() {
        return collect($this->pendingFriendRequestsSent())->pluck('id');
    }

    public function hasPendingFriendRequestFrom($user_id) {
        if(in_array($user_id, $this->pendingRequestsId()->toArray())) {
            return 1;
        } else {
            return 0;
        }
    }

    public function hasPendingFriendRequestSentTo($user_id) {
        if(in_array($user_id, $this->pendingFriendRequestsSentIds()->toArray())) {
            return 1;
        } else {
            return 0;
        }
    }

}