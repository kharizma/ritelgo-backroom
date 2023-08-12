<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'          => 'Total Outlet',
                'variable'      => 'outlet',
                'is_technical'  => true, 
                'value_type'    => Feature::TYPE_INTEGER
            ],
            [
                'name'          => 'Maximum Employee', 
                'variable'      => 'max_employee', 
                'is_technical'  => true, 
                'value_type'    => Feature::TYPE_INTEGER
            ],
            [
                'name'          => 'Maximum Transaction', 
                'variable'      => 'max_transaction', 
                'is_technical'  => true, 
                'value_type'    => Feature::TYPE_INTEGER
            ],
            [
                'name'          => 'Standard Reporting', 
                'variable'      => 'standard_reporting', 
                'is_technical'  => false, 
                'value_type'    => Feature::TYPE_STRING
            ],
        ];
        
        Feature::insert($data);
    }
}
