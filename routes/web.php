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

	//Nested Organization routes
	Route::prefix('/organization/{organization}')->group(function(){
		//App
		Route::get('/', 'AppController@index');
		//Devices
		Route::get('devices', 'DeviceController@getDevices');
		Route::post('device', 'DeviceController@storeDevice');
		Route::put('device', 'DeviceController@updateDevice');
		//Nested Device routes
		Route::prefix('device/{device}')->group(function(){
			Route::get('/', 'DeviceController@getDevice');
			//Slots
			Route::get('slots', 'SlotController@getSlots');
			Route::get('slot/{slot}', 'SlotController@getSlot');
			Route::delete('slot/{slot}', 'SlotController@deleteSlot');
			Route::post('slot', 'SlotController@storeSlot');
			Route::put('slot', 'SlotController@updateSlot');
		});
	});

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

	//User
	Route::get('/user', 'UserController@getUserInformation');
	Route::put('/user', 'UserController@updateUserInformation');
	Route::put('/change-password', 'UserController@changePassword');

	//Selector
	Route::get('/', 'OrganizationSelectorController@index');
});