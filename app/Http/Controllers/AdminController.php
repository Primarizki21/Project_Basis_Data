<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriKomplain;
use App\Models\Pengaduan;
use App\Models\ActivityLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboardIndex()
    {
        $activities = ActivityLog::latest()->take(5)->get(); // Ambil 5 aktivitas terbaru
        return view('pages.admin.dashboard', ['activities' => $activities]);
    }

    public function kelolaPengaduan()
    {
        $totalHariIni = Pengaduan::whereDate('created_at', today())->count();
        $belumDiproses = Pengaduan::where('status_pengaduan', 'Menunggu')->count();
        $sedangDiproses = Pengaduan::where('status_pengaduan', 'Diproses')->count();
        
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $selesaiMingguIni = Pengaduan::where('status_pengaduan', 'Selesai')
                                     ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
                                     ->count();

        $kategoriKomplains = KategoriKomplain::orderBy('jenis_komplain')->get();

        $pengaduans = Pengaduan::with(['pelapor', 'kategoriKomplain'])
                               ->latest()
                               ->paginate(10);

        return view('pages.admin.kelola-pengaduan', [
            'totalHariIni' => $totalHariIni,
            'belumDiproses' => $belumDiproses,
            'sedangDiproses' => $sedangDiproses,
            'selesaiMingguIni' => $selesaiMingguIni,
            'kategoriKomplains' => $kategoriKomplains,
            'pengaduans' => $pengaduans,
        ]);
    }
}
