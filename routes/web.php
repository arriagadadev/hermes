<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::group(['middleware' => ['auth']], function () {
	Route::get('/user', 'UserController@getUserInformation');
	Route::put('/user', 'UserController@updateUserInformation');
	Route::put('/change-password', 'UserController@changePassword');

	//devices
	Route::get('/organization/{id}/devices', 'DeviceController@getDevices');

	//selector
	Route::get('/', 'OrganizationSelectorController@index');

	//App
	Route::get('/organization/{organization}', 'AppController@index');
});