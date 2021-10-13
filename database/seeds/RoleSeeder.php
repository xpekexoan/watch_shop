<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles  = [
            [
                'id' => 1,
                'name' => 'Quản trị viên',
            ],
            [
                'id' => 2,
                'name' => 'Quản lý',
            ],
            [
                'id' => 3,
                'name' => 'Nhân viên bán hàng',
            ],
            [
                'id' => 4,
                'name' => 'Nhân viên giao hàng',
            ],
            [
                'id' => 5,
                'name' => 'Khách hàng',
            ],
        ];
        
        foreach($roles as $item) {
            DB::table('role')->insertOrIgnore($item);
        }
    }
}
