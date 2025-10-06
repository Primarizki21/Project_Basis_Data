<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TindakLanjut extends Model
{
    use HasFactory, Notifiable;
    
    protected $table = 'tindak_lanjut';
    protected $primaryKey = 'tindak_lanjut_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'jenis_tindak_lanjut',
        'deskripsi',
        'pengaduan_id',
        'admin_id',
    ];

    // Relasi one-to-one ke pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    // Relasi ke user (admin yang menangani)
    public function handler()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }
}
