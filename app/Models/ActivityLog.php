<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActivityLog extends Model
{
    use HasFactory;
    protected $table = 'activity_log';
    protected $fillable = [
        'description',
        'user_id',
        'subject_id',
        'subject_type',
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getIconClassAttribute(): string
    {
        if (Str::contains($this->description, ['selesai', 'Selesai'])) {
            return 'bi-check-circle';
        }
        if (Str::contains($this->description, ['diubah menjadi Diproses', 'sedang diproses'])) {
            return 'bi-gear';
        }
        if (Str::contains($this->description, ['baru masuk', 'Baru masuk'])) {
            return 'bi-file-earmark-plus';
        }
        if (Str::contains($this->description, ['User baru', 'terdaftar'])) {
            return 'bi-person-plus';
        }
        return 'bi-bell'; // Default
    }

    public function getIconColorAttribute(): string
    {
        if (Str::contains($this->description, ['selesai', 'Selesai'])) {
            return '#10b981'; // Hijau
        }
        if (Str::contains($this->description, ['diubah menjadi Diproses', 'sedang diproses'])) {
            return '#f59e0b'; // Oranye
        }
        if (Str::contains($this->description, ['baru masuk', 'Baru masuk'])) {
            return '#0ea5f0'; // Biru
        }
        if (Str::contains($this->description, ['User baru', 'terdaftar'])) {
            return '#6B21A8'; // Ungu
        }
        return '#6c757d'; // Default
    }
}
