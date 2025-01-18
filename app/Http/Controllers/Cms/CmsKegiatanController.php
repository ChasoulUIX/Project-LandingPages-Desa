<?php

namespace App\Http\Controllers\Cms;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class CmsKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('cms.pages.kegiatan', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Kegiatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'image' => $imageName,
            'kategori' => $request->kategori
        ]);

        return redirect()->back()->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return response()->json($kegiatan);
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path('images/'.$kegiatan->image))) {
                unlink(public_path('images/'.$kegiatan->image));
            }

            // Upload new image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $data['kategori'] = $request->kategori;

        $kegiatan->update($data);

        return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        // Delete image
        if (file_exists(public_path('images/'.$kegiatan->image))) {
            unlink(public_path('images/'.$kegiatan->image));
        }

        $kegiatan->delete();

        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus');
    }
}