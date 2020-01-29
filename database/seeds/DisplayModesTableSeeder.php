<?php

use Illuminate\Database\Seeder;
use App\DisplayMode;

class DisplayModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DisplayMode::create(['name' => 'Line Chart', 'description' => '']);
        DisplayMode::create(['name' => 'Area Chart', 'description' => '']);
        DisplayMode::create(['name' => 'Tank', 'description' => '']);
        DisplayMode::create(['name' => 'On/Off', 'description' => '']);
        DisplayMode::create(['name' => 'Number', 'description' => '']);
    }
}
