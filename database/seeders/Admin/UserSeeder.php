<?php

namespace Database\Seeders\Admin;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'role_as' => 1,
            ],
            [
                'id' => User::ID_USER_SYSTEM,
                'name' => User::NAME_USER_SYSTEM,
                'email' => User::EMAIL_USER_SYSTEM,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'role_as' => 1,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
