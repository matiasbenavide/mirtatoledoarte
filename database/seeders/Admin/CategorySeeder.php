<?php

namespace Database\Seeders\Admin;

use App\Models\User;
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
        $categories = [
            [
                'id' => 1,
                'name' => 'Individuales',
            ],
            [
                'id' => 2,
                'name' => 'Combos',
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
