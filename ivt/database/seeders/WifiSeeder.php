<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WifiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wifis')->insert([
            'wifi_name' => 'DevOps',
            'password' => 'Nusantara#1',
            'is_active' => '1',
            'branch_name' => 'Mercedes-Benz Building',
            'location' => 'Markas Batman',
            'ip_portal' => '248',
            'user_portal' => 'admin',
            'password_portal' => 'NusantaraSatu1!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
