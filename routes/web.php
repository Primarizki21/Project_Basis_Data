<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    UserController,
    LaporanController,
    PengaduanController,
    KategoriKomplainController,
    JenisPekerjaanController,
    DashboardController,
    LandingPageController,
    AdminController
};
use App\Models\{User, Prodi, JenisPekerjaan};

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('welcome');

// =====================
//  KATEGORI KOMPLAIN
// =====================
Route::resource('kategori', KategoriKomplainController::class);

// Halaman form pengaduan anonim
Route::get('/pengaduan/anonim', [PengaduanController::class, 'createAnonim'])->name('pengaduan.createAnonim');

// Proses penyimpanan pengaduan anonim
Route::post('/pengaduan/anonim', [PengaduanController::class, 'storeAnonim'])->name('pengaduan.storeAnonim');


// =====================
//  AUTH PAGES
// =====================
Route::get('/login', fn() => view('auth.login'))->name('login.form');

Route::get('/register', function () {
    $listPekerjaan = JenisPekerjaan::all();
    $listProdi = Prodi::all();
    return view('auth.register', compact('listPekerjaan', 'listProdi'));
})->name('register.form');

Route::get('/forgot', fn() => view('auth.forgot'))->name('password.request');

// =====================
//  REGISTER
// =====================
Route::post('/register', function (Request $r) {
    $r->validate([
        'nim' => 'required|string|max:25|unique:user,nim',
        'nama' => 'required|string|max:100',
        'email' => [
            'required', 'email', 'unique:user,email', 'unique:admin,email',
            'ends_with:@ftmm.unair.ac.id'
        ],
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'tempat_lahir' => 'required|string|max:50',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'nomor_telepon' => 'required|string|max:15',
        'jenis_pekerjaan_id' => 'required|integer|exists:jenis_pekerjaan,jenis_pekerjaan_id',
        'prodi' => 'required_if:jenis_pekerjaan_id,1|integer|exists:prodi,prodi_id|nullable',
        'angkatan' => 'required_if:jenis_pekerjaan_id,1|digits:4|nullable',
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
        'prodi_id' => $r->prodi,
        'angkatan' => $r->angkatan,
        'password' => Hash::make($r->password),
    ]);
    return redirect()->route('login.form')->with('success', 'Akun berhasil terdaftar! Silakan login.');
})->name('register');

// =====================
//  LOGIN
// =====================
Route::post('/login', function (Request $r) {
    $validator = Validator::make($r->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);
    if ($validator->fails()) return back()->withErrors($validator)->withInput();

    $credentials = $r->only('email', 'password');
    
    if (Auth::guard('admin')->attempt($credentials)) {
        $r->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }
    
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

// =====================
//  FORGOT PASSWORD
// =====================
Route::post('/forgot', function (Request $r) {
    $r->validate(['email' => 'required|email']);
    $log = session('forgot_log', []);
    $log[] = ['email' => $r->email, 'at' => now()->toDateTimeString()];
    session(['forgot_log' => $log]);
    return redirect()->route('login.form')->with('success','Link reset password telah dikirim, silakan cek email.');
})->name('forgot');

// =====================
//  LOGOUT
// =====================
Route::post('/logout', function (Request $r) {
    Auth::logout();
    $r->session()->invalidate();
    $r->session()->regenerateToken();
    return redirect()->route('login.form')->with('success','Kamu telah logout.');
})->name('logout');

// =====================
//  PROTECTED ROUTES - USER ONLY
// =====================
Route::middleware(['auth:web'])->group(function () {
    Route::get('/beranda', [DashboardController::class, 'index'])
        ->name('beranda');
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::view('/kontak', 'pages.kontak')->name('kontak');
    Route::get('/riwayat', [PengaduanController::class, 'index'])
        ->name('riwayat');

    // Pengaduan CRUD
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');

    // Profil Update
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

    // Password Update
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

// =====================
//  PROTECTED ROUTES - ADMIN ONLY
// =====================
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboardIndex'])->name('dashboard');
    Route::get('/kelola-pengaduan', [AdminController::class, 'kelolaPengaduan'])->name('kelola-pengaduan');
    Route::get('/kelola-user', [AdminController::class, 'kelolaUser'])->name('kelola-user');
    Route::post('/kelola-user', [AdminController::class, 'storeUser'])->name('kelola-user.store');
    Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    Route::get('/profil', [AdminController::class, 'profilIndex'])->name('profil');
    Route::put('/profil/password', [AdminController::class, 'updatePassword'])->name('profil.password');
    Route::get('/kelola-user/detail/{user}', [AdminController::class, 'showUserDetail'])->name('kelola-user.detail');
    Route::delete('/kelola-user/{user}', [AdminController::class, 'destroyUser'])->name('kelola-user.destroy');
    Route::get('/users/{user_id}/edit', [UserController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user_id}', [UserController::class, 'updateUser'])->name('users.update');
});
