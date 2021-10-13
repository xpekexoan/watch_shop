<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Apple',
            ],
            [
                'id' => 2,
                'name' => 'Hublot',
            ],
            [
                'id' => 3,
                'name' => 'Xiaomi',
            ]
        ];
        DB::table('brand')->insert($data);
    }
}
