<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            DistrictSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            ColorSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
        ]);
    }
}
