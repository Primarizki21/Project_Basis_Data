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
        return view('welcome', ['pengaduanAnonim' => $pengaduanAnonim]);
    }
}