<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KategoriKomplainController;
use App\Http\Controllers\JenisPekerjaanController;
use App\Models\JenisPekerjaan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


Route::get('/', fn() => redirect()->route('login.form'));
Route::resource('kategori', KategoriKomplainController::class);

// Sementara matikan dulu
// Route::resource('jenis_pekerjaan', JenisPekerjaanController::class);

// Public (no navbar)
Route::get('/login', fn() => view('auth.login'))->name('login.form');
Route::get('/register', function () {
    $listPekerjaan = JenisPekerjaan::all();

    return view('auth.register', ['listPekerjaan' => $listPekerjaan]);
    
})->name('register.form');Route::get('/forgot', fn() => view('auth.forgot'))->name('password.request');

// Protected helper
$protect = function ($view) {
    if (! session('user')) {
        return redirect()->route('login.form')->with('error','Silakan login terlebih dahulu.');
    }
    return view($view);
};

Route::post('/register', function (Request $r) {
    $r->validate([
        'nim' => 'required|string|max:25|unique:user,nim',
        'nama' => 'required|string|max:100',
        'email' => [
            'required',
            'email',
            'unique:user,email', // Verifikasi ke tabel user
            'unique:admin,email', // Verifikasi ke tabel admin
            'ends_with:@ftmm.unair.ac.id'
        ],
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'tempat_lahir' => 'required|string|max:50',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'nomor_telepon' => 'required|string|max:15',
        'jenis_pekerjaan_id' => 'required|integer|exists:jenis_pekerjaan,jenis_pekerjaan_id',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'nim' => $r->nim,
        'nama' => $r->nama,
        'email' => $r->email,
        'jenis_kelamin' => $r->jenis_kelamin,
        'tempat_lahir' => $r->tempat_lahir,
        'tanggal_lahir' => $r->tanggal_lahir,
        'alamat' => $r->alamat,
        'nomor_telepon' => $r->nomor_telepon,
        'jenis_pekerjaan_id' => $r->jenis_pekerjaan_id,
        'password' => Hash::make($r->password),
    ]);

    return redirect()->route('login.form')->with('success', 'Akun berhasil terdaftar! Silakan login.');
})->name('register');

Route::post('/login', function (Request $r) {
    $validator = Validator::make($r->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    $credentials = $r->only('email', 'password');

    // Debug Admin
    // dd(Auth::guard('admin')->attempt($credentials));

    if (Auth::guard('web')->attempt($credentials)) {
        if (! str_ends_with($r->email, '@ftmm.unair.ac.id')) {
            Auth::guard('web')->logout(); // keluarin lagi
            return back()->withErrors([
                'email' => 'Hanya email @ftmm.unair.ac.id yang diperbolehkan.'
            ])->withInput();
        }
        $r->session()->regenerate();
        return redirect()->route('beranda');
    }
    if (Auth::guard('admin')->attempt($credentials)) {
        $r->session()->regenerate();
        return redirect()->route('beranda');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.'
    ])->withInput();
})->name('login');

Route::post('/forgot', function (Request $r) {
    $r->validate([
        'email' => 'required|email',
    ]);

    $log = session('forgot_log', []);
    $log[] = [
        'email' => $r->email,
        'at' => now()->toDateTimeString(),
    ];
    session(['forgot_log' => $log]);

    return redirect()->route('login.form')
        ->with('success','Link reset password telah dikirim, silakan cek email.');
})->name('forgot');

// Logout
Route::post('/logout', function (Request $r) {
    Auth::logout();
    $r->session()->invalidate();
    $r->session()->regenerateToken();
    return redirect()->route('login.form')->with('success','Kamu telah logout.');
})->name('logout');


// Protected pages (hanya bisa diakses kalau login)
Route::middleware(['auth:web,admin'])->group(function () {
    Route::get('/beranda', fn() => view('pages.beranda'))->name('beranda');
    Route::get('/profil', fn() => view('pages.profil'))->name('profil');
    Route::get('/riwayat', [PengaduanController::class, 'index'])->name('riwayat.index');
    Route::get('/kontak', fn() => view('pages.kontak'))->name('kontak');
    
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.form');
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');

    Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    
    Route::post('/profil/update', function (Request $r) {
        $r->validate([
            'nama' => 'required',
            'nomor_telepon' => 'nullable|string|max:15',
        ]);
        
        $user = Auth::user();
        $user->nama = $r->nama;
        $user->nomor_telepon = $r->nomor_telepon ?? $user->nomor_telepon;
        $user->save();
        
        return back()->with('success', 'Profil berhasil diperbarui.');
    })->name('profil.update');
});
