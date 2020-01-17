<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitOfMeasurement extends Model
{
    protected $fillable = ['name', 'unit', 'variable_id'];
}
