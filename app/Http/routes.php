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
    return redirect('/home');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/admin', 'AdminController@index');

Route::get('/post','PostController@indexFront');

Route::get('/post/{link}','PostController@link');

Route::resource('/admin/user', 'UserController');

Route::resource('/admin/post', 'PostController');

Route::controller('/admin', 'RoleController');



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);