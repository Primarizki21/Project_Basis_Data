<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKekerasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_kekerasan')->insert([
            [
                'jenis_kekerasan' => 'Kekerasan Fisik',
                'deskripsi_kekerasan' => 'Pemukulan, penendangan, atau kekerasan tubuh lainnya',
            ],
            [
                'jenis_kekerasan' => 'Kekerasan Psikis',
                'deskripsi_kekerasan' => 'Ucapan merendahkan, intimidasi, ancaman',
            ],
            [
                'jenis_kekerasan' => 'Kekerasan Seksual',
                'deskripsi_kekerasan' => 'Pelecehan atau pemaksaan seksual',
            ],
            [
                'jenis_kekerasan' => 'Penelantaran',
                'deskripsi_kekerasan' => 'Tidak memberikan nafkah, kebutuhan pokok, atau perlindungan',
            ],
        ]);
    }
}
