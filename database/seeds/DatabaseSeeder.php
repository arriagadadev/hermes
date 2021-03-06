<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(DeviceTypesTableSeeder::class);
        $this->call(TechnologyTypesTableSeeder::class);
        $this->call(DisplayModesTableSeeder::class);
        $this->call(FunctionTypesTableSeeder::class);
        $this->call(VariablesTableSeeder::class);
        $this->call(UnitsOfMeasurementTableSeeder::class);
    }
}
