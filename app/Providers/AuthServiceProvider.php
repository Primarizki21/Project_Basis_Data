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
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('view', function ($user, Pengaduan $pengaduan) {
            if (Auth::guard('admin')->check()) {
                return true;
            }

            if ($user) {
                return $user->user_id === $pengaduan->user_id;
            }

            return false;
        });

        Gate::define('update', function ($user, Pengaduan $pengaduan) {
            if (Auth::guard('admin')->check()) {
                return true;
            }

            if ($user) {
                return $user->user_id === $pengaduan->user_id;
            }

            return false;
        });
    }
}
