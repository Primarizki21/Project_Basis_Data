<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'jenis_pekerjaan_id',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'admin_id', 'admin_id');
    }
    public function activity()
    {
        return $this->hasMany(ActivityLog::class, 'admin_id', 'admin_id');
    }
    public function buktipengaduan()
    {
        return $this->hasMany(BuktiPengaduan::class, 'admin_id', 'admin_id');
    }
}
