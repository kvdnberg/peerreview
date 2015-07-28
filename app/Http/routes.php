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

Route::get('/', 'PeerReviewController@index');

Route::group(['middleware' => 'auth.basic'], function() {
    Route::get('edit/{id?}', ['uses' => 'PeerReviewController@edit']);
    Route::resource('developers', 'DevelopersController');
    Route::post('saveReviewBoard', ['uses' => 'PeerReviewController@store']);
    
});
