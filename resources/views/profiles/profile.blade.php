@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        {{ $user->name  }}'s Profile
                    </p>
                </div>
                <div class="panel-body">
                    <center>
                        <img src="{{ Storage::url($user->avatar)  }}" width="140px" height="140px" style="border-radius: 50%">

                        <div class="clear-fix"></div>

                        <br/>
                        {{ $user->profile->location  }}
                    </center>

                    <div class="clear-fix"></div>
                    <br/>
                    <p class="text-center">
                        @if(Auth::user()->id == $user->id)
                            <a href="{{ route('profile.edit', ['slug' => $user->slug])  }}" class="btn btn-lg btn-info">Edit your Profile</a>
                        @endif
                    </p>
                </div>
            </div>
            @if(Auth::user()->id != $user->id)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="body">
                            <friend :profile_user_id="{{ $user->id  }}"></friend>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        {{ $user->name  }}'s Info
                    </p>
                </div>
                <div class="panel-body">
                    <p class="text-center">
                        {{ $user->profile->about  }}
                    </p>
                </div>
            </div>
        </div>

    </div>
@stop