<?php

namespace Database\Seeders;

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
        $this->call(Admin\UserSeeder::class);
        $this->call(Admin\CategorySeeder::class);
        $this->call(Admin\ColorSeeder::class);
    }
}
