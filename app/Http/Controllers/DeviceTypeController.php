<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceType;

class DeviceTypeController extends Controller
{
    public function getDeviceTypes(Request $request){
    	return [
    		"deviceTypes" => DeviceType::select('id','name')->get()
    	];
    }
}
