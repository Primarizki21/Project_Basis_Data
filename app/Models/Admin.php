<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
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

    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'admin_id');
    }
}
