<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shippingOptions = [
            [
                'id' => 1,
                'name' => 'Domicilio particular',
            ],
            [
                'id' => 2,
                'name' => 'Retiro en persona',
            ]
        ];

        DB::table('shipping_options')->insert($shippingOptions);
    }
}
