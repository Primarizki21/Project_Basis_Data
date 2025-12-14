<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Penting untuk Transaction
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
        
        // Ambil semua target sekaligus
        $targetPengaduan = Pengaduan::whereIn('status_pengaduan', ['Diproses', 'Selesai', 'Ditolak'])->get();
        $adminIds = Admin::pluck('admin_id')->toArray();

        if ($targetPengaduan->isEmpty() || empty($adminIds)) {
            $this->command->info('Tidak ada pengaduan berstatus target atau data Admin kosong.');
            return;
        }

        // Variabel penampung batch insert
        $tindakLanjutBatch = [];
        $pengaduanUpdates = []; // Untuk update timestamp pengaduan nanti

        $this->command->info('Sedang memproses data di memori...');

        foreach ($targetPengaduan as $pengaduan) {
            
            $waktuTracker = Carbon::parse($pengaduan->created_at);
            
            // --- LOGIKA DITOLAK ---
            if ($pengaduan->status_pengaduan == 'Ditolak') {
                
                $waktuTracker->addHours(rand(1, 48));
                $randomAdminId = $adminIds[array_rand($adminIds)];

                $alasanDitolak = [
                    "Mohon maaf, bukti yang dilampirkan tidak jelas/buram. Silakan buat laporan ulang.",
                    "Laporan ditolak karena tidak sesuai dengan kategori yang dipilih.",
                    "Laporan ini merupakan duplikasi dari laporan sebelumnya yang sedang diproses.",
                    "Informasi yang diberikan tidak lengkap. Mohon sertakan lokasi dan waktu kejadian yang spesifik.",
                    "Laporan tidak memenuhi syarat dan ketentuan pengaduan kampus."
                ];

                // PUSH KE ARRAY, JANGAN CREATE DULU
                $tindakLanjutBatch[] = [
                    'pengaduan_id'      => $pengaduan->pengaduan_id,
                    'jenis_tindak_lanjut' => 'Penolakan Pengaduan',
                    'deskripsi'         => $alasanDitolak[array_rand($alasanDitolak)] . " Status: Ditolak.",
                    'admin_id'          => $randomAdminId,
                    'created_at'        => $waktuTracker->toDateTimeString(), // Convert ke string untuk bulk insert
                    'updated_at'        => $waktuTracker->toDateTimeString(),
                ];

            } else { 
                // --- LOGIKA DIPROSES / SELESAI ---
                $jumlahTindakLanjut = rand(1, 10);
                
                for ($i = 1; $i <= $jumlahTindakLanjut; $i++) {
                    
                    $waktuTracker->addHours(rand(2, 24));
                    $randomAdminId = $adminIds[array_rand($adminIds)];
                    $deskripsi = "";

                    if ($pengaduan->status_pengaduan == 'Selesai') {
                        if ($i == $jumlahTindakLanjut) {
                            $closingSentences = [
                                "Masalah telah ditangani dan fasilitas sudah berfungsi normal. Laporan ditutup.",
                                "Perbaikan selesai dilakukan oleh tim teknis. Terima kasih atas laporannya.",
                                "Kasus telah diselesaikan sesuai prosedur akademik. Status: Completed.",
                                "Tindakan disipliner telah diberikan kepada pihak terkait. Laporan selesai."
                            ];
                            $deskripsi = $closingSentences[array_rand($closingSentences)];
                        } else {
                            $deskripsi = $faker->sentence(rand(6, 12)) . " (Progres perbaikan " . ($i * 10) . "%)";
                        }
                    } else { // Diproses
                        if ($i == $jumlahTindakLanjut) {
                            $ongoingSentences = [
                                "Saat ini sedang menunggu sparepart pengganti.",
                                "Tim teknis sedang melakukan investigasi mendalam di lokasi.",
                                "Kami sedang berkoordinasi dengan pihak kemahasiswaan.",
                                "Bukti sedang diverifikasi lebih lanjut, mohon menunggu update berikutnya."
                            ];
                            $deskripsi = $ongoingSentences[array_rand($ongoingSentences)];
                        } else {
                            $deskripsi = "Admin melakukan pengecekan tahap ke-$i. " . $faker->sentence(5);
                        }
                    }

                    // PUSH KE ARRAY
                    $tindakLanjutBatch[] = [
                        'pengaduan_id'      => $pengaduan->pengaduan_id,
                        'jenis_tindak_lanjut' => 'Penanganan oleh Admin',
                        'deskripsi'         => $deskripsi,
                        'admin_id'          => $randomAdminId,
                        'created_at'        => $waktuTracker->toDateTimeString(),
                        'updated_at'        => $waktuTracker->toDateTimeString(),
                    ];
                }
            }

            // Simpan ID dan Timestamp terakhir untuk update Pengaduan nanti
            $pengaduanUpdates[$pengaduan->pengaduan_id] = $waktuTracker->toDateTimeString();
        }

        // --- EKSEKUSI KE DATABASE ---
        
        // 1. Bulk Insert Tindak Lanjut (Pecah per 1000 data agar memory aman)
        $this->command->info('Menyimpan ' . count($tindakLanjutBatch) . ' data tindak lanjut...');
        
        // Kita pakai chunk array manual karena method insert() tidak punya chunk otomatis
        $chunks = array_chunk($tindakLanjutBatch, 1000);
        foreach ($chunks as $chunk) {
            TindakLanjut::insert($chunk);
        }

        // 2. Update Pengaduan (Pakai Transaction biar ngebut)
        $this->command->info('Mengupdate timestamp pengaduan...');
        
        DB::beginTransaction();
        try {
            foreach ($pengaduanUpdates as $id => $lastTime) {
                // Update query langsung tanpa load model lagi (lebih ringan)
                Pengaduan::where('pengaduan_id', $id)->update(['updated_at' => $lastTime]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->command->error($e->getMessage());
        }

        $this->command->info('Selesai!');
    }
}