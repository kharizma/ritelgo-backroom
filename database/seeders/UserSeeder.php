<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $num = User::where('role','superadmin')->count();
        $len = strlen(++$num);

        for($i=$len; $i<7; ++$i) {
            $num = '0'.$num;
        }

        User::create([
            'id'                        => 'RGOSA'.$num,
            'role'                      => 'superadmin',
            'name'                      => 'Ully Kharisma Putra',
            'initial_name'              => 'UK',
            'email'                     => 'ullykharismaputra@gmail.com',
            'email_verified_at'         => now(),
            'password'                  => Hash::make('pass!'),
            'mobile_phone'              => '628992251659',
            'mobile_phone_verified_at'  => now(),
            'status'                    => 'active',
            'created_by'                => 'seeder',
            'updated_by'                => 'seeder'
        ]);

        $num = User::where('role','superadmin')->count();
        $len = strlen(++$num);

        for($i=$len; $i<7; ++$i) {
            $num = '0'.$num;
        }

        User::create([
            'id'                        => 'RGOSA'.$num,
            'role'                      => 'superadmin',
            'name'                      => 'Hafiz Priyotomo',
            'initial_name'              => 'HP',
            'email'                     => 'hptomo@gmail.com',
            'email_verified_at'         => now(),
            'password'                  => Hash::make('pass!'),
            'mobile_phone'              => '628112550595',
            'mobile_phone_verified_at'  => now(),
            'status'                    => 'active',
            'created_by'                => 'seeder',
            'updated_by'                => 'seeder'
        ]);
    }
}
