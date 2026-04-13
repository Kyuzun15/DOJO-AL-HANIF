<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member; // Wajib diimport untuk mengelola data pendaftar
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CalonMember;

class AuthController extends Controller
{
    /**
     * 1. PROSES LOGIN
     * Mengecek username dan password dari modal rahasia
     */
    public function login(Request $request)
    {
        // Validasi input sederhana
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Coba login (Laravel otomatis mencocokkan password yang sudah di-hash)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika sukses, lempar ke dashboard
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali, Boss!');
        }

        // Jika gagal, balikkan ke halaman sebelumnya dengan pesan error
        return back()->with('error', 'Akses ditolak! Username atau Password salah.');
    }

    /**
     * 2. HALAMAN DASHBOARD
     * Mengambil data dari tabel members untuk ditampilkan di tabel
     */
    public function dashboard()
    {
        // Mengambil data dari dua tabel berbeda
        $calon = CalonMember::orderBy('created_at', 'desc')->get();
        $aktif = Member::orderBy('created_at', 'desc')->get();

        // Pastikan dikirim lewat compact
        return view('admin.dashboard', compact('calon', 'aktif'));
    }

    /**
     * 3. TERIMA ANGGOTA
     * Mengubah status dari 'calon' menjadi 'aktif'
     */
    public function terimaMember($id)
    {
        // 1. Temukan data di tabel Calon
        $calon = CalonMember::findOrFail($id);

        // 2. Pindahkan (Copy) ke tabel Member
        Member::create([
            'nama_lengkap' => $calon->nama_lengkap,
            'no_whatsapp' => $calon->no_whatsapp,
            'umur' => $calon->umur,
            'sabuk' => $calon->sabuk,
            'tanggal_diterima' => now(), // Catat waktu resmi bergabung
        ]);

        // 3. Hapus data dari tabel CalonMember (Agar tidak duplikat)
        $calon->delete();

        return back()->with('success', 'Data berhasil dipindahkan ke tabel Anggota Resmi!');
    }

    /**
     * 4. HAPUS DATA
     * Menghapus pendaftaran (Bisa dilakukan Tier 1 & Tier 2)
     */
    public function hapusMember($id)
    {
        $member = Member::findOrFail($id);
        $nama = $member->nama_lengkap;

        $member->delete();

        return back()->with('success', 'Data ' . $nama . ' telah dihapus dari sistem.');
    }

    /**
     * 5. PROSES LOGOUT
     * Keluar dari sistem dan menghancurkan session
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil keluar. Sampai jumpa lagi!');
    }
}