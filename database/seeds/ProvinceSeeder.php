<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = File::get('database/json_data/province.json');
        $provinces = json_decode($str, true);

        DB::table('province')->insert($provinces);
    }
}
