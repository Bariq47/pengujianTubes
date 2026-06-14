<?php

namespace Database\Seeders;

use App\Models\Supir;
use Illuminate\Database\Seeder;

class SupirSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama'          => 'Bambang Supriyadi',
                'no_ktp'        => '3578010101950001',
                'jenis_kelamin' => 'Laki-laki',
                'no_telp'       => '+62 812-3456-7890',
                'alamat'        => 'Jl. Manyar Kertoarjo No. 5, Surabaya',
                'foto'          => 'supir/default.png',
                'status_supir'  => 0,
            ],
            [
                'nama'          => 'Agus Wijaya',
                'no_ktp'        => '3578010202850002',
                'jenis_kelamin' => 'Laki-laki',
                'no_telp'       => '+62 813-4567-8901',
                'alamat'        => 'Jl. Dharmahusada Indah No. 12, Surabaya',
                'foto'          => 'supir/default.png',
                'status_supir'  => 0,
            ],
            [
                'nama'          => 'Siti Rahmawati',
                'no_ktp'        => '3578010303950003',
                'jenis_kelamin' => 'Perempuan',
                'no_telp'       => '+62 814-5678-9012',
                'alamat'        => 'Jl. Raya Kertajaya No. 88, Surabaya',
                'foto'          => 'supir/default.png',
                'status_supir'  => 0,
            ],
        ];

        foreach ($data as $item) {
            Supir::firstOrCreate(['no_ktp' => $item['no_ktp']], $item);
        }
    }
}
