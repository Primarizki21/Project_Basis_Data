<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KategoriKomplainController;
use App\Http\Controllers\JenisPekerjaanController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


Route::get('/', fn() => redirect()->route('login.form'));
Route::resource('kategori', KategoriKomplainController::class);

// Sementara matikan dulu
// Route::resource('jenis_pekerjaan', JenisPekerjaanController::class);

// Public (no navbar)
Route::get('/login', fn() => view('auth.login'))->name('login.form');
Route::get('/register', fn() => view('auth.register'))->name('register.form');
Route::get('/forgot', fn() => view('auth.forgot'))->name('password.request');

// Protected helper
$protect = function ($view) {
    if (! session('user')) {
        return redirect()->route('login.form')->with('error','Silakan login terlebih dahulu.');
    }
    return view($view);
};

// Protected pages (navbar visible)
// Route::get('/beranda', fn() => $protect('pages.beranda'))->name('beranda');
// Route::get('/profil', fn() => $protect('pages.profil'))->name('profil');
// Route::get('/riwayat', fn() => $protect('pages.riwayat'))->name('riwayat');
// Route::get('/kontak', fn() => $protect('pages.kontak'))->name('kontak');

// Show create pengaduan form
// Route::get('/pengaduan/create', function () {
//     if (! Auth::check()) {
//         return redirect()->route('login.form')
//             ->with('error','Silakan login terlebih dahulu.');
//     }
//     return view('pengaduan.create');
// })->name('pengaduan.form');

// POST endpoints (simulation)
Route::post('/register', function (Request $r) {
    $r->validate([
        'nim' => 'required|string|max:25|unique:user,nim',
        'nama' => 'required|string|max:100',
        'email' => 'required|email|unique:user,email',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan,Lainnya',
        'tempat_lahir' => 'required|string|max:50',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'nomor_telepon' => 'required|string|max:15',
        'pekerjaan' => 'required|string|max:50',
        'password' => 'required|min:6|confirmed',
    ]);

    if (! str_ends_with($r->email, '@ftmm.unair.ac.id')) {
            return back()->withErrors(['email'=>'Gunakan email @ftmm.unair.ac.id'])->withInput();
        }

    User::create([
        'nim' => $r->nim,
        'nama' => $r->nama,
        'email' => $r->email,
        'jenis_kelamin' => $r->jenis_kelamin,
        'tempat_lahir' => $r->tempat_lahir,
        'tanggal_lahir' => $r->tanggal_lahir,
        'alamat' => $r->alamat,
        'nomor_telepon' => $r->nomor_telepon,
        'pekerjaan' => $r->pekerjaan,
        'password' => Hash::make($r->password),
    ]);

    return redirect()->route('login.form')->with('success', 'Akun berhasil terdaftar! Silakan login.');
})->name('register');

// Route::post('/login', function (Request $r) {
//     $r->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     if (! str_ends_with($r->email, '@ftmm.unair.ac.id')) {
//         return back()->withErrors(['email' => 'Hanya email @ftmm.unair.ac.id yang diperbolehkan.'])->withInput();
//     }

//     // Auth::attempt otomatis cek user + hash password
//     if (Auth::attempt(['email' => $r->email, 'password' => $r->password])) {
//         $r->session()->regenerate(); // keamanan (anti session fixation)
//         return redirect()->route('beranda');
//     }

//     return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
// })->name('login');

Route::post('/login', function (Request $r) {
    $r->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    if (! str_ends_with($r->email, '@ftmm.unair.ac.id')) {
        return back()->withErrors(['email' => 'Hanya email @ftmm.unair.ac.id yang diperbolehkan.'])->withInput();
    }
    $credentials = $r->only('email', 'password');
    
    if (Auth::guard('web')->attempt($credentials)) {
        $r->session()->regenerate();
        return redirect()->route('beranda');
    }
    // $adminCredentials = [
    //     'email' => $r->email, 
    //     'password' => $r->password
    // ];
    if (Auth::guard('admin')->attempt($credentials)) {
        $r->session()->regenerate();
        return redirect()->route('beranda');
    }
    return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
})->name('login');

Route::post('/forgot', function (Request $r) {
    $r->validate([
        'email' => 'required|email',
    ]);

    // contoh dummy log, kalau nanti mau kirim email bisa disesuaikan
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
Route::middleware('auth')->group(function () {
    Route::get('/beranda', fn() => view('pages.beranda'))->name('beranda');
    Route::get('/profil', fn() => view('pages.profil'))->name('profil');
    Route::get('/riwayat', [PengaduanController::class, 'riwayat'])->name('riwayat.index');
    Route::get('/kontak', fn() => view('pages.kontak'))->name('kontak');
    
    // Route::get('/pengaduan/create', fn() => view('pengaduan.create'))->name('pengaduan.form');
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.form');
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    
    // Route::post('/pengaduan', function (Request $r) {
    //     $r->validate(['judul'=>'required','kategori'=>'required','deskripsi'=>'required']);
    //     // Simpan ke database nanti, sementara dummy
    //     return redirect()->route('riwayat')->with('success','Pengaduan berhasil dibuat.');
    // })->name('pengaduan.store');
    
    Route::post('/profil/update', function (Request $r) {
        $r->validate([
            'nama' => 'required',
            'nomor_telepon' => 'nullable|string|max:15',
        ]);
        
        $user = Auth::user(); // instance App\Models\User
        $user->nama = $r->nama;
        $user->nomor_telepon = $r->nomor_telepon ?? $user->nomor_telepon;
        $user->save(); // sekarang harusnya jalan
        
        return back()->with('success', 'Profil berhasil diperbarui.');
    })->name('profil.update');
});

// Store pengaduan (dummy)
// Route::post('/pengaduan', function (Request $r) {
//     $r->validate(['judul'=>'required','kategori'=>'required','deskripsi'=>'required']);
//     $complaints = session('complaints', []);
//     $complaints[] = [
//         'id' => count($complaints) + 1,
//         'judul' => $r->judul,
//         'kategori' => $r->kategori,
//         'deskripsi' => $r->deskripsi,
//         'status' => 'Menunggu',
//         'tanggal' => now()->format('d M Y')
//     ];
//     session(['complaints' => $complaints]);
//     return redirect()->route('riwayat')->with('success','Pengaduan berhasil dibuat (dummy).');
// })->name('pengaduan.store');

// Backup routes from earlier (commented out)
// Route::get('/', function () {
    //     return view('index');
// })->name('index');


// Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
// Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
// Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
// Route::post('/pengaduan/{id}/tindak-lanjut', [PengaduanController::class, 'tindakLanjut'])->name('pengaduan.tindakLanjut');
// Route::get('/admin', [PengaduanController::class, 'index'])->name('admin.pengaduan.index');
// Route::resource('pengaduan', PengaduanController::class);


// Route::get('/form', [LaporanController::class, 'showForm'])->name('form')->middleware('auth');
// Route::post('/form', [LaporanController::class, 'store'])->name('form.store')->middleware('auth');

// cookkk

// Route::get('/login', [UserController::class, 'showLogin'])->name('login');
// Route::post('/register', [UserController::class, 'register'])->name('register');
// Route::post('/login', [UserController::class, 'login'])->name('login.submit');
// Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Route::get('/admin', function () {
//     return view('admin');
// });
// Route::get('/admin', [PengaduanController::class, 'index'])->name('admin.pengaduan.index');

