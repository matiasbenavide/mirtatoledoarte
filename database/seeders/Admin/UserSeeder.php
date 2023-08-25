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
            [
                'id' => User::ID_USER_SYSTEM,
                'name' => User::NAME_USER_SYSTEM,
                'email' => User::EMAIL_USER_SYSTEM,
                'password' => '$2y$10$aS7CoZqcwOm96.0JtcZeKOisD/WvqFJrcn5k4txDzsFlRDn5Bm9Z6',
                'role_as' => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
