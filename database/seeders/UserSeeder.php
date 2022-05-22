<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            [
                'id' => 1,
                'name' => 'TestAdminInv',
                'email' => 'exampleInvAdm@gmail.com',
                'password' => bcrypt('qwerty123'),
                'role_id' => '1',
            ],
            [
                'id' => 2,
                'name' => 'TestUserInv',
                'email' => 'exampleInv@gmail.com',
                'password' => bcrypt('12345678'),
                'role_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'User Kas',
                'email' => 'examplekas@gmail.com',
                'password' => bcrypt('12345678'),
                'role_id' => 2,
            ]
        ]);
    }
}
