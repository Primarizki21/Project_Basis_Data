<?php

namespace App\Providers;

use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // --- REVISI LOGIKA GATE DI SINI ---

        // BEFORE: Gate::define('view', function (?User $user, Pengaduan $pengaduan) {
        // AFTER: Kita hapus type-hint "?User" agar bisa menerima User maupun Admin
        Gate::define('view', function ($user, Pengaduan $pengaduan) {
            // 1. Jika ada admin yang login, selalu izinkan.
            if (Auth::guard('admin')->check()) {
                return true;
            }

            // 2. Jika tidak ada admin, periksa apakah user adalah pemiliknya.
            if ($user) {
                return $user->id === $pengaduan->user_id;
            }

            return false;
        });

        // BEFORE: Gate::define('update', function (?User $user, Pengaduan $pengaduan) {
        // AFTER: Kita hapus type-hint "?User" agar bisa menerima User maupun Admin
        Gate::define('update', function ($user, Pengaduan $pengaduan) {
            // 1. Jika ada admin yang login, selalu izinkan.
            if (Auth::guard('admin')->check()) {
                return true;
            }

            // 2. Jika tidak ada admin, periksa apakah user adalah pemiliknya.
            if ($user) {
                return $user->id === $pengaduan->user_id;
            }

            return false;
        });
    }
}
