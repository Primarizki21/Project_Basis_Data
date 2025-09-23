<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriKomplain;

class KategoriKomplainSeeder extends Seeder
{
    public function run()
    {
        $kategori = [
            ['jenis_komplain' => 'Akademik', 'deskripsi_komplain' => 'Masalah perkuliahan, kurikulum, nilai, dll.'],
            ['jenis_komplain' => 'Fasilitas', 'deskripsi_komplain' => 'Sarana & prasarana kampus'],
            ['jenis_komplain' => 'Kekerasan', 'deskripsi_komplain' => 'Bullying, pelecehan, atau kekerasan lainnya'],
            ['jenis_komplain' => 'Dosen', 'deskripsi_komplain' => 'Sikap atau pelayanan dosen'],
            ['jenis_komplain' => 'Lainnya', 'deskripsi_komplain' => 'Komplain di luar kategori utama'],
        ];

        foreach ($kategori as $item) {
            KategoriKomplain::create($item);
        }
    }
}
