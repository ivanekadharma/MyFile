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

Route::post('/', function () {
    return view('welcome');
});

Route::post('/get_data', 'CobaController@get_data');

Route::post('insert_data', 'CobaController@insert_user');

//Route::get('/insert_data/{name}/{email}/{password}', 'CobaController@insert_user');

Route::post('update_data', 'CobaController@update_data');
// Route::get('update_data/{id}/{name}/{email}/{password}', 'CobaController@update_data');
Route::post('delete_data', 'CobaController@delete_data');
// Route::get('delete_data/{id}', 'CobaController@delete_data');

Route::get('get_data_article', 'CobaController@get_data_article');

Route::get('get_insert_article/{title}/{body}/{images}', 'CobaController@get_insert_article');

Route::get('updateArticle/{id}/{title}/{body}/{images}', 'CobaController@get_update_article');

Route::get('deleteArticle/{id}', 'CobaController@get_delete_article');

Route::post('/pulsa', 'CobaController@pulsa');
//Route::get('/insert_pulsa/')

Route::post('/wallet', 'CobaController@wallet');

Route::get('test', 'CobaController@test');

//Route::get('/minus/{id}', 'CobaController@minus');

Route::post('/pulsa_operators', 'CobaController@pulsa_operators');
Route::get('/getOperator','CobaController@getOperator');
Route::post('wallet_minus', 'CobaController@wallet_minus');

Route::post('wallet_plus', 'CobaController@wallet_plus');

// Route::group(['middleware' => ['api','cors'], 'prefix' => 'api'], function(){
// 			Route::post('register','CobaController@register');
// 			Route::post('login','CobaController@login');
// 			Route::group(['middleware'=> 'jwt-auth'], function(){
// 			Route::post('get_user_details', 'CobaController@get_user_details');
// 				});
// });

Route::post('login','CobaController@login');
// 192.168.1.102/ivan/public/register
// parameter:   'email',
// 				'name',
// 				'password',
// 				'phoneNumb'



Route::post('get_user_details', 'CobaController@get_user_details');
Route::post('register','CobaController@register');



Route::get('test2', 'CobaController@test2');