<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DisplayMode;

class DisplayModeController extends Controller
{
    public function getDisplayModes(Request $request){
        $displayModes = DisplayMode::select('id', 'name')->get();

        return [
            'displayModes' => $displayModes
        ];
    }
}
