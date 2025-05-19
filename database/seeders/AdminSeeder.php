<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'admin_id' => 7,
                'username' => 'nanad',
                'email' => 'nanad@adminboboin.aja',
                'password' => Hash::make('admin7nanad'),
                'created_at' => '2025-03-30 14:13:29',
                'deleted' => 0,
                'updated_at' => '2025-03-30 14:13:29'
            ],
            [
                'admin_id' => 8,
                'username' => 'ara',
                'email' => 'ara@adminboboin.aja',
                'password' => Hash::make('admin8ara'),
                'created_at' => '2025-03-30 14:13:45',
                'deleted' => 0,
                'updated_at' => '2025-03-30 14:13:45'
            ],
            [
                'admin_id' => 9,
                'username' => 'pinkan',
                'email' => 'pinkan@adminboboin.aja',
                'password' => Hash::make('admin9pinkan'),
                'created_at' => '2025-03-30 14:14:03',
                'deleted' => 0,
                'updated_at' => '2025-03-30 14:14:03'
            ],
            [
                'admin_id' => 10,
                'username' => 'alja',
                'email' => 'alja@adminboboin.aja',
                'password' => Hash::make('admin10alja'),
                'created_at' => '2025-03-30 14:14:20',
                'deleted' => 0,
                'updated_at' => '2025-03-30 14:14:20'
            ]
        ];

        foreach ($admins as $admin) {
            DB::table('admins')->insert($admin);
        }
    }
}