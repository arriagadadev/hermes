<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationSelectorController extends Controller
{
    public function index(Request $request){
    	$organizations = DB::table('organization_permission_user')
    		->select('organizations.name','organizations.slug')
    		->join('organizations', 'organization_permission_user.organization_id','=','organizations.id')
    		->distinct()
    		->get();
    		if(count($organizations) > 1){
    			return view('/', ['organizations' => $organizations]);
    		}
    		return redirect('organization/'.$organizations->first()->slug);
    }
}
