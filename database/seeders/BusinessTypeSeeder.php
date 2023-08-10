<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusinessType;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Coffee Shop',
            'Café',
            'F & B',
            'Bakery',
            'Restaurant',
            'Clothing',
            'Retail',
            'Other'
        ];

        foreach($data as $item){
            BusinessType::create([
                'id'  => $item,
            ]);
        }
    }
}
