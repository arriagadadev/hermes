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
	Route::get('/organization/{organization}/devices', 'DeviceController@getDevices');

	//Device
	Route::get('/organization/{organization}/device/{device}', 'DeviceController@getDevice');
	Route::post('/organization/{organization}/device', 'DeviceController@storeDevice');
	Route::put('/organization/{organization}/device', 'DeviceController@updateDevice');

	//Slots
	Route::get('/organization/{organization}/device/{device}/slots', 'SlotController@getSlots');
	Route::get('/organization/{organization}/device/{device}/slot/{slot}', 'SlotController@getSlot');
	Route::post('/organization/{organization}/device/{device}/slot', 'SlotController@storeSlot');
	Route::put('/organization/{organization}/device/{device}/slot', 'SlotController@updateSlot');

	//Technology types
	Route::get('/technology-types', 'TechnologyTypeController@getTechnologyTypes');

	//Device types
	Route::get('/device-types', 'DeviceTypeController@getDeviceTypes');

	//Icons
	Route::get('/icons', 'IconController@getIcons');

	//Variables
	Route::get('/variables', 'VariableController@getVariables');

	//Display modes
	Route::get('/display-modes', 'DisplayModeController@getDisplayModes');

	//Selector
	Route::get('/', 'OrganizationSelectorController@index');

	//App
	Route::get('/organization/{organization}', 'AppController@index');
});