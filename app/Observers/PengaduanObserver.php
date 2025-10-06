<?php

namespace App\Observers;

use App\Models\Pengaduan;
use App\Models\ActivityLog;

class PengaduanObserver
{
    public function created(Pengaduan $pengaduan): void
    {
        ActivityLog::create([
            'description' => "Pengaduan baru masuk",
            'subject_id' => $pengaduan->pengaduan_id,
            'subject_type' => Pengaduan::class,
        ]);
    }

    public function updated(Pengaduan $pengaduan): void
    {
        // Cek jika kolom status_pengaduan yang berubah
        if ($pengaduan->isDirty('status_pengaduan')) {
            $status = $pengaduan->status_pengaduan; // "Diproses" atau "Selesai"
            ActivityLog::create([
                'description' => "Pengaduan #TKT-{$pengaduan->pengaduan_id} statusnya diubah menjadi {$status}",
                'subject_id' => $pengaduan->pengaduan_id,
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
