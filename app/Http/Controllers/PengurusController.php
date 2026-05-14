<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Pengurus;

class PengurusController extends Controller
{
    /**
     * Display the public organizational structure.
     */
    public function index()
    {
        $pengurus = Pengurus::all()->groupBy('kode_jabatan');
        return view('struktur-organisasi', compact('pengurus'));
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $pengurus = Pengurus::all();
        return view('admin.pengurus.index', compact('pengurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengurus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_jabatan' => 'required|string',
            'sub_jabatan' => 'nullable|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'tingkatan' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'prestasi_lomba' => 'nullable|string',
            'prestasi_sertifikasi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mapping Nama Jabatan otomatis dari Kode Jabatan
        $mapping = [
            'ketua' => 'KETUA',
            'bendahara' => 'BENDAHARA',
            'sekretaris' => 'SEKRETARIS',
            'bimbingan_presiden_1' => 'BIMBINGAN PRESIDEN',
            'bidang_usaha' => 'BIDANG USAHA',
            'bimbingan_presiden_2' => 'BIMBINGAN PRESIDEN',
            'ukt_gasuku' => 'UKT & GASUKU',
        ];

        $validated['nama_jabatan'] = $mapping[$request->kode_jabatan] ?? 'PENGURUS';

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pengurus'), $filename);
            $validated['foto'] = $filename;
        }

        Pengurus::create($validated);

        return redirect('/admin/pengurus')->with('success', 'Data pengurus berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $validated = $request->validate([
            'kode_jabatan' => 'required|string',
            'sub_jabatan' => 'nullable|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'tingkatan' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'prestasi_lomba' => 'nullable|string',
            'prestasi_sertifikasi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mapping Nama Jabatan otomatis dari Kode Jabatan
        $mapping = [
            'ketua' => 'KETUA',
            'bendahara' => 'BENDAHARA',
            'sekretaris' => 'SEKRETARIS',
            'bimbingan_presiden_1' => 'BIMBINGAN PRESIDEN',
            'bidang_usaha' => 'BIDANG USAHA',
            'bimbingan_presiden_2' => 'BIMBINGAN PRESIDEN',
            'ukt_gasuku' => 'UKT & GASUKU',
        ];

        $validated['nama_jabatan'] = $mapping[$request->kode_jabatan] ?? 'PENGURUS';

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($pengurus->foto && File::exists(public_path('pengurus/' . $pengurus->foto))) {
                File::delete(public_path('pengurus/' . $pengurus->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pengurus'), $filename);
            $validated['foto'] = $filename;
        }

        $pengurus->update($validated);

        return redirect('/admin/pengurus')->with('success', 'Data pengurus berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        
        if ($pengurus->foto && File::exists(public_path('pengurus/' . $pengurus->foto))) {
            File::delete(public_path('pengurus/' . $pengurus->foto));
        }

        $pengurus->delete();

        return redirect('/admin/pengurus')->with('success', 'Data pengurus berhasil dihapus!');
    }
}
