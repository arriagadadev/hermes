<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;

class AppController extends Controller
{
    public function index(Request $request){
    	$organization = Organization::select('id', 'name', 'slug')
    	->where('slug', $request->organization)
    	->first();
    	return view('app', ["organization" => $organization]);
    }
}
