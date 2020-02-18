<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Device;
use App\Measurement;

class DeviceController extends Controller
{

    public function getDevices(Request $request){
    	$devices = Device::select(
    		'devices.id',
    		'devices.identifier',
    		'devices.alias',
    		'technology_types.name as technology_type',
    		'device_types.name as device_type'
    		)
    	->join('technology_types','devices.technology_type_id','=','technology_types.id')
    	->join('device_types','devices.device_type_id','=','device_types.id')
    	->where('devices.organization_id',$request->id);

        if($request->filter){
            $devices = $devices->where(function ($query) use ($request) {
                        $query->where('devices.alias', 'like', '%'.$request->filter.'%')
                              ->orWhere('devices.identifier', 'like', '%'.$request->filter.'%');
                        });
        }
    	$devices = $devices->paginate(5);

    	return $devices;
    }

    public function getDevice(Request $request){
        $device = Device::select(
            'devices.id',
            'devices.identifier',
            'devices.alias',
            'devices.scope',
            'devices.active',
            'devices.has_gps',
            'devices.technology_type_id',
            'devices.device_type_id',
            'devices.icon_id',
            'icons.name as icon_name',
            'icons.src as icon_src',
            'devices.latitude',
            'devices.longitude',
            'devices.altitude',
            'technology_types.name as technology_type',
            'device_types.name as device_type',
            'devices.organization_id'
            )
        ->join('technology_types','devices.technology_type_id','=','technology_types.id')
        ->join('device_types','devices.device_type_id','=','device_types.id')
        ->join('icons','devices.icon_id','=','icons.id')
        ->where('devices.id',$request->id)->first();

        if($device){
            $lastMeasurement = Measurement::select('measurements.created_at')
            ->join('slots','measurements.slot_id','=','slots.id')
            ->where('slots.device_id', $device->id)
            ->orderBy('measurements.id','desc')
            ->first();
            if($lastMeasurement){
                $device->last_seen = $lastMeasurement->created_at->diffForHumans();
            }else{
                $device->last_seen = null;
            }
        }

        return [
            'device' => $device
        ];
    }

    public function storeDevice(Request $request){
        $validatedData = $request->validate($this->getValidations($request));
        $device = new Device;
        $device->identifier = $validatedData['device']['identifier'];
        $device->alias = $validatedData['device']['alias'];
        $device->scope = $validatedData['device']['scope'];
        $device->device_type_id = $validatedData['device']['device_type_id'];
        $device->technology_type_id = $validatedData['device']['technology_type_id'];
        $device->active = $validatedData['device']['active'];
        $device->has_gps = $validatedData['device']['has_gps'];
        $device->latitude = $validatedData['device']['latitude'];
        $device->longitude = $validatedData['device']['longitude'];
        $device->altitude = $validatedData['device']['altitude'];
        $device->organization_id = $validatedData['device']['organization_id'];
        $device->icon_id = $validatedData['device']['icon_id'];
        $device->save();
        return [
            'device' => $device
        ];
    }

    public function updateDevice(Request $request){
        $validatedData = $request->validate($this->getValidations($request));
        $device = Device::findOrFail($request->device['id']);
        $device->identifier = $request->device['identifier'];
        $device->alias = $request->device['alias'];
        $device->scope = $request->device['scope'];
        $device->device_type_id = $request->device['device_type_id'];
        $device->technology_type_id = $request->device['technology_type_id'];
        $device->active = $request->device['active'];
        $device->has_gps = $request->device['has_gps'];
        $device->latitude = $request->device['latitude'];
        $device->longitude = $request->device['longitude'];
        $device->altitude = $request->device['altitude'];
        $device->icon_id = $validatedData['device']['icon_id'];
        $device->save();
        return [
            'device' => $device
        ];
    }

    private function getValidations(Request $request){
        $validations = [
            'device.id' => 'integer',
            'device.alias' => 'required',
            'device.scope' => 'integer',
            'device.device_type_id' => 'integer',
            'device.technology_type_id' => 'integer',
            'device.organization_id' => 'integer',
            'device.has_gps' => 'boolean',
            'device.active' => 'boolean',
            'device.latitude' => 'nullable',
            'device.longitude' => 'nullable',
            'device.altitude' => 'nullable',
            'device.icon_id' => 'nullable|integer'
        ];

        //The identifier must be unique in the organization
        $validations['device.identifier'] = Rule::unique('devices', 'identifier')
            ->where(function ($query) use ($request){
                return $query->where('organization_id', $request->device['organization_id']);
            });

        //If we are updating the device, we must ignore it in the validation
        if($request->isMethod('put')){
            if(isset($request->device['id'])){
                $validations['device.identifier'] = $validations['device.identifier']
                    ->ignore($request->device['id']);
            }
        }

        return $validations;
    }
}
