<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
                'name' => 'Đồng hồ thông minh'
            ],
            [
                'id' => 2,
                'name' => 'Đồng hồ kim'
            ]
        ];
        DB::table('category')->insert($data);
    }
}
