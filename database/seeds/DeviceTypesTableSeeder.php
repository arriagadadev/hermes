<?php

use Illuminate\Database\Seeder;
use App\DeviceType;

class DeviceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeviceType::create(['name' => 'Gateway', 'description' => '']);
        DeviceType::create(['name' => 'Transmitter', 'description' => '']);
        DeviceType::create(['name' => 'Receiver', 'description' => '']);
        DeviceType::create(['name' => 'Transmitter and receiver', 'description' => '']);
    }
}
