<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileInfo;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfilesController extends Controller
{
    public function index($slug) {
        $user = User::where('slug', $slug)->first();

//        dd($user);

        return view('profiles.profile')->with('user', $user);
    }

    public function edit($slug) {
        $user = User::where('slug', $slug)->first();
        return view('profiles.edit')->with('info', $user->profile);
    }

    public function update($slug, Request $request) {
        $user = User::where('slug', $slug)->first();
        $profile = Profile::find($user->profile->id);

        $this->validate($request, [
            'location' => 'required',
            'about' => 'required'
        ]);

        if($request->hasFile('avatar')){
            $user->update([
                'avatar' => $request->avatar->store('/public/avatars')
            ]);
        }

        $profile->location = $request->location;
        $profile->about = $request->about;

        $profile->update();

        Session::flash('success', 'Profile updated successfully');
        return redirect()->back();

    }

}
