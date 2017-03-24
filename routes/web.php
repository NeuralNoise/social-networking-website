<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');




Route::group(['middleware' => 'auth'], function () {
    Route::get('profile/{slug}', 'ProfilesController@index')->name('profile');
    Route::get('profile/edit/{slug}', 'ProfilesController@edit')->name('profile.edit');
    Route::post('profile/edit/{slug}', 'ProfilesController@update')->name('profile.update');

    Route::get('/add', function() {
        return \App\User::find(3)->addFriend(1);
    });

    Route::get('/accept', function() {
        return \App\User::find(3)->acceptFriend(1);
    });

    Route::get('/friends', function() {
        return \App\User::find(1)->friends();
    });

    Route::get('/pending', function() {
        return \App\User::find(2)->pendingRequestsId();
    });

    Route::get('/is-friend', function() {
        return \App\User::find(1)->isFriendsWith(4);
    });

    Route::get('check_relationship_status/{id}', 'FriendshipController@check');
    Route::get('add_friend/{id}', 'FriendshipController@addFriend');
    Route::get('accept_friend/{id}', 'FriendshipController@acceptFriend');

    Route::get('/get_unread', function() {
        return Auth::user()->unreadNotifications;
    });



});