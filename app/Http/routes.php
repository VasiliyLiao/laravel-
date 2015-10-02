<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ChatController@index'); // 聊天室頁面
Route::post('send-message', 'ChatController@sendMessage'); // 發送訊息

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::post('hh',['as'=>'test.index','uses'=>'TestController@index']);