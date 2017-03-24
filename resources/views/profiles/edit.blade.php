@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Your Profile</div>

                    <div class="panel-body">
                        <form action="{{ route('profile.update', ['slug' => $info->user->slug])  }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label for="upload" class="control-label">Upload Avatar</label>
                                <input type="file" name="avatar" class="form-control" accept="image/*">
                            </div>


                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location" class="control-label">Location</label>

                                <input id="location" type="text" class="form-control" name="location" value="{{ !empty(old('location')) ? old('location') : $info->location }}" >

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="about" class="control-label">About Me</label>
                                <textarea name="about" cols="30" rows="10" class="form-control"> {{ !empty(old('about')) ? old('about') : $info->about }} </textarea>

                                @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <p class="text-center">
                                    <button class="btn btn-primary btn-lg" type="submit">Save your information</button>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection