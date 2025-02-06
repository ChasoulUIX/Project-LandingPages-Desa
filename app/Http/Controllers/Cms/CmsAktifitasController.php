<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Aktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsAktifitasController extends Controller
{
    public function index()
    {
        $aktifitas = Aktifitas::latest()->get();
        return view('cms.pages.aktifitasdesa', compact('aktifitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tgl_mulai' => 'required|date'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Aktifitas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'image' => $imageName,
            'tgl_mulai' => $request->tgl_mulai
        ]);

        return redirect()->back()->with('success', 'Aktifitas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $aktifitas = Aktifitas::findOrFail($id);
        return response()->json($aktifitas);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tgl_mulai' => 'required|date'
        ]);

        $aktifitas = Aktifitas::findOrFail($id);
        
        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tgl_mulai' => $request->tgl_mulai
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path('images/'.$aktifitas->image))) {
                unlink(public_path('images/'.$aktifitas->image));
            }

            // Upload new image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $aktifitas->update($data);

        return redirect()->back()->with('success', 'Aktifitas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $aktifitas = Aktifitas::findOrFail($id);
        
        // Delete image
        if (file_exists(public_path('images/'.$aktifitas->image))) {
            unlink(public_path('images/'.$aktifitas->image));
        }

        $aktifitas->delete();

        return redirect()->back()->with('success', 'Aktifitas berhasil dihapus');
    }
}
