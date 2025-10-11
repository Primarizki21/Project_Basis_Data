<?php

namespace App\Observers;

use App\Models\User;
use App\Models\JenisPekerjaan;
use App\Models\Prodi;
use App\Models\ActivityLog;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Setiap kali user baru dibuat, catat di activity_log
        ActivityLog::create([
            'description' => "User baru terdaftar {$user->name}",
            'subject_id' => $user->user_id,
            'subject_type' => User::class,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->isDirty('nama')) {
            ActivityLog::create([
                'description' => "Nama user berubah dari '{$user->getOriginal('nama')}' menjadi '{$user->nama}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('email')) {
            ActivityLog::create([
                'description' => "Email user berubah dari '{$user->getOriginal('email')}' menjadi '{$user->email}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('nim')) {
            ActivityLog::create([
                'description' => "NIM/NIP user berubah dari '{$user->getOriginal('nim')}' menjadi '{$user->nim}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('jenis_pekerjaan_id')) {
            $oldPekerjaanId = $user->getOriginal('jenis_pekerjaan_id');
            $oldPekerjaan = JenisPekerjaan::find($oldPekerjaanId);
            $newPekerjaan = $user->pekerjaanfk;
            ActivityLog::create([
                'description' => "Jenis pekerjaan user berubah dari '{$oldPekerjaan->nama_pekerjaan}' menjadi '{$newPekerjaan->nama_pekerjaan}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('prodi_id')) {
            $oldProdiId = $user->getOriginal('prodi_id');
            $oldProdi = Prodi::find($oldProdiId);
            $newProdi = $user->prodifk;
            ActivityLog::create([
                'description' => "Unit/Program studi user berubah dari '{$oldProdi->nama_prodi}' menjadi '{$newProdi->nama_prodi}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('angkatan')) {
            ActivityLog::create([
                'description' => "Angkatan user berubah dari '{$user->getOriginal('angkatan')}' menjadi '{$user->angkatan}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('jenis_kelamin')) {
            ActivityLog::create([
                'description' => "Jenis kelamin user berubah dari '{$user->getOriginal('jenis_kelamin')}' menjadi '{$user->jenis_kelamin}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('tempat_lahir')) {
            ActivityLog::create([
                'description' => "Tempat lahir user berubah dari '{$user->getOriginal('tempat_lahir')}' menjadi '{$user->tempat_lahir}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('tanggal_lahir')) {
            ActivityLog::create([
                'description' => "Tanggal lahir user berubah dari '{$user->getOriginal('tanggal_lahir')}' menjadi '{$user->tanggal_lahir}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('alamat')) {
            ActivityLog::create([
                'description' => "Alamat user berubah dari '{$user->getOriginal('alamat')}' menjadi '{$user->alamat}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
        if ($user->isDirty('nomor_telepon')) {
            ActivityLog::create([
                'description' => "Nomor telepon user berubah dari '{$user->getOriginal('nomor_telepon')}' menjadi '{$user->nomor_telepon}'",
                'subject_id' => $user->user_id,
                'subject_type' => User::class,
            ]);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
