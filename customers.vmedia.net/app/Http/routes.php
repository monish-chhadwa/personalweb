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

//Route::get('/', 'MainController@index');
Route::get('/home', [
    'middleware'=>'auth',
    'uses'=>'MainController@home'
]);


//Route::post('/', 'MainController@');
Route::get('customers/create', 'CustomersController@create');
Route::post('customers','CustomersController@store');
Route::get('customers','CustomersController@index');
Route::get('customers/{id}','CustomersController@show');
Route::get('customers/{id}/edit','CustomersController@edit');
Route::patch('customers/{id}','CustomersController@update');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
