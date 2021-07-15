<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(BrandsSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ProductSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
