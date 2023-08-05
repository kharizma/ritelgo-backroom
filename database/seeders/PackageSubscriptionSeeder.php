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
        PackageSubscription::create([
            'name'      => 'Free Plan',
            'price'     => 0,
            'is_show'   => true,
            'is_active' => true
        ]);

        PackageSubscription::create([
            'name'      => 'Bronze Plan',
            'price'     => 150000,
            'is_show'   => true,
            'is_active' => true
        ]);

        PackageSubscription::create([
            'name'      => 'Silver Plan',
            'price'     => 250000,
            'is_show'   => true,
            'is_active' => true
        ]);
    }
}
