<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ "name" => "Đen"],
            [ "name" => "Trắng"],
            [ "name" => "Vàng"],
            [ "name" => "Bạc"],
        ];

        DB::table('color')->insert($data);
    }
}
