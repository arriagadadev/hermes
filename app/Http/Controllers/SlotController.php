<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Slot;
use App\Device;
use App\Organization;

class SlotController extends Controller
{
    public function getSlots(Request $request){
        $device = Device::select('devices.id')
        ->join('organizations','devices.organization_id','=','organizations.id')
        ->where('devices.identifier', $request->device)
        ->where('organizations.slug', $request->organization)->first();

        $slots = Slot::select(
            'slots.id',
            'slots.alias',
            'units_of_measurement.name as unit_of_measurement_name',
            'units_of_measurement.symbol as unit_of_measurement_symbol',
            'variables.name as variable_name',
            'display_modes.name as display_mode_name',
            'slots.parameter_name',
            'slots.active'
        )
        ->join('units_of_measurement', 'slots.unit_of_measurement_id', '=', 'units_of_measurement.id')
        ->join('variables', 'units_of_measurement.variable_id', '=', 'variables.id')
        ->join('display_modes', 'slots.display_mode_id', '=', 'display_modes.id')
        ->where('slots.device_id', $device->id)
        ->get();

        return [
            "slots" => $slots
        ];
    }

    public function getSlot(Request $request){
        $organization = Organization::select('id')
        ->where('slug', $request->organization)
        ->first();
        $device = Device::select('id')
        ->where('identifier', $request->device)
        ->where('organization_id', $organization->id)
        ->first();

        $slot = Slot::select(
            'slots.id',
            'slots.alias',
            'slots.unit_of_measurement_id',
            'units_of_measurement.name as unit_of_measurement_name',
            'units_of_measurement.symbol as unit_of_measurement_symbol',
            'variables.name as variable_name',
            'units_of_measurement.variable_id',
            'slots.display_mode_id',
            'display_modes.name as display_mode_name',
            'slots.parameter_name',
            'slots.active',
            'slots.title',
            'slots.color'
        )
        ->join('units_of_measurement', 'slots.unit_of_measurement_id', '=', 'units_of_measurement.id')
        ->join('variables', 'units_of_measurement.variable_id', '=', 'variables.id')
        ->join('display_modes', 'slots.display_mode_id', '=', 'display_modes.id')
        ->where('slots.parameter_name', $request->slot)
        ->where('device_id', $device->id)
        ->first();

        return [
            "slot" => $slot
        ];
    }

    public function deleteSlot(Request $request){
        $organization = Organization::select('id')
        ->where('slug', $request->organization)
        ->first();
        $device = Device::select('id')
        ->where('identifier', $request->device)
        ->where('organization_id', $organization->id)
        ->first();
        $slot = Slot::where('slots.parameter_name', $request->slot)
        ->where('device_id', $device->id)
        ->delete();
        return [
            "slot" => $slot
        ];
    }

    public function storeSlot(Request $request){
        $organization = Organization::select('id')
        ->where('slug', $request->organization)
        ->first();
        $device = Device::select('id')
        ->where('identifier', $request->device)
        ->where('organization_id', $organization->id)
        ->first();
        $request->device = $device;
        
        $validatedData = $request->validate($this->getValidations($request));
        $slot = new Slot;
        $slot->alias = $validatedData['slot']['alias'];
        $slot->parameter_name = $validatedData['slot']['parameter_name'];
        $slot->title = $validatedData['slot']['title'];
        $slot->color = $validatedData['slot']['color'];
        $slot->active = $validatedData['slot']['active'];
        $slot->unit_of_measurement_id = $validatedData['slot']['unit_of_measurement_id'];
        $slot->display_mode_id = $validatedData['slot']['display_mode_id'];
        $slot->device_id = $device->id;
        $slot->save();
        $slot->variable_id = $validatedData['slot']['variable_id'];

        return [
            'slot' => $slot
        ];
    }

    public function updateSlot(Request $request){
        $organization = Organization::select('id')
        ->where('slug', $request->organization)
        ->first();
        $device = Device::select('id')
        ->where('identifier', $request->device)
        ->where('organization_id', $organization->id)
        ->first();
        $request->device = $device;
        
        $validatedData = $request->validate($this->getValidations($request));
        $slot = Slot::findOrFail($request->slot['id']);
        $slot->alias = $validatedData['slot']['alias'];
        $slot->parameter_name = $validatedData['slot']['parameter_name'];
        $slot->title = $validatedData['slot']['title'];
        $slot->color = $validatedData['slot']['color'];
        $slot->active = $validatedData['slot']['active'];
        $slot->unit_of_measurement_id = $validatedData['slot']['unit_of_measurement_id'];
        $slot->display_mode_id = $validatedData['slot']['display_mode_id'];
        $slot->device_id = $device->id;
        $slot->save();
        $slot->variable_id = $validatedData['slot']['variable_id'];

        return [
            'slot' => $slot
        ];
    }

    private function getValidations(Request $request){
        $validations = [
            'slot.alias' => 'required',
            'slot.unit_of_measurement_id' => 'required|integer|min:0|not_in:0',
            'slot.variable_id' => 'required|integer|min:0|not_in:0',
            'slot.display_mode_id' => 'required|integer|min:0|not_in:0',
            'slot.active' => 'nullable|boolean',
            'slot.title' => 'required|string',
            'slot.color' => 'nullable|string'
        ];

        //The parameter name must be unique in the device
        $validations['slot.parameter_name'] = Rule::unique('slots', 'parameter_name')
            ->where(function ($query) use ($request){
                return $query->where('device_id', $request->device->id);
            });

        //If we are updating the slot, we must ignore it in the validation
        if($request->isMethod('put')){
            if(isset($request->slot['id'])){
                $validations['slot.parameter_name'] = $validations['slot.parameter_name']
                    ->ignore($request->slot['id']);
            }
        }

        return $validations;
    }
}