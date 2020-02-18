<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Icon;

class IconController extends Controller
{
    public function getIcons(Request $request){
        $icons = Icon::select('id', 'name', 'src')->get();
        return [
            "icons" => $icons
        ];
    }
}
