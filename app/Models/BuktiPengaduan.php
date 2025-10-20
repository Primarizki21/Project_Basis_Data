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
        'nama_file',
        'ukuran_file',
        'jenis_bukti',
        'user_id',
        'admin_id',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function handler()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }
}
