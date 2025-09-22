<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Menampilkan halaman login/register
    public function showLogin()
    {
        return view('user');
    }

    // Menyimpan user baru
    public function register(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:user,nim',
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
            'pekerjaan' => $request->pekerjaan,
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
}
