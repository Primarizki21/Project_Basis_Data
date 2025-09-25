<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'nip'           => '000000000',
            'nama'          => 'Administrator Utama',
            'email'         => 'admin@ftmm.unair.ac.id',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir'  => 'Surabaya',
            'tanggal_lahir' => '1990-01-15',
            'alamat'        => 'Gedung FTMM, Kampus C UNAIR, Surabaya',
            'nomor_telepon' => '081234567890',
            'pekerjaan'     => 'Super Admin',
            'password'      => Hash::make('admin'), // Password di-hash untuk keamanan
        ]);
    }
}