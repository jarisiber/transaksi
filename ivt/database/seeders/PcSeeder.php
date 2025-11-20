<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::table('pcs')->insert([
			'jenis' => 'Desktop',
			'merk' => 'Lenovo Thinkpad X260',
			'user_responsible' => 'Admin Unit Spv',
			'hostname' => 'DESKTOP-URY7U8896',
			'processor' => 'Intel i7-7200U',
			'ram' => '12GB',
			'branch_name' => 'HO',
			'created_at' => now(),
			'updated_at' => now(),
		]);
    }
}
