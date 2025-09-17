<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user'; // defaultnya 'users', kita ubah ke 'user'
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'nim',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'pekerjaan',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
