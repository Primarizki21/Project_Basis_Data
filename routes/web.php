<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    UserController, LaporanController, PengaduanController, 
    KategoriKomplainController, JenisPekerjaanController, LandingPageController
};
use App\Models\{User, Prodi, JenisPekerjaan};

// Kategori
Route::resource('kategori', KategoriKomplainController::class);

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('welcome');

// Halaman form pengaduan anonim
Route::get('/pengaduan/anonim', [PengaduanController::class, 'createAnonim'])->name('pengaduan.createAnonim');
// Proses penyimpanan pengaduan anonim
Route::post('/pengaduan/anonim', [PengaduanController::class, 'storeAnonim'])->name('pengaduan.storeAnonim');


// Auth Pages
Route::get('/login', fn() => view('auth.login'))->name('login.form');
Route::get('/register', function () {
    $listPekerjaan = JenisPekerjaan::all();
    $listProdi = Prodi::all();
    return view('auth.register', compact('listPekerjaan', 'listProdi'));
})->name('register.form');
Route::get('/forgot', fn() => view('auth.forgot'))->name('password.request');

// Register
Route::post('/register', function (Request $r) {
    $r->validate([
        'nim' => 'required|string|max:25|unique:user,nim',
        'nama' => 'required|string|max:100',
        'email' => [
            'required','email','unique:user,email','unique:admin,email',
            'ends_with:@ftmm.unair.ac.id'
        ],
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'tempat_lahir' => 'required|string|max:50',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'nomor_telepon' => 'required|string|max:15',
        'jenis_pekerjaan_id' => 'required|integer|exists:jenis_pekerjaan,jenis_pekerjaan_id',
        'prodi' => 'required_if:jenis_pekerjaan_id,1|string|max:100',
        'angkatan' => 'required_if:jenis_pekerjaan_id,1|string|max:4',
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
        'prodi' => $r->prodi,
        'angkatan' => $r->angkatan,
        'password' => Hash::make($r->password),
    ]);

    return redirect()->route('login.form')->with('success', 'Akun berhasil terdaftar! Silakan login.');
})->name('register');

// Login
Route::post('/login', function (Request $r) {
    $validator = Validator::make($r->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);
    if ($validator->fails()) return back()->withErrors($validator)->withInput();

    $credentials = $r->only('email', 'password');
    
    // Try admin login first
    if (Auth::guard('admin')->attempt($credentials)) {
        $r->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }
    
    // Then try user login
    if (Auth::guard('web')->attempt($credentials)) {
        if (!str_ends_with($r->email, '@ftmm.unair.ac.id')) {
            Auth::guard('web')->logout();
            return back()->withErrors(['email' => 'Hanya email @ftmm.unair.ac.id yang diperbolehkan.'])->withInput();
        }
        $r->session()->regenerate();
        return redirect()->route('beranda');
    }

    return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
})->name('login');

// Forgot password
Route::post('/forgot', function (Request $r) {
    $r->validate(['email' => 'required|email']);
    $log = session('forgot_log', []);
    $log[] = ['email' => $r->email, 'at' => now()->toDateTimeString()];
    session(['forgot_log' => $log]);
    return redirect()->route('login.form')->with('success','Link reset password telah dikirim, silakan cek email.');
})->name('forgot');

// Logout
Route::post('/logout', function (Request $r) {
    Auth::logout();
    $r->session()->invalidate();
    $r->session()->regenerateToken();
    return redirect()->route('login.form')->with('success','Kamu telah logout.');
})->name('logout');

// Protected Routes - USER ONLY
Route::middleware(['auth:web'])->group(function () {
    Route::view('/beranda', 'pages.beranda')->name('beranda');
    Route::view('/profil', 'pages.profil')->name('profil');
    Route::view('/kontak', 'pages.kontak')->name('kontak');
    
    Route::get('/riwayat', function() {
        return view('pages.riwayat');
    })->name('riwayat');
    
    // Pengaduan Routes
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

    // Update Profil & Password
    Route::post('/profil/update', function (Request $r) {
        $r->validate([
            'nama' => 'required',
            'nomor_telepon' => 'nullable|string|max:15',
        ]);
        $user = Auth::user();
        $user->update([
            'nama' => $r->nama,
            'nomor_telepon' => $r->nomor_telepon ?? $user->nomor_telepon,
        ]);
        return back()->with('success', 'Profil berhasil diperbarui.');
    })->name('profil.update');

    Route::put('/profil/password', function (Request $r) {
        $r->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($r->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai']);
        }
        
        $user->update([
            'password' => Hash::make($r->new_password)
        ]);
        
        return back()->with('success', 'Password berhasil diubah');
    })->name('profil.password');
});

// Protected Routes - ADMIN ONLY
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');
    Route::view('/kelola-pengaduan', 'pages.admin.kelola-pengaduan')->name('kelola-pengaduan');
    Route::view('/visualisasi', 'pages.admin.visualisasi')->name('visualisasi');
    Route::view('/kelola-user', 'pages.admin.kelola-user')->name('kelola-user');
    
    // Admin bisa akses profil juga
    Route::view('/profil', 'pages.profil')->name('profil');
    
    // Admin update password
    Route::put('/profil/password', function (Request $r) {
        $r->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        
        $admin = Auth::guard('admin')->user();
        
        if (!Hash::check($r->old_password, $admin->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai']);
        }
        
        $admin->update([
            'password' => Hash::make($r->new_password)
        ]);
        
        return back()->with('success', 'Password berhasil diubah');
    })->name('profil.password');
});