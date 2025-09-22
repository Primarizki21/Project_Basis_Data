<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriKomplain extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'kategori_komplain';
    protected $primaryKey = 'kategori_komplain_id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'kategori_komplain_id',
        'jenis_komplain',
        'deskripsi_komplain',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_komplain_id');
    }
}
