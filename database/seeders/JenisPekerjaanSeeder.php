<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Jangan lupa tambahkan ini

class JenisPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Siapkan data pekerjaan dalam bentuk array
        $pekerjaan = [
            ['nama_pekerjaan' => 'Mahasiswa'],
            ['nama_pekerjaan' => 'Dosen'],
            ['nama_pekerjaan' => 'Tendik'],
            ['nama_pekerjaan' => 'Peneliti'],
            ['nama_pekerjaan' => 'Lainnya'],
        ];

        // Masukkan data ke dalam tabel 'jenis_pekerjaan'
        DB::table('jenis_pekerjaan')->insert($pekerjaan);
    }
}