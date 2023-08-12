<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PackageSubscription;

class PackageSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'          => 'Free Plan',
                'price'         => 0,
                'price_annual'  => 0,
                'is_show'       => true,
                'is_active'     => true
            ],
            [
                'name'          => 'Bronze Plan',
                'price'         => 150000,
                'price_annual'  => 1499000,
                'is_show'       => true,
                'is_active'     => true
            ],
            [
                'name'          => 'Silver Plan',
                'price'         => 250000,
                'price_annual'  => 2499000,
                'is_show'       => true,
                'is_active'     => true
            ]
        ];

        PackageSubscription::insert($data);
    }
}
