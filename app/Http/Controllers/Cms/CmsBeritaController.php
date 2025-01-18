<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;   

class CmsBeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->get();
        return view('cms.pages.berita', compact('berita'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'image' => $imageName,
            'tanggal' => $request->tanggal
        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return response()->json($berita);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date'
        ]);

        $berita = Berita::findOrFail($id);
        
        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'tanggal' => $request->tanggal
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path('images/'.$berita->image))) {
                unlink(public_path('images/'.$berita->image));
            }

            // Upload new image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $berita->update($data);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Delete image
        if (file_exists(public_path('images/'.$berita->image))) {
            unlink(public_path('images/'.$berita->image));
        }

        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus');
    }
}