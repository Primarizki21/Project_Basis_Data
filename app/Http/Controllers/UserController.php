<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\JenisPekerjaan;


class UserController extends Controller
{
    // Menampilkan halaman login/register
    public function showLogin()
    {
        return view('users');
    }

    // Menyimpan user baru
    public function register(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:users,nim',
            'nama' => 'required',
            'password' => 'required|min:6',
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
            'role' => 'Pelapor',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }


    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('nim', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('index')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'NIM atau Password salah.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function create()
    {
        // Ambil semua data jenis pekerjaan
        $listPekerjaan = JenisPekerjaan::all();

        // Kirim data tersebut ke view
        return view('user.create', ['listPekerjaan' => $listPekerjaan]);
    }

    public function edit(User $user)
    {
        // Ambil semua data jenis pekerjaan
        $listPekerjaan = JenisPekerjaan::all();
        
        // Kirim data pekerjaan dan data user yang akan diedit ke view
        return view('user.edit', [
            'user' => $user,
            'listPekerjaan' => $listPekerjaan
        ]);
    }
}
