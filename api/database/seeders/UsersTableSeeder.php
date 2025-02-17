<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@tienda.com',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cliente1',
                'email' => 'cliente1@tienda.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
