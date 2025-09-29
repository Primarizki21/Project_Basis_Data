<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';
    protected $primaryKey = 'prodi_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama_prodi',
    ];

    public function prodi()
    {
        return $this->hasMany(User::class, 'prodi_id');
    }
}
