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

Route::post('/insert_data/{name}/{email}/{password}', 'CobaController@insert_user');

Route::get('update_data/{id}/{name}/{email}/{password}', 'CobaController@update_data');

Route::get('delete_data/{id}', 'CobaController@delete_data');

Route::get('get_data_article', 'CobaController@get_data_article');

Route::get('get_insert_article/{title}/{body}/{images}', 'CobaController@get_insert_article');

Route::get('updateArticle/{id}/{title}/{body}/{images}', 'CobaController@get_update_article');

Route::get('deleteArticle/{id}', 'CobaController@get_delete_article');

// Route::post('/testpost',function(){
// 	return "Post received";
// 	});



