<?php

use Illuminate\Database\Seeder;
use App\UnitOfMeasurement;

class UnitsOfMeasurementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        *	Temperature
        */
        UnitOfMeasurement::create(['name' => 'Celsius', 'unit' => '°C', 'variable_id' => 1]);
        UnitOfMeasurement::create(['name' => 'Fahrenheit', 'unit' => '°F', 'variable_id' => 1]);
        UnitOfMeasurement::create(['name' => 'Kelvin', 'unit' => 'K', 'variable_id' => 1]);

        /*
        *	Pressure
        */
        UnitOfMeasurement::create(['name' => 'Pascal', 'unit' => 'Pa', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Pound-force/Square inch', 'unit' => 'psi', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Newton/m²', 'unit' => 'N/m²', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Bar', 'unit' => 'bar', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Torr', 'unit' => 'Torr', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Atmosphere', 'unit' => 'atm', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Metres of water column', 'unit' => 'mWC', 'variable_id' => 2]);

        /*
        *	RH
        */
        UnitOfMeasurement::create(['name' => 'Percentage', 'unit' => '%', 'variable_id' => 3]);

        /*
        *	Level
        */
        UnitOfMeasurement::create(['name' => 'Percentage', 'unit' => '%', 'variable_id' => 4]);

        /*
        *	Voltage
        */
        UnitOfMeasurement::create(['name' => 'Volts', 'unit' => 'V', 'variable_id' => 5]);

        /*
        *	Electric Current
        */
        UnitOfMeasurement::create(['name' => 'Current', 'unit' => 'I', 'variable_id' => 6]);

        /*
        *	Revolutions
        */
        UnitOfMeasurement::create(['name' => 'Revolutions per hour', 'unit' => 'rph', 'variable_id' => 7]);
        UnitOfMeasurement::create(['name' => 'Revolutions per minute', 'unit' => 'rpm', 'variable_id' => 7]);
        UnitOfMeasurement::create(['name' => 'Revolutions per second', 'unit' => 'rps', 'variable_id' => 7]);

        /*
        *	State
        */
        UnitOfMeasurement::create(['name' => 'On/Off', 'unit' => '', 'variable_id' => 8]);

        /*
        *	Speed
        */
        UnitOfMeasurement::create(['name' => 'Kilometers per hour', 'unit' => 'Km/h', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Kilometers per minute', 'unit' => 'Km/m', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Kilometers per second', 'unit' => 'Km/s', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Miles per hour', 'unit' => 'mi/h', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Miles per minute', 'unit' => 'mi/m', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Miles per second', 'unit' => 'mi/s', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Knots', 'unit' => 'kn', 'variable_id' => 9]);

        /*
        *	Distance
        */
        UnitOfMeasurement::create(['name' => 'Centimeters', 'unit' => 'cm', 'variable_id' => 10]);
        UnitOfMeasurement::create(['name' => 'Metres', 'unit' => 'm', 'variable_id' => 10]);
        UnitOfMeasurement::create(['name' => 'Yards', 'unit' => 'yd', 'variable_id' => 10]);
        UnitOfMeasurement::create(['name' => 'Miles', 'unit' => 'mi', 'variable_id' => 10]);
    }
}
