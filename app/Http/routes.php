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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/start', 'HomeController@start');
Route::auth();

Route::get('/home', 'HomeController@index');


//tag
Route::group(['prefix' => 'tag' ,'as' => 'tag::'], function () {
    Route::get('index', ['as' => 'index','uses'=>'TagController@index']);
    Route::get('delete/{id}', ['as' => 'delete','uses'=>'TagController@destroy']);
    Route::get('edit/{id}', ['as' => 'edit','uses'=>'TagController@edit']);
    Route::post('store', ['as' => 'store','uses'=>'TagController@store']);
    Route::put('update/{id}', ['as' => 'update','uses'=>'TagController@update']);
});
