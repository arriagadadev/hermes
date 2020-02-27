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
        UnitOfMeasurement::create(['name' => 'Celsius', 'symbol' => '°C', 'variable_id' => 1]);
        UnitOfMeasurement::create(['name' => 'Fahrenheit', 'symbol' => '°F', 'variable_id' => 1]);
        UnitOfMeasurement::create(['name' => 'Kelvin', 'symbol' => 'K', 'variable_id' => 1]);

        /*
        *	Pressure
        */
        UnitOfMeasurement::create(['name' => 'Pascal', 'symbol' => 'Pa', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Pound-force/Square inch', 'symbol' => 'psi', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Newton/m²', 'symbol' => 'N/m²', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Bar', 'symbol' => 'bar', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Torr', 'symbol' => 'Torr', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Atmosphere', 'symbol' => 'atm', 'variable_id' => 2]);
        UnitOfMeasurement::create(['name' => 'Metres of water column', 'symbol' => 'mWC', 'variable_id' => 2]);

        /*
        *	RH
        */
        UnitOfMeasurement::create(['name' => 'Percentage', 'symbol' => '%', 'variable_id' => 3]);

        /*
        *	Level
        */
        UnitOfMeasurement::create(['name' => 'Percentage', 'symbol' => '%', 'variable_id' => 4]);

        /*
        *	Voltage
        */
        UnitOfMeasurement::create(['name' => 'Volts', 'symbol' => 'V', 'variable_id' => 5]);

        /*
        *	Electric Current
        */
        UnitOfMeasurement::create(['name' => 'Current', 'symbol' => 'I', 'variable_id' => 6]);

        /*
        *	Revolutions
        */
        UnitOfMeasurement::create(['name' => 'Revolutions per hour', 'symbol' => 'rph', 'variable_id' => 7]);
        UnitOfMeasurement::create(['name' => 'Revolutions per minute', 'symbol' => 'rpm', 'variable_id' => 7]);
        UnitOfMeasurement::create(['name' => 'Revolutions per second', 'symbol' => 'rps', 'variable_id' => 7]);

        /*
        *	State
        */
        UnitOfMeasurement::create(['name' => 'On/Off', 'symbol' => '', 'variable_id' => 8]);

        /*
        *	Speed
        */
        UnitOfMeasurement::create(['name' => 'Kilometers per hour', 'symbol' => 'Km/h', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Kilometers per minute', 'symbol' => 'Km/m', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Kilometers per second', 'symbol' => 'Km/s', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Miles per hour', 'symbol' => 'mi/h', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Miles per minute', 'symbol' => 'mi/m', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Miles per second', 'symbol' => 'mi/s', 'variable_id' => 9]);
        UnitOfMeasurement::create(['name' => 'Knots', 'symbol' => 'kn', 'variable_id' => 9]);

        /*
        *	Distance
        */
        UnitOfMeasurement::create(['name' => 'Centimeters', 'symbol' => 'cm', 'variable_id' => 10]);
        UnitOfMeasurement::create(['name' => 'Metres', 'symbol' => 'm', 'variable_id' => 10]);
        UnitOfMeasurement::create(['name' => 'Yards', 'symbol' => 'yd', 'variable_id' => 10]);
        UnitOfMeasurement::create(['name' => 'Miles', 'symbol' => 'mi', 'variable_id' => 10]);
    }
}
