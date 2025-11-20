<?php

namespace Database\Seeders;

use App\KredensialPengguna;
use Illuminate\Database\Seeder;

class KredensialPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KredensialPengguna::create([
        	'nama_pengguna' => 'Adur',
        	'nik' => '91000710',
        	'branch' => 'HO',
        	'jabatan' => 'Supervisor',
        	'email' => 'wahid.asimetris@gmail.com',
        	'hp' => '081385229903',
        	'keterangan' => 'Development Operation',
    }
}
