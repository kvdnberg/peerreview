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

Route::get('developers/{sortby?}/{order?}', array('as' => 'developers', 'uses' =>'DevelopersController@index'));
Route::get('developers/add', array('as' => 'developers_add', 'uses' => 'DevelopersController@create'));
Route::get('developers/edit/{id}', array('as' => 'developers_edit', 'uses' => 'DevelopersController@edit'));
Route::post('developers', 'DevelopersController@store');
