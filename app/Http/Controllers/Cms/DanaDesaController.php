<?php

namespace App\Http\Controllers\Cms;

use App\Models\DanaDesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class DanaDesaController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));

        $danaDesa = DanaDesa::where('tahun_anggaran', $tahun)->get();

        // Hitung total dana
        $totalDana = $danaDesa->sum('nominal');
        $totalDanaMasuk = $danaDesa->sum('dana_masuk');
        $totalDanaTerpakai = $danaDesa->sum('dana_terpakai');
        $sisaDana = $totalDanaMasuk - $totalDanaTerpakai;

        // Hitung persentase
        $persentaseMasuk = $totalDana > 0 ? ($totalDanaMasuk / $totalDana) * 100 : 0;
        $persentaseTerpakai = $totalDanaMasuk > 0 ? ($totalDanaTerpakai / $totalDanaMasuk) * 100 : 0;
        $persentaseSisa = $totalDanaMasuk > 0 ? ($sisaDana / $totalDanaMasuk) * 100 : 0;

        return view('cms.pages.dana', compact(
            'danaDesa',
            'totalDana',
            'totalDanaMasuk',
            'totalDanaTerpakai',
            'sisaDana',
            'persentaseMasuk',
            'persentaseTerpakai',
            'persentaseSisa'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_anggaran' => 'required|integer',
            'sumber_anggaran' => 'required|string',
            'nominal' => 'required|numeric',
            'tgl_pencairan' => 'required|date',
            'status_pencairan' => 'required|numeric|min:0|max:100',
            'dana_masuk' => 'required|numeric',
            'dana_terpakai' => 'required|numeric',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('photos');

        // Handle photo uploads
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Generate unique filename
                $filename = Str::random(20) . '.' . $photo->getClientOriginalExtension();

                // Move file to public/images
                $photo->move(public_path('images'), $filename);

                $photoPaths[] = $filename;
            }
        }
        $data['photos'] = $photoPaths;

        $danaDesa = DanaDesa::create($data);

        return redirect()->route('dana.index')
            ->with('success', 'Data dana desa berhasil ditambahkan');
    }

    public function edit($id)
    {
        try {
            $danaDesa = DanaDesa::findOrFail($id);

            if (request()->ajax()) {
                return response()->json([
                    'dana' => $danaDesa,
                    'photos' => $danaDesa->photos ?? []
                ]);
            }

            return view('cms.pages.tambahdana', compact('danaDesa'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $danaDesa = DanaDesa::findOrFail($id);

            $validated = $request->validate([
                'tahun_anggaran' => 'required|integer',
                'sumber_anggaran' => 'required|string',
                'nominal' => 'required|numeric',
                'tgl_pencairan' => 'required',
                'status_pencairan' => 'required|integer|min:0|max:100',
                'dana_masuk' => 'required|numeric',
                'dana_terpakai' => 'required|numeric',
                'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Format tanggal dari format dd/mm/yyyy ke format database
            if (strpos($request->tgl_pencairan, '/') !== false) {
                $dateParts = explode('/', $request->tgl_pencairan);
                if (count($dateParts) === 3) {
                    $validated['tgl_pencairan'] = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
                }
            }

            // Handle photo uploads for update
            if ($request->hasFile('photos')) {
                // Delete old photos
                if (!empty($danaDesa->photos)) {
                    foreach ($danaDesa->photos as $filename) {
                        $path = public_path('images/' . $filename);
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                }

                // Upload new photos
                $photoPaths = [];
                foreach ($request->file('photos') as $photo) {
                    $filename = Str::random(20) . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('images'), $filename);
                    $photoPaths[] = $filename;
                }
                $validated['photos'] = $photoPaths;
            }

            $danaDesa->update($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diperbarui'
                ]);
            }

            return redirect()->route('dana.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $danaDesa = DanaDesa::findOrFail($id);

            // Delete photos from public/images
            if (!empty($danaDesa->photos)) {
                foreach ($danaDesa->photos as $filename) {
                    $path = public_path('images/' . $filename);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            $result = $danaDesa->delete();

            if (!$result) {
                throw new \Exception('Gagal menghapus data');
            }

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        return view('cms.pages.tambahdana');
    }

    public function tambahdana($id)
    {
        $danaDesa = DanaDesa::findOrFail($id);
        return view('cms.pages.tambahdana', compact('danaDesa'));
    }
}
