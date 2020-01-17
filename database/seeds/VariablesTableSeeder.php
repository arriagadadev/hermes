<?php

use Illuminate\Database\Seeder;
use App\Variable;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Variable::create(['name' => 'Temperature', 'description' => '']); //1
        Variable::create(['name' => 'Pressure', 'description' => '']); //2
        Variable::create(['name' => 'RH', 'description' => '']); //3
        Variable::create(['name' => 'Level', 'description' => '']); //4
        Variable::create(['name' => 'Voltage', 'description' => '']); //5
        Variable::create(['name' => 'Electric current', 'description' => '']); //6
        Variable::create(['name' => 'Revolutions', 'description' => '']); //7
        Variable::create(['name' => 'State', 'description' => '']); //8
        Variable::create(['name' => 'Speed', 'description' => '']); //9
        Variable::create(['name' => 'Distance', 'description' => '']); //10
    }
}
