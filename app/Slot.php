<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    public function device(){
    	return $this->belongsTo('App\Device');
    }
}
