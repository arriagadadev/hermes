<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function devices(){
    	return $this->hasMany('App\Device');
    }

    public function deviceTemplates(){
    	return $this->hasMany('App\DeviceTemplate');
    }
}
