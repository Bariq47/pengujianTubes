<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('Password123'),
            'role_id'   => 1,
        ];

        User::create($data);
    }
}
