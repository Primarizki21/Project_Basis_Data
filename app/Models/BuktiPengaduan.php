<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuktiPengaduan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'bukti_pengaduan';
    protected $primaryKey = 'bukti_pengaduan_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'pengaduan_id',
        'file_path',
        'jenis_bukti',
        'user_id',
    ];

    // Relasi ke pengaduan (many-to-one)
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    // Relasi ke user (pelapor yang upload bukti)
    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
