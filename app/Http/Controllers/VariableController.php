<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variable;
use App\UnitOfMeasurement;

class VariableController extends Controller
{
    public function getVariables(Request $request){
        $variables = Variable::select('id', 'name')->get();
        foreach($variables as $variable){
            $variable->units_of_measurement = UnitOfMeasurement::select('id', 'name', 'symbol')
            ->where('variable_id', $variable->id)
            ->get();
        }

        return [
            "variables" => $variables
        ];
    }
}
