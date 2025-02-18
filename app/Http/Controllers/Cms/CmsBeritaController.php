<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CmsBeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'desc')->paginate(10);
        return view('cms.pages.berita', compact('berita'));
    }

    public function store(Request $request)
    {
        if (Auth::guard('struktur')->check()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menambah berita');
        }

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori' => 'required'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/berita', $nama_gambar);
            $validated['gambar'] = 'berita/' . $nama_gambar;
        }

        $validated['slug'] = Str::slug($validated['judul']);
        $validated['user_id'] = Auth::id();

        Berita::create($validated);

        return redirect()->route('cms.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return response()->json($berita);
    }

    public function update(Request $request, $id)
    {
        if (Auth::guard('struktur')->check()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah berita');
        }

        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori' => 'required'
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::delete('public/' . $berita->gambar);
            }
            
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/berita', $nama_gambar);
            $validated['gambar'] = 'berita/' . $nama_gambar;
        }

        $validated['slug'] = Str::slug($validated['judul']);
        $berita->update($validated);

        return redirect()->route('cms.berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Auth::guard('struktur')->check()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus berita');
        }

        $berita = Berita::findOrFail($id);
        
        // Hapus gambar jika ada
        if ($berita->gambar) {
            Storage::delete('public/' . $berita->gambar);
        }
        
        $berita->delete();

        return redirect()->route('cms.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}