<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimProfilSeeder extends Seeder
{
    public function run()
    {
        DB::connection('olap')->table('dim_profil')->updateOrInsert(
            ['sk_profil' => 0],
            [
                'angkatan'  => '0', 
                'nama_prodi'      => '0',
                'jenis_kelamin'   => '0',
                'nama_pekerjaan' => '0',
            ]
        );
        
        $this->command->info('Data Profil Anonim (ID 0) berhasil ditanam di Database OLAP!');
    }
}
