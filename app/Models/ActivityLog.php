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
        'admin_id',
        'subject_id',
        'subject_type',
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }

    public function getIconClassAttribute(): string
    {
        switch ($this->title_summary) {
            case "Pengaduan Baru":
                return 'bi-file-earmark-plus';
            case "Perubahan Bukti":
                return 'bi-paperclip';
            case "Tindak Lanjut":
                return 'bi-chat-left-text-fill';
            case "Perubahan Status":
                return 'bi-gear-fill';
            case "Kasus Selesai":
                return 'bi-check-circle-fill';
            case "Kasus Ditolak":
                return 'bi-x-circle-fill';
            case "User Baru":
                return 'bi-person-plus-fill';
            default:
                return 'bi-bell';
        }
    }

    public function getIconColorAttribute(): string
    {
        switch ($this->title_summary) {
            case "Pengaduan Baru":
                return '#0ea5f0';
            case "Perubahan Bukti":
                return '#6366f1';
            case "Tindak Lanjut":
                return '#a855f7';
            case "Perubahan Status":
                return '#f59e0b';
            case "Kasus Selesai":
                return '#10b981';
            case "Kasus Ditolak":
                return '#ef4444';
            case "User Baru":
                return '#6B21A8';
            default:
                return '#6c757d';
        }
    }

    public function getTitleSummaryAttribute(): string
    {
        $lowerDesc = strtolower($this->description); 
        if (Str::contains($lowerDesc, ['selesai', 'Selesai'])) {
            return "Kasus Selesai";
        }
        if (Str::contains($lowerDesc, ['ditolak', 'Ditolak'])) {
            return "Kasus Ditolak";
        }
        if (Str::contains($lowerDesc, ['bukti', 'file', 'gambar'])) {
            return "Perubahan Bukti";
        }
        if (Str::contains($lowerDesc, ['diubah menjadi Diproses', 'sedang diproses', 'status'])) {
            return "Perubahan Status";
        }
        if (Str::contains($lowerDesc, ['tindak lanjut', 'catatan'])) {
            return "Tindak Lanjut";
        }
        if (Str::contains($lowerDesc, 'baru masuk')) {
            return "Pengaduan Baru";
        }
        if (Str::contains($lowerDesc, ['user baru', 'terdaftar'])) {
            return "User Baru";
        }
        return "Aktivitas Lainnya";
    }
}
