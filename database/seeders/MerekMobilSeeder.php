<?php

namespace Database\Seeders;

use App\Models\MerekMobil;
use Illuminate\Database\Seeder;

class MerekMobilSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['merek_mobil' => 'Toyota'],
            ['merek_mobil' => 'Honda'],
            ['merek_mobil' => 'Daihatsu'],
            ['merek_mobil' => 'Mitsubishi'],
            ['merek_mobil' => 'Suzuki'],
        ];

        MerekMobil::insert($data);
    }
}
