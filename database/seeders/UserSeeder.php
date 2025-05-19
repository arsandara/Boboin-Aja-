<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // User biasa
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@boboinaja.com',
            'password' => Hash::make('password'),
            'is_admin' => false, // user biasa
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@boboinaja.com',
            'password' => Hash::make('password'),
            'is_admin' => true, // admin
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
