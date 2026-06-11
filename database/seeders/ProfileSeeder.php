<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'no_ktp'        => '123645387',
            'nama'          => 'Eratrans Admin',
            'jenis_kelamin' => 'Laki-laki',
            'no_telp'       => '+62 811-311-190',
            'alamat'        => 'Komplek Ruko Grand City Regency, Jl. Rungkut Madya B-21, Central Rungkut, Gunung Anyar, Surabaya',
            'user_id'       => 1,
        ];

        Profile::create($data);
    }
}
