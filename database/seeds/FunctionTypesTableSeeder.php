<?php

use Illuminate\Database\Seeder;
use App\FunctionType;

class FunctionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FunctionType::create(['name' => 'Linear Function', 'description' => '']);
        FunctionType::create(['name' => 'Quadratic Function', 'description' => '']);
        FunctionType::create(['name' => 'Logarithmic Function', 'description' => '']);
        FunctionType::create(['name' => 'Exponential Function', 'description' => '']);
        FunctionType::create(['name' => 'Rational Function', 'description' => '']);
    }
}
