<?php

namespace App\Http\Controllers\Cms;

use App\Models\Struktur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function index()
    {
        $strukturs = Struktur::all();
        return view('cms.pages.strukturdesa', compact('strukturs')); // Changed view path
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required', 
            'periode' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Struktur::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'periode' => $request->periode,
            'image' => $imageName
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $struktur = Struktur::findOrFail($id);
        return response()->json($struktur);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'periode' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $struktur = Struktur::findOrFail($id);
        
        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path('images/'.$struktur->image))) {
                unlink(public_path('images/'.$struktur->image));
            }
            
            // Upload new image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $struktur->image = $imageName;
        }

        $struktur->nama = $request->nama;
        $struktur->jabatan = $request->jabatan;
        $struktur->periode = $request->periode;
        $struktur->save();

        return redirect()->back()->with('success', 'Anggota berhasil diupdate');
    }

    public function destroy($id)
    {
        $struktur = Struktur::findOrFail($id);
        
        // Delete image
        if (file_exists(public_path('images/'.$struktur->image))) {
            unlink(public_path('images/'.$struktur->image));
        }
        
        $struktur->delete();
        return redirect()->back()->with('success', 'Anggota berhasil dihapus');
    }
}