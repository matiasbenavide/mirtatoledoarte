<?php

namespace Database\Seeders\Admin;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParametersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parameters = [
            [
                'id' => 1,
                'vacations' => 0,
                'price_update' => null
            ],
        ];

        DB::table('parameters')->insert($parameters);
    }
}
