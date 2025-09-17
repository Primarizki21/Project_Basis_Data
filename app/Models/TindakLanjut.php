<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    protected $table = 'tindak_lanjut';
    protected $primaryKey = 'tindak_lanjut_id';

    protected $fillable = [
        'jenis_tindak_lanjut',
        'deskripsi',
        'pengaduan_id',
        'handled_by',
    ];

    // Relasi one-to-one ke pengaduan
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    // Relasi ke user (admin yang menangani)
    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}
