<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class CmsProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('cms.pages.produk', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_wa' => 'required|string|max:255'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Produk::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'image' => $imageName,
            'no_wa' => $request->no_wa
        ]);

        return redirect()->route('cms.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $produk
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_wa' => 'required|string|max:255'
        ]);

        $produk = Produk::findOrFail($id);
        
        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path('images/'.$produk->image))) {
                unlink(public_path('images/'.$produk->image));
            }
            
            // Store new image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = $produk->image;
        }

        $produk->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'image' => $imageName,
            'no_wa' => $request->no_wa
        ]);

        return redirect()->route('cms.produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        
        // Delete image
        if (file_exists(public_path('images/'.$produk->image))) {
            unlink(public_path('images/'.$produk->image));
        }
        
        $produk->delete();

        return redirect()->route('cms.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}