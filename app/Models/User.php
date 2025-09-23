<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
tabel

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // table name
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
main
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
        'nomor_telepon',
        'pekerjaan',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'user_id');
    }
}

