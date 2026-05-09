<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function adminIndex()
    {
        $jadwals = \App\Models\Jadwal::all();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tempat' => 'required|string',
        ]);

        \App\Models\Jadwal::create($validated);

        return redirect('/admin/jadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = \App\Models\Jadwal::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'tempat' => 'required|string',
        ]);

        $jadwal = \App\Models\Jadwal::findOrFail($id);
        $jadwal->update($validated);

        return redirect('/admin/jadwal')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = \App\Models\Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect('/admin/jadwal')->with('success', 'Jadwal berhasil dihapus!');
    }
}
