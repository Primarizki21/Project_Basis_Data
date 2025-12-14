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
            'nip'           => '000000001',
            'nama'          => 'Administrator 1',
            'email'         => 'admin1@ftmm.unair.ac.id',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir'  => 'Surabaya',
            'tanggal_lahir' => '1990-01-15',
            'alamat'        => 'Gedung FTMM, Kampus C UNAIR, Surabaya',
            'nomor_telepon' => '081234567890',
            'jenis_pekerjaan_id'     => 4,
            'password'      => Hash::make('admin123'),
        ]);

        for ($i = 2; $i <= 5; $i++) {
            Admin::create([
                'nip'             => '00000000' . $i, 
                'nama'            => 'Administrator ' . $i, 
                'email'           => 'admin' . $i . '@ftmm.unair.ac.id', 
                'jenis_kelamin'   => ($i % 2 == 0) ? 'Perempuan' : 'Laki-laki', 
                'tempat_lahir'    => 'Surabaya',
                'tanggal_lahir'   => '199' . $i . '-05-20',
                'alamat'          => 'Gedung FTMM, Kampus C UNAIR, Surabaya',
                'nomor_telepon'   => '08123456789' . $i, 
                'jenis_pekerjaan_id' => 4,
                'password'        => Hash::make('admin123'),
            ]);
        }
    }
}