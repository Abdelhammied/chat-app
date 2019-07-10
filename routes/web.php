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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/my-chat-rooms', 'ChatroomController@index');
    Route::get('/my-chat/{chatroom}', 'ChatroomController@show');
    Route::get('/chatroom_{chatroom_id}', 'ChatroomController@fetchChatRoomData');
    Route::post('/send_message/{chatroom_id}', 'ChatroomController@sendMessage');
});
Route::get('/home', 'HomeController@index')->name('home');
