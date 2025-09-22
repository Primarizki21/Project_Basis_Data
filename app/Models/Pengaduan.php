<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'pengaduan';
    protected $primaryKey = 'pengaduan_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'kategori_komplain_id',
        'deskripsi_kejadian',
        'tanggal_kejadian',
        'status_pengaduan',
        'status_pelapor',
    ];

    // Relasi
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bukti()
    {
        return $this->hasMany(BuktiPengaduan::class, 'pengaduan_id');
    }

    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'pengaduan_id');
    }

    public function kategoriKomplain()
    {
        return $this->belongsTo(KategoriKomplain::class, 'kategori_komplain_id');
    }
}
