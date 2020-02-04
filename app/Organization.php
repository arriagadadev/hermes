<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Organization extends Model
{
	use Sluggable;

	/**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function devices(){
    	return $this->hasMany('App\Device');
    }

    public function deviceTemplates(){
    	return $this->hasMany('App\DeviceTemplate');
    }
}
