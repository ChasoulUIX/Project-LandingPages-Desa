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
        try {


            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'konten' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tanggal' => 'required|date',
            ]);



            if (!$request->hasFile('image')) {

                throw new \Exception('File gambar tidak ditemukan');
            }

            $imageName = time().'.'.$request->image->extension();


            try {
                $request->image->move(public_path('images'), $imageName);
            } catch (\Exception $e) {
                throw new \Exception('Gagal mengupload gambar: ' . $e->getMessage());
            }

            // Simpan konten dengan format HTML
            $berita = Berita::create([
                'judul' => $validated['judul'],
                'konten' => $validated['konten'], // Simpan HTML tanpa strip_tags
                'image' => $imageName,
                'tanggal' => $validated['tanggal'],
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil disimpan',
                'data' => $berita
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            return response()->json([
                'success' => true,
                'judul' => $berita->judul,
                'konten' => $berita->konten,
                'tanggal' => $berita->tanggal,
                'image' => $berita->image
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            

            $berita = Berita::findOrFail($id);

            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'konten' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tanggal' => 'required|date',
            ]);

            $updateData = [
                'judul' => $validated['judul'],
                'konten' => $validated['konten'],
                'tanggal' => $validated['tanggal'],
            ];

            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($berita->image) {
                    $oldImagePath = public_path('images/' . $berita->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Upload gambar baru
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $updateData['image'] = $imageName;
            }

            $berita->update($updateData);


            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil diperbarui',
                'data' => $berita
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->image) {
            $imagePath = public_path('images/' . $berita->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $berita->delete();

        return redirect()->route('cms.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}