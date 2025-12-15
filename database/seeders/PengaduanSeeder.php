<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaduan;
use App\Models\KategoriKomplain;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PengaduanSeeder extends Seeder
{
    public function run()
    {
        $kategoriAkademik = KategoriKomplain::where('jenis_komplain', 'Akademik')->first();
        $kategoriFasilitas = KategoriKomplain::where('jenis_komplain', 'Fasilitas')->first();
        $kategoriMahasiswa = KategoriKomplain::where('jenis_komplain', 'Kemahasiswaan')->first();
        // $kategoriKekerasan = KategoriKomplain::where('jenis_komplain', 'Kekerasan')->first();
        // $kategoriLainnya = KategoriKomplain::where('jenis_komplain', 'Lainnya')->first();

        $pengaduan = [
            [
                'user_id' => null,
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

        // 1. Ambil ID Kategori
        $categories = [
            'Akademik'      => KategoriKomplain::where('jenis_komplain', 'Akademik')->first()->kategori_komplain_id,
            'Fasilitas'     => KategoriKomplain::where('jenis_komplain', 'Fasilitas')->first()->kategori_komplain_id,
            'Kemahasiswaan' => KategoriKomplain::where('jenis_komplain', 'Kemahasiswaan')->first()->kategori_komplain_id,
            'Kekerasan'     => KategoriKomplain::where('jenis_komplain', 'Kekerasan')->first()->kategori_komplain_id,
            'Lainnya'       => KategoriKomplain::where('jenis_komplain', 'Lainnya')->first()->kategori_komplain_id,
        ];

        $dataPengaduan = [];

        $userIds = User::pluck('user_id')->toArray(); 

        // Safety Check: Kalau UserSeeder belum dijalankan
        if (empty($userIds)) {
            $this->command->info('Data User kosong. Harap jalankan UserSeeder dulu.');
            return;
        }

        foreach ($userIds as $userId) {
            
            // 1. Update Status Pool
            $statusPool = array_merge(
                array_fill(0, 25, 'Menunggu'),
                array_fill(0, 25, 'Diproses'),
                array_fill(0, 25, 'Selesai'),
                array_fill(0, 25, 'Ditolak')
            );
            shuffle($statusPool); 

            // 2. Loop setiap kategori (Anggap ada 5 Jenis)
            foreach ($categories as $namaKategori => $kategoriId) {
                // Setiap jenis dapat 20 pengaduan
                for ($i = 0; $i < 20; $i++) {
                    
                    // Pastikan pool tidak kosong (safety check)
                    if (empty($statusPool)) {
                        $statusRandom = 'Menunggu'; 
                    } else {
                        $statusRandom = array_pop($statusPool);
                    }

                    // Generate Tanggal Random (Mulai 2025-01-01 s.d. Sekarang)
                    $startDate = Carbon::create(2025, 1, 1)->timestamp;
                    $endDate   = Carbon::now()->timestamp;
                    $randomTimestamp = rand($startDate, $endDate);
                    
                    // Tanggal Kejadian & Created At
                    $tanggalKejadian = Carbon::createFromTimestamp($randomTimestamp);
                    $createdAt       = Carbon::createFromTimestamp($randomTimestamp)->addHours(rand(1, 24)); 
                    
                    // LOGIKA BARU: Penentuan Updated At berdasarkan Status
                    $updatedAt = $createdAt->copy(); // Clone dulu biar aman
                    
                    if ($statusRandom === 'Menunggu') {
                        $updatedAt = $createdAt->copy(); 
                    } else {
                        $updatedAt->addDays(rand(1, 5))->addHours(rand(1, 12));
                    }

                    // Variasi Deskripsi
                    $deskripsi = "Ini adalah pengaduan percobaan untuk kategori $namaKategori oleh User $userId. ";
                    if ($namaKategori == 'Fasilitas') $deskripsi .= "AC atau fasilitas kelas rusak dan belum diperbaiki.";
                    if ($namaKategori == 'Akademik') $deskripsi .= "Masalah terkait nilai mata kuliah yang belum keluar.";
                    if ($namaKategori == 'Kekerasan') $deskripsi .= "Melaporkan tindakan yang tidak menyenangkan di lingkungan kampus.";
                    
                    // Masukkan ke array data
                    $dataPengaduan[] = [
                        'user_id'              => $userId,
                        'kategori_komplain_id' => $kategoriId,
                        'deskripsi_kejadian'   => $deskripsi . ' (Auto Generated Seeder #' . rand(1000, 9999) . ')',
                        'tanggal_kejadian'     => $tanggalKejadian->format('Y-m-d H:i:s'),
                        'status_pengaduan'     => $statusRandom,
                        'is_anonim'            => false,
                        'status_pelapor'       => 'Korban',
                        'created_at'           => $createdAt->format('Y-m-d H:i:s'),
                        'updated_at'           => $updatedAt->format('Y-m-d H:i:s'),
                    ];
                }
            }
        }

        // 4. Insert ke Database (Pakai Chunk biar ringan memori)
        foreach (array_chunk($dataPengaduan, 100) as $chunk) {
            Pengaduan::insert($chunk); // Pastikan Model Pengaduan sesuai
        }
    }
}