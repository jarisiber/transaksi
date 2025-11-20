<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommodityLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'Ruang IT',
            'Ruang Gudang',
        ];

        for ($i = 1; $i < count($locations); $i++) {
            DB::table('commodity_locations')->insert([
                'name' => $locations[$i],
                'description' => 'Ruangan '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 1; $i < 6; $i++) {
            DB::table('commodity_locations')->insert([
                'name' => 'Ruang '.$i,
                'description' => 'Keterangan Ruangan '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
