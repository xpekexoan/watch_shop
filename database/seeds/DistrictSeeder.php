<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = File::get('database/json_data/district.json');
        $provinces = json_decode($str, true);

        DB::table('district')->insert($provinces);
    }
}
