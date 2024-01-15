<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
                'user_id' => 'A001',
                'username' => 'admin',
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'alamat' => 'rumah',
            ],
            [
                'user_id' => 'P001',
                'username' => 'petugas',
                'name' => 'petugas',
                'email' => 'petugas@mail.com',
                'password' => Hash::make('password'),
                'role' => 'petugas',
                'alamat' => 'rumah',
            ],
        ];

        User::insert($users);
    }
}
