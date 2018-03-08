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

Route::get('/get_data', 'CobaController@get_data');

Route::get('insert_data/{name}/{email}/{password}', 'CobaController@insert_user');
Route::get('update_data/{id}/{name}/{email}/{password}', 'CobaController@update_data');
Route::get('delete_data/{id}', 'CobaController@delete_data');
