<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaduan;
use App\Models\TindakLanjut;
use App\Models\Admin;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TindakLanjutSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // 1. Ambil Pengaduan yang statusnya HANYA 'Diproses' atau 'Selesai'
        // Kita abaikan yang 'Menunggu' atau 'Ditolak'
        $targetPengaduan = Pengaduan::whereIn('status_pengaduan', ['Diproses', 'Selesai'])->get();
        
        $adminIds = Admin::pluck('admin_id')->toArray();

        if ($targetPengaduan->isEmpty() || empty($adminIds)) {
            $this->command->info('Tidak ada pengaduan berstatus Diproses/Selesai atau data Admin kosong.');
            return;
        }

        foreach ($targetPengaduan as $pengaduan) {
            
            // Tentukan jumlah tindak lanjut (range 1 s.d 10)
            $jumlahTindakLanjut = rand(1, 10);
            
            // Waktu awal (mulai dari created_at pengaduan)
            $waktuTracker = Carbon::parse($pengaduan->created_at);

            for ($i = 1; $i <= $jumlahTindakLanjut; $i++) {
                
                // Majukan waktu agar logis (setiap respon berjarak 2 jam - 24 jam)
                // Pastikan tidak melebihi waktu sekarang jika statusnya Diproses
                $waktuTracker->addHours(rand(2, 24));
                
                // Pilih Admin Random
                $randomAdminId = $adminIds[array_rand($adminIds)];

                // Tentukan Isi Deskripsi berdasarkan Status & Urutan
                $deskripsi = "";

                if ($pengaduan->status_pengaduan == 'Selesai') {
                    // KONDISI: PENGADUAN SELESAI
                    
                    if ($i == $jumlahTindakLanjut) {
                        // Jika ini loop TERAKHIR, beri pesan penutup
                        $closingSentences = [
                            "Masalah telah ditangani dan fasilitas sudah berfungsi normal. Laporan ditutup.",
                            "Perbaikan selesai dilakukan oleh tim teknis. Terima kasih atas laporannya.",
                            "Kasus telah diselesaikan sesuai prosedur akademik. Status: Completed.",
                            "Tindakan disipliner telah diberikan kepada pihak terkait. Laporan selesai."
                        ];
                        $deskripsi = $closingSentences[array_rand($closingSentences)];
                    } else {
                        // Jika bukan terakhir (masih proses menuju selesai)
                        $deskripsi = $faker->sentence(rand(6, 12)) . " (Progres perbaikan " . ($i * 10) . "%)";
                    }

                } else {
                    // KONDISI: PENGADUAN DIPROSES
                    
                    if ($i == $jumlahTindakLanjut) {
                        // Loop terakhir TAPI status masih diproses -> Pesan Gantung/On-going
                        $ongoingSentences = [
                            "Saat ini sedang menunggu sparepart pengganti.",
                            "Tim teknis sedang melakukan investigasi mendalam di lokasi.",
                            "Kami sedang berkoordinasi dengan pihak kemahasiswaan.",
                            "Bukti sedang diverifikasi lebih lanjut, mohon menunggu update berikutnya."
                        ];
                        $deskripsi = $ongoingSentences[array_rand($ongoingSentences)];
                    } else {
                        // Proses biasa
                        $deskripsi = "Admin melakukan pengecekan tahap ke-$i. " . $faker->sentence(5);
                    }
                }

                // Create Data Tindak Lanjut
                TindakLanjut::create([
                    'pengaduan_id'        => $pengaduan->pengaduan_id,
                    'jenis_tindak_lanjut' => 'Penanganan oleh Admin',
                    'deskripsi'           => $deskripsi,
                    'admin_id'            => $randomAdminId,
                    'created_at'          => $waktuTracker,
                    'updated_at'          => $waktuTracker,
                ]);
            }

            // Update timestamp 'updated_at' di tabel Pengaduan agar sama dengan tindak lanjut terakhir
            $pengaduan->update(['updated_at' => $waktuTracker]);
        }
    }
}