<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VisualisasiController;

Route::prefix('visualisasi')->group(function () {
    Route::get('/demografi-prodi', [VisualisasiController::class, 'demografiProdi']);
    Route::get('/demografi-gender', [VisualisasiController::class, 'demografiGender']);
    Route::get('/demografi-angkatan', [VisualisasiController::class, 'demografiAngkatan']);
});
