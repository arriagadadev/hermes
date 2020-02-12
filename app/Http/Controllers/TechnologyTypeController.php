<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TechnologyType;

class TechnologyTypeController extends Controller
{
    public function getTechnologyTypes(Request $request){
    	return [
    		"technologyTypes" => TechnologyType::select('id','name')->get()
    	];
    }
}
