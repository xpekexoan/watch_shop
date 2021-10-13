<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
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
                'name' => 'permission-edit',
                'description' => 'Phân quyền hệ thống',
            ],
            [
                'name' => 'user-edit',
                'description' => 'Cập nhật người dùng',
            ],
            [
                'name' => 'category-edit',
                'description' => 'Cập nhật danh mục',
            ],
            [
                'name' => 'brand-edit',
                'description' => 'Cập nhật thương hiệu',
            ],
            [
                'name' => 'product-edit',
                'description' => 'Cập nhật sản phẩm',
            ],
            [
                'name' => 'order-list',
                'description' => 'Danh sách đơn hàng',
            ],
            [
                'name' => 'order-confirm',
                'description' => 'Duyệt đơn hàng',
            ],
            [
                'name' => 'order-delivery',
                'description' => 'Giao đơn hàng',
            ],
            [
                'name' => 'blog-edit',
                'description' => 'Cập nhật bài viết',
            ],
        ];
        DB::table('permission')->insert($data);
    }
}
