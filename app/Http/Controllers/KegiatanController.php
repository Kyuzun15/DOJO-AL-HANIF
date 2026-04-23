<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    // Admin: Menampilkan daftar kegiatan
    public function adminIndex()
    {
        $kegiatans = Kegiatan::orderBy('event_date', 'asc')->get();
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    // Admin: Form tambah kegiatan
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    // Admin: Proses tambah kegiatan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'flyer_image' => 'nullable|image|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('flyer_image')) {
            $path = $request->file('flyer_image')->store('kegiatan', 'public');
            $validated['flyer_image'] = $path;
        }

        Kegiatan::create($validated);

        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // Admin: Form edit kegiatan
    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    // Admin: Proses edit kegiatan
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'flyer_image' => 'nullable|image|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('flyer_image')) {
            // Hapus gambar lama
            if ($kegiatan->flyer_image) {
                Storage::disk('public')->delete($kegiatan->flyer_image);
            }
            $path = $request->file('flyer_image')->store('kegiatan', 'public');
            $validated['flyer_image'] = $path;
        }

        $kegiatan->update($validated);

        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    // Admin: Hapus kegiatan
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        if ($kegiatan->flyer_image) {
            Storage::disk('public')->delete($kegiatan->flyer_image);
        }
        
        $kegiatan->delete();

        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil dihapus!');
    }

    // Publik: Detail kegiatan
    public function show($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();
        return view('kegiatan.show', compact('kegiatan'));
    }
}
