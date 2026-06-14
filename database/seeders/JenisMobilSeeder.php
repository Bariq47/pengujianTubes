<?php

namespace Database\Seeders;

use App\Models\JenisMobil;
use Illuminate\Database\Seeder;

class JenisMobilSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['jenis_mobil' => 'SUV'],
            ['jenis_mobil' => 'MPV'],
            ['jenis_mobil' => 'Sedan'],
            ['jenis_mobil' => 'Hatchback'],
            ['jenis_mobil' => 'Pickup'],
        ];

        foreach ($data as $item) {
            JenisMobil::firstOrCreate($item);
        }
    }
}
