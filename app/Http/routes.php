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

Route::get('/', 'SitesController@homepage');

// Route::get('/start', 'HomeController@start');
Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/explore/{tag_name?}', ['as' => 'explore','uses'=>'SitesController@explore']);


Route::get('/image/{storage}/{name}',['as'=>'image','uses' =>'ImageController@image'] );
Route::any('/video/{video}/{series}',['as'=>'video','uses' =>'ImageController@video'] );


/*
    prefix: /tag
    route list:
    - /tag/index                tag::index  
    - /tag/delete/{id}          tag::delete  
    - /tag/edit/{id}            tag::edit  
    - /tag/update/{id}          tag::update  
    - /tag/store                tag::store  
*/
Route::group(['prefix' => 'tag' ,'as' => 'tag::'], function () {
    Route::get('index', ['as' => 'index','uses'=>'TagController@index']);
    Route::get('delete/{id}', ['as' => 'delete','uses'=>'TagController@destroy']);
    Route::get('edit/{id}', ['as' => 'edit','uses'=>'TagController@edit']);
    Route::post('store', ['as' => 'store','uses'=>'TagController@store']);
    Route::put('update/{id}', ['as' => 'update','uses'=>'TagController@update']);

    Route::get('json', ['as' => 'json','uses'=>'TagController@json']);
});

/*
    prefix: /series
    route list:
    - /series/index                series::index  
    - /series/create               series::create  
    - /series/delete/{id}          series::delete  
    - /series/edit/{id}            series::edit  
    - /series/update/{id}          series::update  
    - /series/store                series::store  
    - /series/image/{name}         series::image  
*/
Route::group(['prefix' => 'series' ,'as' => 'series::'], function () {
    Route::get('index', ['as' => 'index','uses'=>'SeriesController@index']);
    Route::get('create', ['as' => 'create','uses'=>'SeriesController@create']);
    Route::get('delete/{id}', ['as' => 'delete','uses'=>'SeriesController@destroy']);
    Route::get('edit/{id}', ['as' => 'edit','uses'=>'SeriesController@edit']);
    Route::post('store', ['as' => 'store','uses'=>'SeriesController@store']);
    Route::put('update/{id}', ['as' => 'update','uses'=>'SeriesController@update']);

    Route::get('{slug}/{id}', ['as' => 'view','uses'=>'SeriesController@view']);

    Route::get('image/{name}', ['as' => 'image','uses'=>'SeriesController@image']);
});

/*
    prefix: /lessons
    route list:
    - /lessons/index                        lessons::index  
    - /lessons/create/{slug}/{series_id}    lessons::create  
    - /lessons/delete/{id}                  lessons::delete  
    - /lessons/edit/{id}                    lessons::edit  
    - /lessons/update/{id}                  lessons::update  
    - /lessons/store/{series_id}            lessons::store  
    - /lessons/image/{name}                 lessons::image  
*/
Route::group(['prefix' => 'lessons' ,'as' => 'lessons::'], function () {
    Route::get('index', ['as' => 'index','uses'=>'LessonsController@index']);
    Route::get('create/{slug}/{series_id}', ['as' => 'create','uses'=>'LessonsController@create']);
    Route::get('delete/{id}', ['as' => 'delete','uses'=>'LessonsController@destroy']);
    Route::get('edit/{id}', ['as' => 'edit','uses'=>'LessonsController@edit']);
    Route::put('store/{series_id}', ['as' => 'store','uses'=>'LessonsController@store']);
    Route::put('update/{id}', ['as' => 'update','uses'=>'LessonsController@update']);

    Route::get('enrole/{id}', ['as' => 'enrole','uses'=>'LessonsController@enrole']);
    Route::put('enrole/{id}/store', ['as' => 'enrole::store','uses'=>'LessonsController@enroleStore']);
    Route::get('enrole/{id}/delete/{user_id}', ['as' => 'enrole::delete','uses'=>'LessonsController@enroleDestroy']);

    Route::get('/watching/{id}', ['as' => 'watching','uses'=>'LessonsController@onWatching']);
    Route::get('/{slug}/{id}', ['as' => 'view','uses'=>'LessonsController@view']);
});

/*
    prefix: /user
    route list:
    - /user/index                           user::index  
    - /user/create                          user::create  
    - /user/delete/{id}                     user::delete  
    - /user/change/role/{id}                user::change::role  
    - /user/change/role/{id}/store          user::change::role::store  
    - /user/change/password/{id}            user::change::password  
    - /user/change/password/{id}/store      user::change::password::store  
    - /user/store                           user::store  
*/
Route::group(['prefix' => 'user' ,'as' => 'user::'], function () {
    Route::get('index', ['as' => 'index','uses'=>'UserController@index']);
    Route::get('create', ['as' => 'create','uses'=>'UserController@create']);
    Route::get('delete/{id}', ['as' => 'delete','uses'=>'UserController@destroy']);
    Route::post('store', ['as' => 'store','uses'=>'UserController@store']);
    
    Route::get('change/role/{id}', ['as' => 'change::role','uses'=>'UserController@changeRole']);
    Route::put('change/role/{id}/store', ['as' => 'change::role::store','uses'=>'UserController@storeRole']);

    Route::get('change/password/{id}', ['as' => 'change::password','uses'=>'UserController@changePassword']);
    Route::put('change/password/{id}/store', ['as' => 'change::password::store','uses'=>'UserController@storePassword']);

    Route::get('json', ['as' => 'json','uses'=>'UserController@json']);
});

/*
    prefix: /issue
    route list:
    - /issue/index                issue::index  
    - /issue/create               issue::create  
    - /issue/delete/{id}          issue::delete  
    - /issue/edit/{id}            issue::edit  
    - /issue/update/{id}          issue::update  
    - /issue/store                issue::store  
    - /issue/image/{name}         issue::image  
*/
Route::group(['prefix' => 'issue' ,'as' => 'issue::'], function () {
    Route::get('index', ['as' => 'index','uses'=>'IssuesController@index']);
    Route::get('delete/{id}', ['as' => 'delete','uses'=>'IssuesController@destroy']);
    Route::post('store', ['as' => 'store','uses'=>'IssuesController@store']);
});


/*
    prefix: /category
    route list:
    - /category/index                category::index  
    - /category/delete/{id}          category::delete  
    - /category/edit/{id}            category::edit  
    - /category/update/{id}          category::update  
    - /category/store                category::store  
*/
Route::group(['prefix' => 'category' ,'as' => 'category::'], function () {
    Route::get('index', ['as' => 'index','uses'=>'CategoryController@index']);
    Route::get('delete/{id}', ['as' => 'delete','uses'=>'CategoryController@destroy']);
    Route::get('edit/{id}', ['as' => 'edit','uses'=>'CategoryController@edit']);
    Route::post('store', ['as' => 'store','uses'=>'CategoryController@store']);
    Route::put('update/{id}', ['as' => 'update','uses'=>'CategoryController@update']);
});


/*
    prefix: /profile
    route list:
    - /profile/index                profile::index  
    - /profile/delete/{id}          profile::delete  
    - /profile/edit/{id}            profile::edit  
    - /profile/update/{id}          profile::update  
    - /profile/store                profile::store  
*/
Route::group(['prefix' => 'profile' ,'as' => 'profile::'], function () {
    Route::get('edit/{id}', ['as' => 'edit','uses'=>'ProfileController@edit']);
    Route::get('view/{name?}/{user_id?}', ['as' => 'view','uses'=>'ProfileController@view']);
    Route::put('update/{id}', ['as' => 'update','uses'=>'ProfileController@update']);
});
