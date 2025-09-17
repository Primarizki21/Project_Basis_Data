<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'pengaduan_id';

    protected $fillable = [
        'pelapor',
        'kategori_kekerasan',
        'deskripsi_kejadian',
        'tanggal_kejadian',
        'status_pengaduan',
        'status_pelapor',
    ];

    // Relasi
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor');
    }

    public function bukti()
    {
        return $this->hasMany(BuktiPengaduan::class, 'pengaduan_id');
    }

    public function tindakLanjut()
    {
        return $this->hasOne(TindakLanjut::class, 'pengaduan_id');
    }
}
