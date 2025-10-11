<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaduan; // Impor model Pengaduan
use App\Models\KategoriKomplain; // Impor model KategoriKomplain
use Carbon\Carbon; // Impor Carbon untuk manipulasi tanggal

class PengaduanSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID dari kategori yang ada untuk memastikan data relasional valid
        $kategoriAkademik = KategoriKomplain::where('jenis_komplain', 'Akademik')->first();
        $kategoriFasilitas = KategoriKomplain::where('jenis_komplain', 'Fasilitas')->first();
        $kategoriMahasiswa = KategoriKomplain::where('jenis_komplain', 'Kemahasiswaan')->first();

        $pengaduan = [
            [
                'user_id' => null, // Kunci untuk pengaduan anonim
                'kategori_komplain_id' => $kategoriFasilitas->kategori_komplain_id,
                'deskripsi_kejadian' => 'Ruang kelas AC-nya rusak sudah 2 minggu, sangat panas dan mengganggu konsentrasi belajar. Sudah dilaporkan ke bagian maintenance tapi belum ada tindak lanjut.',
                'tanggal_kejadian' => Carbon::now()->subWeeks(2),
                'status_pengaduan' => 'Selesai',
                'is_anonim' => true,
                'status_pelapor' => 'Saksi',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => null,
                'kategori_komplain_id' => $kategoriFasilitas->kategori_komplain_id,
                'deskripsi_kejadian' => 'Toilet di lantai 3 gedung B kotor dan tidak ada air. Kondisinya sangat tidak layak pakai. Mohon segera dibersihkan dan diperbaiki sistem airnya.',
                'tanggal_kejadian' => Carbon::now()->subDays(4),
                'status_pengaduan' => 'Diproses',
                'is_anonim' => true,
                'status_pelapor' => 'Korban',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subHours(5),
            ],
            [
                'user_id' => null,
                'kategori_komplain_id' => $kategoriMahasiswa->kategori_komplain_id,
                'deskripsi_kejadian' => 'Proses pengajuan surat keterangan mahasiswa di bagian administrasi terlalu lama, sudah 1 minggu belum selesai. Padahal katanya hanya butuh 3 hari kerja.',
                'tanggal_kejadian' => Carbon::now()->subWeeks(1),
                'status_pengaduan' => 'Menunggu',
                'is_anonim' => true,
                'status_pelapor' => 'Korban',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'user_id' => null,
                'kategori_komplain_id' => $kategoriAkademik->kategori_komplain_id,
                'deskripsi_kejadian' => 'Dosen pembimbing saya sering tidak hadir tanpa pemberitahuan. Hal ini menghambat progres skripsi saya karena sulit mendapatkan bimbingan.',
                'tanggal_kejadian' => Carbon::now()->subWeeks(1),
                'status_pengaduan' => 'Menunggu',
                'is_anonim' => true,
                'status_pelapor' => 'Korban',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($pengaduan as $item) {
            Pengaduan::create($item);
        }
    }
}