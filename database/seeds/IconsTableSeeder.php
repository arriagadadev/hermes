<?php

use Illuminate\Database\Seeder;
use App\Icon;

class IconsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Icon::create([
            "name" => "Pin",
            "src" => "/map-icons/pin",
        ]);
        Icon::create([
            "name" => "Car",
            "src" => "/map-icons/car"
        ]);
        Icon::create([
            "name" => "Truck",
            "src" => "/map-icons/truck"
        ]);
        Icon::create([
            "name" => "Cistern truck",
            "src" => "/map-icons/cistern-truck"
        ]);
        Icon::create([
            "name" => "Bus",
            "src" => "/map-icons/bus"
        ]);
        Icon::create([
            "name" => "Motorcycle",
            "src" => "/map-icons/motorcycle"
        ]);
        Icon::create([
            "name" => "Bike",
            "src" => "/map-icons/bike"
        ]);
        Icon::create([
            "name" => "Pedestrian",
            "src" => "/map-icons/pedestrian"
        ]);
        Icon::create([
            "name" => "Fire truck",
            "src" => "/map-icons/fire-truck"
        ]);
        Icon::create([
            "name" => "Ambulance",
            "src" => "/map-icons/ambulance"
        ]);
        Icon::create([
            "name" => "Pet",
            "src" => "/map-icons/pet"
        ]);
        Icon::create([
            "name" => "Police car",
            "src" => "/map-icons/police"
        ]);
        Icon::create([
            "name" => "Ship",
            "src" => "/map-icons/ship"
        ]);
        Icon::create([
            "name" => "Taxi",
            "src" => "/map-icons/taxi"
        ]);
    }
}
