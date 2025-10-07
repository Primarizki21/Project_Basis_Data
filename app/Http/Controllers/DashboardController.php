<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $total = Pengaduan::where('user_id', $userId)->count();
        $diproses = Pengaduan::where('user_id', $userId)->where('status_pengaduan', 'Diproses')->count();
        $selesai = Pengaduan::where('user_id', $userId)->where('status_pengaduan', 'Selesai')->count();
        $menunggu = Pengaduan::where('user_id', $userId)->where('status_pengaduan', 'Menunggu')->count();
        $ditolak = Pengaduan::where('user_id', $userId)->where('status_pengaduan', 'Ditolak')->count();

        $pengaduanTerbaru = Pengaduan::with('kategoriKomplain')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.beranda', compact(
            'total', 'diproses', 'selesai', 'menunggu', 'ditolak', 'pengaduanTerbaru'
        ));
    }
}
