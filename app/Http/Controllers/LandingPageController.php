<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan; // Contoh jika Anda butuh data

class LandingPageController extends Controller
{
    public function index()
    {
        $pengaduanAnonim = Pengaduan::whereNull('user_id')
                                    ->latest()
                                    ->take(6)
                                    ->get();
        
        $warnaKategori = [
            'Akademik' => '#0d6efd',
            'Fasilitas' => '#198754',
            'Kekerasan' => '#dc3545',
            'Kemahasiswaan' => '#ffc107',
            'Lainnya' => '#6c757d',
        ];
        return view('welcome', [
            'pengaduanAnonim' => $pengaduanAnonim,
            'warnaKategori' => $warnaKategori
        ]);
    }
}