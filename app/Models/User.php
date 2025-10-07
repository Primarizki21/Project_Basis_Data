<?php


namespace App\Models;

use Database\Seeders\JenisPekerjaanSeeder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_pekerjaan_id',
        'password',
        'prodi_id',
        'angkatan',
        'nomor_telepon'
    ];

    protected $hidden = [
        'password',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'user_id', 'user_id');
    }

    public function activity()
    {
        return $this->hasMany(ActivityLog::class, 'user_id', 'user_id');
    }

    public function pekerjaanfk()
    {
        return $this->belongsTo(JenisPekerjaan::class, 'jenis_pekerjaan_id', 'jenis_pekerjaan_id');
    }

    public function prodifk()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'prodi_id');
    }

    // accessor untuk nama depan
    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0];
    }
}

