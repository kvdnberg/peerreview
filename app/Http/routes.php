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
Route::get('edit/{id?}', ['middleware' => 'auth.basic', 'uses' => 'PeerReviewController@edit']);
Route::get('developers/add', ['middleware' => 'auth.basic', 'as' => 'addDeveloper', 'uses' => 'DevelopersController@create']);
Route::get('developers/edit/{id}', ['middleware' => 'auth.basic', 'as' => 'editDeveloper', 'uses' => 'DevelopersController@edit']);
Route::post('developers/update/{id}', ['middleware' => 'auth.basic', 'as' => 'updateDeveloper', 'uses' => 'DevelopersController@update']);
Route::post('developers', ['middleware' => 'auth.basic', 'uses' =>'DevelopersController@store']);

Route::get('developers/{sortby?}/{order?}', ['middleware' => 'auth.basic', 'as' => 'showDevelopers', 'uses' =>'DevelopersController@index']);

Route::post('saveReviewBoard', ['middleware' => 'auth.basic','uses' => 'PeerReviewController@store']);

Route::get('gitHub', 'GitHubStatsController@index');

Route::get('gitHubRepos', ['as' => 'gitHubRepos', 'uses' => 'GitHubStatsController@sortedRepositoriesCall']);
