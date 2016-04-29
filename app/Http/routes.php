<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('home', 'HomeController@index');
    Route::pattern('id', '[0-9]+');
	Route::get('/', 'FrontController@index');
	Route::get('article/{id}', 'FrontController@show');
	Route::get('category/{id?}', 'FrontController@showPostByCat');
	Route::get('user/{id}/posts', 'FrontController@showPostByUser');
    Route::get('published/{post}', 'PostController@published'); 

    Route::group(['middleware' => 'auth'], function () {
    	route::resource('post','PostController');
    });
});


class Crypt 
{
    public function __construct($ip)
    {
        $this->ip = $ip;
    }
}
App::bind('ip',function($app){
    return new Crypt($app->make('request')->getClientIp());
});

$crypt = App::make('ip');
