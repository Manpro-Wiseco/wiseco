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
        User::Create(['name' => 'TestAdminInv',
            'email' => 'exampleInvAdm@gmail.com',
            'password' => bcrypt('qwerty123'),
            'role_id' => '1',]);
            
        User::Create([
            'name' => 'TestUserInv',
            'email' => 'exampleInv@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => '2',]);        
    }
}
