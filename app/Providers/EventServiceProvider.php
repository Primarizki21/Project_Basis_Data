<?php

namespace App\Providers;

use App\Models\Pengaduan;
use App\Models\User;
use App\Models\BuktiPengaduan;
use App\Observers\PengaduanObserver;
use App\Observers\UserObserver;
use App\Observers\BuktiPengaduanObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $observers = [
        User::class => [UserObserver::class],
        Pengaduan::class => [PengaduanObserver::class],
        BuktiPengaduan::class => [BuktiPengaduanObserver::class],
    ];

    public function boot()
    {
        //
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}