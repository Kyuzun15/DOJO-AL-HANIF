<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;

/*
|--------------------------------------------------------------------------
| Jalur Publik (Pengunjung)
|--------------------------------------------------------------------------
*/

// Halaman Beranda (Tempat Easter Egg 'osu' berada)
Route::get('/', function () {
    return view('welcome');
});

// Halaman Form Pendaftaran (Input Data)
Route::get('/daftar', [PendaftaranController::class, 'index']);
// Proses Simpan + Redirect WA + Anti Spam (Throttle 3 kali per menit)
Route::post('/daftar', [PendaftaranController::class, 'store'])->middleware('throttle:3,1');


/*
|--------------------------------------------------------------------------
| Jalur Rahasia (Autentikasi Admin)
|--------------------------------------------------------------------------
*/

// Proses Login dari Modal Rahasia
Route::post('/pintu-rahasia', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| Jalur Khusus Admin (Terproteksi Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Halaman Utama Admin
    Route::get('/dashboard', [AuthController::class, 'dashboard']);

    // Fitur Kelola Anggota (Bisa dilakukan Tier 1 & Tier 2)
    Route::post('/admin/member/{id}/terima', [AuthController::class, 'terimaMember']);
    Route::delete('/admin/member/{id}/hapus', [AuthController::class, 'hapusMember']);

});

// Jalur Khusus Super Admin (Tier 1 Saja)
Route::middleware(['auth', 'role:tier_1'])->group(function () {
    // Fitur spesifik Tier 1 seperti kelola akun admin lain bisa ditaruh di sini nanti
});