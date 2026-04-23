<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // Publik: Daftar Artikel
    public function index()
    {
        $artikels = Artikel::orderBy('published_date', 'desc')->get();
        return view('artikel.artikel', compact('artikels'));
    }

    // Publik: Detail Artikel
    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        return view('artikel.show-artikel', compact('artikel'));
    }

    // Admin: List
    public function adminIndex()
    {
        $artikels = Artikel::orderBy('published_date', 'desc')->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    // Admin: Create Form
    public function create()
    {
        return view('admin.artikel.create');
    }

    // Admin: Store Data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'published_date' => 'required|date',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('artikel', 'public');
            $validated['cover_image'] = $path;
        }

        Artikel::create($validated);

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Admin: Edit Form
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    // Admin: Update Data
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'published_date' => 'required|date',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($artikel->cover_image) {
                Storage::disk('public')->delete($artikel->cover_image);
            }
            $path = $request->file('cover_image')->store('artikel', 'public');
            $validated['cover_image'] = $path;
        }

        $artikel->update($validated);

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Admin: Delete Data
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        
        if ($artikel->cover_image) {
            Storage::disk('public')->delete($artikel->cover_image);
        }
        
        $artikel->delete();

        return redirect('/admin/artikel')->with('success', 'Artikel berhasil dihapus!');
    }
}
