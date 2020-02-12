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

	//Devices
	Route::get('/organization/{id}/devices', 'DeviceController@getDevices');

	//Device
	Route::get('/device/{id}', 'DeviceController@getDevice');
	Route::post('/device', 'DeviceController@storeDevice');
	Route::put('/device', 'DeviceController@updateDevice');

	//Technology types
	Route::get('/technology-types', 'TechnologyTypeController@getTechnologyTypes');

	//Device types
	Route::get('/device-types', 'DeviceTypeController@getDeviceTypes');

	//Selector
	Route::get('/', 'OrganizationSelectorController@index');

	//App
	Route::get('/organization/{organization}', 'AppController@index');
});