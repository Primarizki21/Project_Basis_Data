<?php

namespace App\Observers;

use App\Models\Pengaduan;
use App\Models\ActivityLog;

class PengaduanObserver
{
    public function created(Pengaduan $pengaduan): void
    {
        ActivityLog::create([
            'user_id' => $pengaduan->user_id,
            'description' => "Pengaduan baru masuk",
            'subject_id' => $pengaduan->pengaduan_id,
            'subject_type' => Pengaduan::class,
        ]);
    }

    public function updated(Pengaduan $pengaduan): void
    {
        if ($pengaduan->isDirty('status_pengaduan')) {
            $status = $pengaduan->status_pengaduan;
            ActivityLog::create([
                'user_id'      => $pengaduan->user_id, // Log dikaitkan dengan user pemilik pengaduan
                'description'  => "Status pengaduan #TKT-{$pengaduan->pengaduan_id} diubah menjadi '{$status}' oleh admin.",
                'subject_id'   => $pengaduan->pengaduan_id,
                'subject_type' => Pengaduan::class,
            ]);
        }

        if ($pengaduan->isDirty('deskripsi_kejadian')) {
            ActivityLog::create([
                'user_id'      => $pengaduan->user_id,
                'description'  => "Deskripsi untuk pengaduan #TKT-{$pengaduan->pengaduan_id} telah diperbarui.",
                'subject_id'   => $pengaduan->pengaduan_id,
                'subject_type' => Pengaduan::class,
            ]);
        }

        if ($pengaduan->isDirty('tanggal_kejadian')) {
            $newDate = \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d F Y');
            ActivityLog::create([
                'user_id'      => $pengaduan->user_id,
                'description'  => "Tanggal kejadian untuk #TKT-{$pengaduan->pengaduan_id} diubah menjadi {$newDate}.",
                'subject_id'   => $pengaduan->pengaduan_id,
                'subject_type' => Pengaduan::class,
            ]);
        }

        if ($pengaduan->isDirty('kategori_komplain_id')) {
            $newCategoryName = $pengaduan->kategoriKomplain->jenis_komplain;
            ActivityLog::create([
                'user_id'      => $pengaduan->user_id,
                'description'  => "Kategori pengaduan #TKT-{$pengaduan->pengaduan_id} diubah menjadi '{$newCategoryName}'.",
                'subject_id'   => $pengaduan->pengaduan_id,
                'subject_type' => Pengaduan::class,
            ]);
        }
    }


    /**
     * Handle the Pengaduan "deleted" event.
     */
    public function deleted(Pengaduan $pengaduan): void
    {
        //
    }

    /**
     * Handle the Pengaduan "restored" event.
     */
    public function restored(Pengaduan $pengaduan): void
    {
        //
    }

    /**
     * Handle the Pengaduan "force deleted" event.
     */
    public function forceDeleted(Pengaduan $pengaduan): void
    {
        //
    }
}
