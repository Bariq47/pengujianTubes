<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_mobil'       => 'Toyota Avanza',
                'merek_mobil_id'   => 1,
                'jenis_mobil_id'   => 2,
                'no_polisi'        => 'N 1234 AB',
                'warna'            => 'Putih',
                'jumlah_penumpang' => 7,
                'tahun_mobil'      => '2022',
                'harga_per_hari'   => 350000,
                'harga_dengan_supir' => 450000,
                'kecepatan'        => 'Manual',
                'bahan_bakar'      => 'Bensin',
                'ac'               => 'Ya',
                'foto'             => 'mobil/avanza.png',
                'status_mobil'     => 0,
            ],
            [
                'nama_mobil'       => 'Honda Brio',
                'merek_mobil_id'   => 2,
                'jenis_mobil_id'   => 4,
                'no_polisi'        => 'N 5678 CD',
                'warna'            => 'Merah',
                'jumlah_penumpang' => 5,
                'tahun_mobil'      => '2023',
                'harga_per_hari'   => 250000,
                'harga_dengan_supir' => 350000,
                'kecepatan'        => 'Manual',
                'bahan_bakar'      => 'Bensin',
                'ac'               => 'Ya',
                'foto'             => 'mobil/brio.png',
                'status_mobil'     => 0,
            ],
            [
                'nama_mobil'       => 'Mitsubishi Pajero Sport',
                'merek_mobil_id'   => 4,
                'jenis_mobil_id'   => 1,
                'no_polisi'        => 'N 9012 EF',
                'warna'            => 'Hitam',
                'jumlah_penumpang' => 7,
                'tahun_mobil'      => '2023',
                'harga_per_hari'   => 800000,
                'harga_dengan_supir' => 1000000,
                'kecepatan'        => 'Automatic',
                'bahan_bakar'      => 'Diesel',
                'ac'               => 'Ya',
                'foto'             => 'mobil/pajero.png',
                'status_mobil'     => 0,
            ],
            [
                'nama_mobil'       => 'Toyota Innova Reborn',
                'merek_mobil_id'   => 1,
                'jenis_mobil_id'   => 2,
                'no_polisi'        => 'N 3456 GH',
                'warna'            => 'Silver',
                'jumlah_penumpang' => 7,
                'tahun_mobil'      => '2024',
                'harga_per_hari'   => 500000,
                'harga_dengan_supir' => 650000,
                'kecepatan'        => 'Automatic',
                'bahan_bakar'      => 'Diesel',
                'ac'               => 'Ya',
                'foto'             => 'mobil/innova.png',
                'status_mobil'     => 0,
            ],
            [
                'nama_mobil'       => 'Daihatsu Sigra',
                'merek_mobil_id'   => 3,
                'jenis_mobil_id'   => 2,
                'no_polisi'        => 'N 7890 IJ',
                'warna'            => 'Biru',
                'jumlah_penumpang' => 7,
                'tahun_mobil'      => '2022',
                'harga_per_hari'   => 300000,
                'harga_dengan_supir' => 400000,
                'kecepatan'        => 'Manual',
                'bahan_bakar'      => 'Bensin',
                'ac'               => 'Ya',
                'foto'             => 'mobil/sigra.png',
                'status_mobil'     => 0,
            ],
        ];

        foreach ($data as $item) {
            Mobil::firstOrCreate(['no_polisi' => $item['no_polisi']], $item);
        }
    }
}
