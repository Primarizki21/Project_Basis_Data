<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user'; // table name
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

