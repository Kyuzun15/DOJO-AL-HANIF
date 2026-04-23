<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KegiatanController;
Route::get('/', function () { 
    $latestArticles = \App\Models\Artikel::orderBy('published_date', 'desc')->take(5)->get();
    $kegiatans = \App\Models\Kegiatan::where('event_date', '>=', now()->toDateString())->orderBy('event_date', 'asc')->get();
    return view('welcome', compact('latestArticles', 'kegiatans')); 
});

// Pendaftaran
Route::get('/daftar', [PendaftaranController::class, 'index']);
Route::post('/daftar', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran-sukses', [PendaftaranController::class, 'sukses']);

// Profil Anggota (Publicly accessible)
Route::get('/profil-anggota', function () {
    $members = \App\Models\Member::orderBy('nama', 'asc')->get();

    $beltOrder = [
        'SABUK HITAM',
        'SABUK COKLAT',
        'SABUK UNGU',
        'SABUK BIRU',
        'SABUK HIJAU',
        'SABUK KUNING',
        'SABUK PUTIH',
        'BELUM PUNYA SABUK',
    ];

    $groupedMembers = [];
    foreach ($beltOrder as $belt) {
        $groupedMembers[$belt] = [];
    }

    foreach ($members as $member) {
        $sabukFull = $member->sabuk;
        if (str_contains($sabukFull, ' - ')) {
            $parts = explode(' - ', $sabukFull);
            $tingkatan = $parts[0];
            $warna = $parts[1];
            
            if (isset($groupedMembers[$warna])) {
                $member->tingkatan_sabuk = $tingkatan;
                $groupedMembers[$warna][] = $member;
            }
        } elseif ($sabukFull === 'Belum punya sabuk' || $sabukFull === null) {
            $member->tingkatan_sabuk = '-';
            if (isset($groupedMembers['BELUM PUNYA SABUK'])) {
                $groupedMembers['BELUM PUNYA SABUK'][] = $member;
            }
        }
    }

    // Filter out empty groups so we don't display empty sections
    foreach ($groupedMembers as $belt => $list) {
        if (count($list) === 0) {
            unset($groupedMembers[$belt]);
        }
    }

    return view('profil', compact('groupedMembers'));
});

// Artikel (Public)
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{slug}', [ArtikelController::class, 'show']);

// Kegiatan (Public)
Route::get('/kegiatan/{slug}', [KegiatanController::class, 'show']);

// Login/Logout
Route::post('/pintu-rahasia', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Dashboard Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'mainDashboard']);
    Route::get('/admin/anggota', [AuthController::class, 'dashboard']);
    
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

    // Admin Artikel
    Route::get('/admin/artikel', [ArtikelController::class, 'adminIndex']);
    Route::get('/admin/artikel/create', [ArtikelController::class, 'create']);
    Route::post('/admin/artikel', [ArtikelController::class, 'store']);
    Route::get('/admin/artikel/{id}/edit', [ArtikelController::class, 'edit']);
    Route::put('/admin/artikel/{id}', [ArtikelController::class, 'update']);
    Route::delete('/admin/artikel/{id}', [ArtikelController::class, 'destroy']);

    // Admin Kegiatan
    Route::get('/admin/kegiatan', [KegiatanController::class, 'adminIndex']);
    Route::get('/admin/kegiatan/create', [KegiatanController::class, 'create']);
    Route::post('/admin/kegiatan', [KegiatanController::class, 'store']);
    Route::get('/admin/kegiatan/{id}/edit', [KegiatanController::class, 'edit']);
    Route::put('/admin/kegiatan/{id}', [KegiatanController::class, 'update']);
    Route::delete('/admin/kegiatan/{id}', [KegiatanController::class, 'destroy']);
});