<?php

namespace App\Http\Controllers\Cms;

use App\Models\Struktur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class StrukturController extends Controller
{
    public function index()
    {
        $strukturs = Struktur::all();
        return view('cms.pages.strukturdesa', compact('strukturs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:strukturs',
            'password' => 'required',
            'nama' => 'required',
            'jabatan' => 'required',
            'no_wa' => 'required',
            'akses' => 'required|in:full,view',
            'periode_mulai' => 'required|date',
            'periode_akhir' => 'required|date|after:periode_mulai',
            'status' => 'required|in:aktif,non-aktif',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Struktur::create([
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'no_wa' => $request->no_wa,
            'akses' => $request->akses,
            'periode_mulai' => $request->periode_mulai,
            'periode_akhir' => $request->periode_akhir,
            'status' => $request->status,
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
        $struktur = Struktur::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:strukturs,nik,'.$id,
            'nama' => 'required',
            'jabatan' => 'required',
            'no_wa' => 'required',
            'akses' => 'required|in:full,view',
            'periode_mulai' => 'required|date',
            'periode_akhir' => 'required|date|after:periode_mulai',
            'status' => 'required|in:aktif,non-aktif',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('image')) {
            if (file_exists(public_path('images/'.$struktur->image))) {
                unlink(public_path('images/'.$struktur->image));
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $struktur->image = $imageName;
        }

        $struktur->nik = $request->nik;
        if ($request->filled('password')) {
            $struktur->password = Hash::make($request->password);
        }
        $struktur->nama = $request->nama;
        $struktur->jabatan = $request->jabatan;
        $struktur->no_wa = $request->no_wa;
        $struktur->akses = $request->akses;
        $struktur->periode_mulai = $request->periode_mulai;
        $struktur->periode_akhir = $request->periode_akhir;
        $struktur->status = $request->status;
        $struktur->save();

        return redirect()->back()->with('success', 'Anggota berhasil diupdate');
    }

    public function destroy($id)
    {
        $struktur = Struktur::findOrFail($id);
        
        if (file_exists(public_path('images/'.$struktur->image))) {
            unlink(public_path('images/'.$struktur->image));
        }
        
        $struktur->delete();
        return redirect()->back()->with('success', 'Anggota berhasil dihapus');
    }
}