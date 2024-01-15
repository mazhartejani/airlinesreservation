<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

/**
* Class UsersSeeder
*/
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mazhar Hussain',
            'email' => 'mazhar@test.com',
            'password' => bcrypt('12345678'),
            'is_admin' => 0
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
            'is_admin' => 1
        ]);
    }
}
