<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
Route::post('/pengaduan/{id}/tindak-lanjut', [PengaduanController::class, 'tindakLanjut'])->name('pengaduan.tindakLanjut');

// Route::get('/form', [LaporanController::class, 'showForm'])->name('form')->middleware('auth');
// Route::post('/form', [LaporanController::class, 'store'])->name('form.store')->middleware('auth');

// cookkk

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/admin', function () {
    return view('admin');
});
Route::get('/admin', [PengaduanController::class, 'index'])->name('admin.pengaduan.index');

