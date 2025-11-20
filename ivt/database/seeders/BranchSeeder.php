<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('branches')->insert([
            'nama_branch' => 'Honda MTH',
            'alamat' => 'Jl. Letjen M.T. Haryono No.Kav. 5 (021) 82789888',
            'isp' => 'INDIHOME',
            'no_inet' => '121105207982',
            'email_digunakan' => 'abdur.rahman@nusantara-group.com',
            'is_active' => '1',
            'keterangan' => 'HO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
