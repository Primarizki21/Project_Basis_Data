<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriKomplain;
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Admin;
use App\Models\ActivityLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboardIndex()
    {
        $activities = ActivityLog::latest()->take(5)->get();
        $totalUsers = User::count();
        $totalPengaduan = Pengaduan::count();
        $belumDiproses = Pengaduan::where('status_pengaduan', 'Menunggu')->count();
        $selesaiBulanIni = Pengaduan::where('status_pengaduan', 'Selesai')
                                    ->whereMonth('updated_at', now()->month)
                                    ->count();
        return view('pages.admin.dashboard', [
            'activities' => $activities, 
            'totalUsers' => $totalUsers,
            'totalPengaduan' => $totalPengaduan,
            'belumDiproses' => $belumDiproses,
            'selesaiBulanIni' => $selesaiBulanIni
        ]);
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

    public function kelolaUser()
    {
        $totalUsers = User::count();
        $totalMahasiswa = User::where('jenis_pekerjaan_id', 'Mahasiswa')->count();
        $totalStaff = User::whereIn('jenis_pekerjaan_id', ['2', '3', '4'])->count();
        $totalAdmin = Admin::count();
        $users = User::with('prodifk', 'pekerjaanfk') // Asumsi nama relasi
                     ->latest()
                     ->paginate(5);
        $admins = Admin::paginate(5, ['*'], 'admin_page');
        return view('pages.admin.kelola-user', [
            'totalUsers' => $totalUsers,
            'totalMahasiswa' => $totalMahasiswa,
            'totalStaff' => $totalStaff,
            'totalAdmin' => $totalAdmin,
            'users' => $users,
            'admins' => $admins,
        ]);
    }
}
