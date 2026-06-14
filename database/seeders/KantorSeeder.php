<?php

namespace Database\Seeders;

use App\Models\Kantor;
use Illuminate\Database\Seeder;

class KantorSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama'   => 'EraTrans Pusat',
                'alamat' => 'Komplek Ruko Grand City Regency, Jl. Rungkut Madya B-21, Surabaya',
                'no_rek' => '1234567890',
                'no_telp' => '+62 811-311-190',
            ],
            [
                'nama'   => 'EraTrans Juanda',
                'alamat' => 'Bandara Juanda, Terminal 1, Sidoarjo',
                'no_rek' => '1234567891',
                'no_telp' => '+62 811-311-191',
            ],
        ];

        foreach ($data as $item) {
            Kantor::firstOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
