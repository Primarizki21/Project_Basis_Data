<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Prodi::create(['nama_prodi' => 'Teknologi Sains Data']);
        Prodi::create(['nama_prodi' => 'Rekayasa Nanoteknologi']);
        Prodi::create(['nama_prodi' => 'Teknik Robotika dan Kecerdasan Buatan']);
        Prodi::create(['nama_prodi' => 'Teknik Industri']);
        Prodi::create(['nama_prodi' => 'Teknik Elektro']);
    }
}
