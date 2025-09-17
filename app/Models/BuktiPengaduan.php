<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPengaduan extends Model
{

    protected $table = 'bukti_pengaduan';
    protected $primaryKey = 'bukti_pengaduan_id';

    protected $fillable = [
        'pengaduan_id',
        'file_path',
        'jenis_bukti',
        'uploaded_by',
    ];

    // Relasi ke pengaduan (many-to-one)
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    // Relasi ke user (pelapor yang upload bukti)
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
