<?php

namespace Database\Seeders\Admin;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => User::ID_USER_ADMIN,
                'name' => User::NAME_USER_ADMIN,
                'email' => User::EMAIL_USER_ADMIN,
                'password' => Hash::make('password'),
                'role_as' => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
