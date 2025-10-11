<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Jangan lupa tambahkan ini

class JenisPekerjaanSeeder extends Seeder
{
    public function run()
    {
        // Siapkan data pekerjaan dalam bentuk array
        $pekerjaan = [
            ['nama_pekerjaan' => 'Mahasiswa'],
            ['nama_pekerjaan' => 'Dosen/Peneliti'],
            ['nama_pekerjaan' => 'Tendik'],
            ['nama_pekerjaan' => 'Lainnya'],
        ];

        // Masukkan data ke dalam tabel 'jenis_pekerjaan'
        DB::table('jenis_pekerjaan')->insert($pekerjaan);
    }
}