<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kharizma\Indozone\IndozoneHelper;
use Illuminate\Support\Facades\DB;

class IndozoneProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     * 
     * @return void
     */
    public function run()
    {
        $provinces = IndozoneHelper::getProvinces();

        DB::table('provinces')->insert($provinces);
    }
}
