<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;

Route::get('/', function () { return view('welcome'); });

// Pendaftaran
Route::get('/daftar', [PendaftaranController::class, 'index']);
Route::post('/daftar', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran-sukses', [PendaftaranController::class, 'sukses']);

// Login/Logout
Route::post('/pintu-rahasia', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Dashboard Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    
    // Calon
    Route::post('/admin/calon/{id}/terima', [AuthController::class, 'terimaMember']);
    Route::delete('/admin/calon/{id}/hapus', [AuthController::class, 'hapusCalon']);

    // Anggota (Update Dasar & Status)
    Route::put('/admin/anggota/{id}', [AuthController::class, 'updateAnggota']);
    Route::post('/admin/anggota', [AuthController::class, 'storeAnggotaAktif']);
    
    // FITUR PRESTASI KHUSUS (Halaman Baru)
    Route::get('/admin/anggota/{id}/prestasi', [AuthController::class, 'showPrestasi']); // <-- Rute Baru
    Route::post('/admin/anggota/{id}/prestasi', [AuthController::class, 'tambahPrestasi']);
    Route::delete('/admin/prestasi/{id}/hapus', [AuthController::class, 'hapusPrestasi']);
});