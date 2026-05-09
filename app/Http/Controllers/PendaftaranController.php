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
        // Konversi format tanggal_lahir untuk validasi unique
        $tanggal_lahir_db = null;
        if ($request->filled('tanggal_lahir')) {
            try {
                $tanggal_lahir_db = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal_lahir)->format('Y-m-d');
            } catch (\Exception $e) {}
        }

        // 1. Validasi
        $data = $request->validate([
            'nama' => [
                'required',
                \Illuminate\Validation\Rule::unique('members')->where(function ($query) use ($request, $tanggal_lahir_db) {
                    return $query->where('tempat_lahir', $request->tempat_lahir)
                                 ->where('tanggal_lahir', $tanggal_lahir_db);
                }),
                \Illuminate\Validation\Rule::unique('calon_members')->where(function ($query) use ($request, $tanggal_lahir_db) {
                    return $query->where('tempat_lahir', $request->tempat_lahir)
                                 ->where('tanggal_lahir', $tanggal_lahir_db);
                })
            ],
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date_format:d/m/Y',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'nama_ayah' => 'required',
            'no_hp_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp_ibu' => 'required',
            'alamat' => 'required',
            'ukuran_baju' => 'required',
        ], [
            'nama.unique' => 'Maaf, data pendaftaran dengan Nama, Tempat, dan Tanggal Lahir yang sama persis sudah terdaftar di sistem kami.'
        ]);

        // Konversi format tanggal_lahir dari d/m/Y ke Y-m-d untuk database
        $data['tanggal_lahir'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['tanggal_lahir'])->format('Y-m-d');

        // 2. Simpan ke database
        $calon = CalonMember::create($data);

        // 3. Rakit Pesan WhatsApp
        // Ganti nomor ini dengan nomor WhatsApp Admin (gunakan awalan 62)
        $no_admin = "6283895930746"; 
        
        $pesan = "Osu! Admin DOJO AL-HANIF, ada pendaftar baru:\n\n";
        $pesan .= "Nama: " . $calon->nama . "\n";
        $pesan .= "TTL: " . $calon->tempat_lahir . ", " . $request->tanggal_lahir . "\n";
        $pesan .= "BB/TB: " . $calon->berat_badan . "kg / " . $calon->tinggi_badan . "cm\n";
        $pesan .= "Nama Ayah: " . $calon->nama_ayah . " (" . $calon->no_hp_ayah . ")\n";
        $pesan .= "Alamat: " . $calon->alamat . "\n";
        $pesan .= "Ukuran Baju: " . $calon->ukuran_baju . "\n\n";
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