<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\JenisPekerjaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ============================
    // AUTH SECTION
    // ============================
    public function showLogin()
    {
        return view('user');
        return view('user');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:user,nim',
            'nama' => 'required',
            'password' => 'required|min:6',
            'jenis_kelamin' => 'required|string',
            'role' => 'required|string',
            'prodi' => 'required_if:role,mahasiswa|integer|nullable',
            'angkatan' => 'required_if:role,mahasiswa|integer|nullable',
        ]);

        User::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'jenis_pekerjaan_id' => $request->jenis_pekerjaan_id ?? null,
            'prodi' => $request->prodi ?? null,
            'angkatan' => $request->angkatan ?? null,
            'role' => 'Pelapor',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nim', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('index')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'NIM atau Password salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    // ============================
    // USER CRUD SECTION
    // ============================
    public function create()
    {
        $listPekerjaan = JenisPekerjaan::all();
        return view('user.create', ['listPekerjaan' => $listPekerjaan]);
    }

    public function edit(User $user)
    {
        $listPekerjaan = JenisPekerjaan::all();
        return view('user.edit', [
            'user' => $user,
            'listPekerjaan' => $listPekerjaan
        ]);
    }

    // ============================
    // PROFIL PAGE SECTION
    // ============================
    public function profil()
    {
        $user = Auth::user();

        // Total semua pengaduan user
        $totalPengaduan = Pengaduan::where('user_id', $user->user_id)->count();

        // Hitung per status — sama dengan dashboard
        $menunggu = Pengaduan::where('user_id', $user->user_id)
            ->where('status_pengaduan', 'Menunggu')
            ->count();

        $diproses = Pengaduan::where('user_id', $user->user_id)
            ->where('status_pengaduan', 'Diproses')
            ->count();

        $selesai = Pengaduan::where('user_id', $user->user_id)
            ->where('status_pengaduan', 'Selesai')
            ->count();

        $ditolak = Pengaduan::where('user_id', $user->user_id)
            ->where('status_pengaduan', 'Ditolak')
            ->count();



        return view('pages.profil', compact(
            'user',
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak'
        ));
    }
}
