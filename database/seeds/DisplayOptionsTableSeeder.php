<?php

use Illuminate\Database\Seeder;
use App\DisplayOption;

class DisplayOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DisplayOption::create(['name' => 'Line Chart', 'description' => '']);
        DisplayOption::create(['name' => 'Area Chart', 'description' => '']);
        DisplayOption::create(['name' => 'Tank', 'description' => '']);
        DisplayOption::create(['name' => 'On/Off', 'description' => '']);
        DisplayOption::create(['name' => 'Number', 'description' => '']);
    }
}
