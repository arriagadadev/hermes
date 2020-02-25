<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slot;
use App\Node;

class SlotController extends Controller
{
    public function getSlots(Request $request){
        $slots = Slot::select(
            'slots.id',
            'slots.alias',
            'units_of_measurement.name as unit_of_measurement_name',
            'units_of_measurement.unit as unit_of_measurement_symbol',
            'variables.name as variable_name',
            'display_modes.name as display_mode_name',
            'slots.parameter_name',
            'slots.active'
        )
        ->join('units_of_measurement', 'slots.unit_of_measurement_id', '=', 'units_of_measurement.id')
        ->join('variables', 'units_of_measurement.variable_id', '=', 'variables.id')
        ->join('display_modes', 'slots.display_mode_id', '=', 'display_modes.id')
        ->where('slots.device_id', $request->device)
        ->get();

        return [
            "slots" => $slots
        ];
    }
}