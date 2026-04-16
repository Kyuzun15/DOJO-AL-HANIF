<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonMember;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran.daftar');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $data = $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'nama_ayah' => 'required',
            'no_hp_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp_ibu' => 'required',
            'alamat' => 'required',
        ]);

        // 2. Simpan ke database
        CalonMember::create($data);

        // 3. Rakit Pesan WhatsApp
        // Ganti nomor ini dengan nomor WhatsApp Admin (gunakan awalan 62)
        $no_admin = "6283895930746"; 
        
        $pesan = "Osu! Admin DOJO AL-HANIF, ada pendaftar baru:\n\n";
        $pesan .= "Nama: " . $request->nama . "\n";
        $pesan .= "TTL: " . $request->tempat_lahir . ", " . $request->tanggal_lahir . "\n";
        $pesan .= "BB/TB: " . $request->berat_badan . "kg / " . $request->tinggi_badan . "cm\n";
        $pesan .= "Nama Ayah: " . $request->nama_ayah . " (" . $request->no_hp_ayah . ")\n";
        $pesan .= "Alamat: " . $request->alamat . "\n\n";
        $pesan .= "Mohon segera dicek di Dashboard Admin.";

        // Jadikan URL-friendly (mengubah spasi menjadi %20, dll)
        $wa_link = "https://wa.me/" . $no_admin . "?text=" . urlencode($pesan);

        // 4. Redirect ke halaman sukses sambil membawa link WA
        return redirect('/pendaftaran-sukses')->with('wa_link', $wa_link);
    }

    // Fungsi baru untuk menampilkan halaman sukses
    public function sukses()
    {
        return view('pendaftaran.sukses');
    }
}