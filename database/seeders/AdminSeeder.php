<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_admins')->insert([
            [
                'name' => 'Super Admin',
                'username' => 'admin',
                'password' => Hash::make('admin1234'),
                'phone' => '09987645312',
                'role' => 1,
                'created_by' => 1,
                'created_at' => now()
            ],
            [
                'name' => 'Admin',
                'username' => 'normal_admin',
                'password' => Hash::make('admin1234'),
                'phone' => '09987645444',
                'role' => 2,
                'created_by' => 1,
                'created_at' => now()
            ],
        ]);
    }
}
