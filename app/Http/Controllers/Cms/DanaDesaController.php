<?php

namespace App\Http\Controllers\Cms;

use App\Models\DanaDesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DanaDesaController extends Controller
{
    public function __construct()
    {
        // Create dana_desas table if it doesn't exist
        if (!Schema::hasTable('dana_desas')) {
            Schema::create('dana_desas', function (Blueprint $table) {
                $table->id();
                $table->string('nama_program');
                $table->string('kategori');
                $table->decimal('anggaran', 15, 2);
                $table->integer('progress');
                $table->string('status');
                $table->string('target');
                $table->timestamps();
            });
        }
    }

    public function index()
    {
        $danaPrograms = DanaDesa::all();
        $totalPrograms = $danaPrograms->count();
        
        return view('cms.pages.dana', compact('danaPrograms', 'totalPrograms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori' => 'required|string',
            'anggaran' => 'required|numeric',
            'progress' => 'required|integer|min:0|max:100',
            'status' => 'required|string',
            'target' => 'required|string',
        ]);

        $program = new DanaDesa();
        $program->nama_program = $validated['nama_program'];
        $program->kategori = $validated['kategori'];
        $program->anggaran = $validated['anggaran'];
        $program->progress = $validated['progress'];
        $program->status = $validated['status'];
        $program->target = $validated['target'];
        $program->save();

        return redirect()->route('dana.index')->with('success', 'Program berhasil ditambahkan');
    }

    public function edit($id)
    {
        $program = DanaDesa::findOrFail($id);
        return view('cms.pages.tambahdana', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = DanaDesa::findOrFail($id);

        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'kategori' => 'required|string',
            'anggaran' => 'required|numeric',
            'progress' => 'required|integer|min:0|max:100',
            'status' => 'required|string',
            'target' => 'required|string',
        ]);

        $program->update($validated);

        return redirect()->route('dana.index')->with('success', 'Program berhasil diperbarui');
    }

    public function destroy($id)
    {
        try {
            $dana = DanaDesa::findOrFail($id);
            
            // Tambahkan log untuk debugging
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
        $program = DanaDesa::findOrFail($id);
        return view('cms.pages.tambahdana', compact('program'));
    }
}