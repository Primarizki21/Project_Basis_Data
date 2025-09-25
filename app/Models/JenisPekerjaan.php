<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'jenis_pekerjaan';
    protected $primaryKey = 'jenis_pekerjaan_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama_pekerjaan',
    ];

    public function pekerjaanpk()
    {
        return $this->hasMany(User::class, 'jenis_pekerjaan_id');
    }
}