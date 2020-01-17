<?php

use Illuminate\Database\Seeder;
use App\TechnologyType;

class TechnologyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TechnologyType::create(['name' => 'WiFi', 'description' => '']);
        TechnologyType::create(['name' => 'Ethernet', 'description' => '']);
        TechnologyType::create(['name' => 'LoRa', 'description' => '']);
        TechnologyType::create(['name' => 'LoRaWan', 'description' => '']);
        TechnologyType::create(['name' => 'GSM Bands', 'description' => '']);
        TechnologyType::create(['name' => 'XBee', 'description' => '']);
    }
}
