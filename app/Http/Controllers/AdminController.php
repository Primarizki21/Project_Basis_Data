<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriKomplain;
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Admin;
use App\Models\ActivityLog;
use App\Models\Prodi;
use App\Models\JenisPekerjaan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Prodi;
use App\Models\JenisPekerjaan;
use Illuminate\Support\Facades\Hash;



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

    public function kelolaPengaduan(Request $request)
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
        // $pengaduans = Pengaduan::with(['pelapor', 'kategoriKomplain'])
        //                        ->latest()
        //                        ->paginate(10);

        $warnaKategori = [
            'Akademik' => '#0d6efd',
            'Fasilitas' => '#198754',
            'Kekerasan' => '#dc3545',
            'Kemahasiswaan' => '#ffc107',
            'Lainnya' => '#6c757d',
        ];
        // --- MULAI LOGIKA FILTER DINAMIS ---
        // Ganti query pengaduan yang statis dengan yang dinamis
        $query = Pengaduan::with(['pelapor', 'kategoriKomplain']);

        // Filter 1: Berdasarkan Pencarian Teks (No. Tiket atau Deskripsi)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            // Cek apakah pencarian adalah nomor tiket (contoh: #TKT-001)
            if (preg_match('/^#?TKT-?(\d+)$/i', $searchTerm, $matches)) {
                $query->where('pengaduan_id', $matches[1]);
            } else {
                $query->where('deskripsi_kejadian', 'like', '%' . $searchTerm . '%');
            }
        }

        // Filter 2: Berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status_pengaduan', $request->status);
        }

        // Filter 3: Berdasarkan Kategori
        if ($request->filled('kategori_komplain_id')) {
            $query->where('kategori_komplain_id', $request->kategori_komplain_id);
        }

        // Filter 4: Berdasarkan Tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_kejadian', $request->tanggal);
        }

        // Eksekusi query dengan paginasi
        $pengaduans = $query->latest()->paginate(10)->withQueryString();
        // --- AKHIR LOGIKA FILTER ---
        return view('pages.admin.kelola-pengaduan', [
            'totalHariIni' => $totalHariIni,
            'belumDiproses' => $belumDiproses,
            'sedangDiproses' => $sedangDiproses,
            'selesaiMingguIni' => $selesaiMingguIni,
            'kategoriKomplains' => $kategoriKomplains,
            'pengaduans' => $pengaduans,
            'warnaKategori' => $warnaKategori
        ]);
    }

    public function kelolaUser(Request $request) // <-- 2. Tambahkan Request $request di sini
    {
        $totalUsers = User::count();
        $totalMahasiswa = User::where('jenis_pekerjaan_id', '1')->count();
        $totalStaff = User::whereIn('jenis_pekerjaan_id', ['2', '3', '4'])->count();
        $totalAdmin = Admin::count();
        $prodis = Prodi::orderBy('nama_prodi', 'asc')->get();
        $jenisPekerjaan = JenisPekerjaan::all();
        $admins = Admin::paginate(5, ['*'], 'admin_page');
<<<<<<< HEAD

        $query = User::with('prodifk', 'pekerjaanfk');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nim', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('jenis_pekerjaan_id')) {
            $query->where('jenis_pekerjaan_id', $request->jenis_pekerjaan_id);
        }

        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }

        $users = $query->latest()->paginate(5)->withQueryString();

=======
        $prodis = Prodi::orderBy('nama_prodi')->get();
        $jenisPekerjaan = JenisPekerjaan::orderBy('nama_pekerjaan')->get();
>>>>>>> c167a67 (fix user in kelola user)
        return view('pages.admin.kelola-user', [
            'totalUsers' => $totalUsers,
            'totalMahasiswa' => $totalMahasiswa,
            'totalStaff' => $totalStaff,
            'totalAdmin' => $totalAdmin,
            'users' => $users,
            'admins' => $admins,
            'prodis' => $prodis,
<<<<<<< HEAD
            'jenisPekerjaan' => $jenisPekerjaan
=======
            'jenisPekerjaan' =>$jenisPekerjaan,
>>>>>>> c167a67 (fix user in kelola user)
        ]);
    }
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'nim' => 'required|string|max:50',
            'nomor_telepon' => 'nullable|string|max:20',
            'password' => 'required|confirmed|min:6',
            'jenis_pekerjaan_id' => 'required|exists:jenis_pekerjaan,jenis_pekerjaan_id',
            'prodi_id' => 'required|exists:prodi,prodi_id',
        ]);

        $user = new User();
        $user->nama = $validated['nama'];
        $user->email = $validated['email'];
        $user->nim = $validated['nim'];
        $user->nomor_telepon = $validated['nomor_telepon'] ?? null;
        $user->jenis_pekerjaan_id = $validated['jenis_pekerjaan_id'];
        $user->prodi_id = $validated['prodi_id'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('admin.kelola-user')->with('success', 'User berhasil ditambahkan!');
    }


}
