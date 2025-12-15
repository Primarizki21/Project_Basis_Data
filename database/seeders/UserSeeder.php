<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nim'           => '164231062',
            'nama'          => 'Primarizki Ahmad Hariyono',
            'email'         => 'oki@ftmm.unair.ac.id',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir'  => 'Surabaya',
            'tanggal_lahir' => '1990-01-15',
            'alamat'        => 'Wonorejo',
            'nomor_telepon' => '08123456789',
            'jenis_pekerjaan_id'     => '1',
            'prodi_id'     => '1',
            'angkatan'     => '2023',
            'password'      => Hash::make('123456'),
        ]);
    }
}