<?php

namespace App\Observers;

use App\Models\BuktiPengaduan;
use App\Models\Pengaduan;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class BuktiPengaduanObserver
{
    /**
     * Handle the BuktiPengaduan "created" event.
     */
    public function created(BuktiPengaduan $bukti)
    {
        $pengaduan = $bukti->pengaduan;
        $namaFile = $bukti->nama_file;
        $aktor = "Pelapor";
        if ($bukti->admin_id) {
            $aktor = $bukti->handler ? $bukti->handler->nama : "Admin (ID: {$bukti->admin_id})";
        }
        $description = "{$aktor} menambahkan bukti baru: '{$namaFile}'";
        $userId = null;
        $adminId = null;
        if (Auth::guard('admin')->check()) {
            $adminId = Auth::guard('admin')->id();
        } elseif (Auth::check()) {
            $userId = Auth::id();
        }
        ActivityLog::create([
            'description'  => $description,
            'subject_id'   => $pengaduan->pengaduan_id,
            'subject_type' => Pengaduan::class,
            'user_id'      => $userId,   // <-- Mengisi kolom user_id
            'admin_id'     => $adminId,  // <-- Mengisi kolom admin_id
        ]);
    }

    /**
     * Handle the BuktiPengaduan "updated" event.
     */
    public function updated(BuktiPengaduan $buktiPengaduan): void
    {
        //
    }

    /**
     * Handle the BuktiPengaduan "deleted" event.
     */
    public function deleted(BuktiPengaduan $bukti)
    {
        $pengaduan = $bukti->pengaduan;
        $namaFile = $bukti->nama_file;
        $aktor = "Sistem";
        $userId = null;
        $adminId = null;

        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            $adminId = $admin->admin_id;
            $aktor = $admin->nama;
        } elseif (Auth::check()) {
            $user = Auth::user();
            $userId = $user->user_id;
            $aktor = $user->nama;
        }
        $description = "{$aktor} menghapus bukti: '{$namaFile}'";
        ActivityLog::create([
            'description'  => $description,
            'subject_id'   => $pengaduan->pengaduan_id,
            'subject_type' => Pengaduan::class,
            'user_id'      => $userId,
            'admin_id'     => $adminId,
        ]);
    }

    /**
     * Handle the BuktiPengaduan "restored" event.
     */
    public function restored(BuktiPengaduan $buktiPengaduan): void
    {
        //
    }

    /**
     * Handle the BuktiPengaduan "force deleted" event.
     */
    public function forceDeleted(BuktiPengaduan $buktiPengaduan): void
    {
        //
    }
}
