<?php

namespace App\Http\Controllers\Cms;

use App\Models\DanaDesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $validated = $request->validate([
            'tahun_anggaran' => 'required|integer',
            'sumber_anggaran' => 'required|string',
            'nominal' => 'required|numeric',
            'tgl_pencairan' => 'required|date',
            'status_pencairan' => 'required|integer|min:0|max:100',
            'dana_masuk' => 'required|numeric',
            'dana_terpakai' => 'required|numeric'
        ]);

        DanaDesa::create($validated);

        return redirect()->route('dana.index')->with('success', 'Data dana desa berhasil ditambahkan');
    }

    public function edit($id)
    {
        try {
            \Log::info('Edit method called for ID: ' . $id);
            $danaDesa = DanaDesa::findOrFail($id);
            
            if (request()->ajax()) {
                return view('cms.pages.tambahdana', compact('danaDesa'))->render();
            }
            
            return view('cms.pages.tambahdana', compact('danaDesa'));
        } catch (\Exception $e) {
            \Log::error('Error in edit method: ' . $e->getMessage());
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
                'tgl_pencairan' => 'required|date',
                'status_pencairan' => 'required|integer|min:0|max:100',
                'dana_masuk' => 'required|numeric',
                'dana_terpakai' => 'required|numeric'
            ]);

            $danaDesa->update($validated);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diperbarui'
                ]);
            }
            
            return redirect()->route('dana.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            \Log::error('Error in update method: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $dana = DanaDesa::findOrFail($id);
            
            \Log::info('Menghapus dana desa dengan ID: ' . $id);
            
            $result = $dana->delete();
            
            if (!$result) {
                throw new \Exception('Gagal menghapus data');
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saat menghapus dana desa: ' . $e->getMessage());
            
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