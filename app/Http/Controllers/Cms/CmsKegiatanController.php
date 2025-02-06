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
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'anggaran' => 'required|numeric',
            'sumber_dana' => 'required|exists:danadesa,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'progress' => 'required|integer|min:0|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }

        // Update dana_terpakai in danadesa
        $danaDesa = \App\Models\DanaDesa::findOrFail($request->sumber_dana);
        $danaDesa->increment('dana_terpakai', $request->anggaran);

        Kegiatan::create($validated);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return response()->json($kegiatan);
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $oldAnggaran = $kegiatan->anggaran;
        $oldSumberDana = $kegiatan->sumber_dana;

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required',
            'anggaran' => 'required|numeric',
            'sumber_dana' => 'required|exists:danadesa,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'progress' => 'required|integer|min:0|max:100'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'anggaran' => $request->anggaran,
            'sumber_dana' => $request->sumber_dana,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'progress' => $request->progress
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

        // Update dana_terpakai in danadesa
        if ($oldSumberDana == $request->sumber_dana) {
            // If same source, just update the difference
            $danaDesa = \App\Models\DanaDesa::findOrFail($request->sumber_dana);
            $danaDesa->increment('dana_terpakai', $request->anggaran - $oldAnggaran);
        } else {
            // If different source, decrease old source and increase new source
            $oldDanaDesa = \App\Models\DanaDesa::findOrFail($oldSumberDana);
            $oldDanaDesa->decrement('dana_terpakai', $oldAnggaran);

            $newDanaDesa = \App\Models\DanaDesa::findOrFail($request->sumber_dana);
            $newDanaDesa->increment('dana_terpakai', $request->anggaran);
        }

        $kegiatan->update($data);

        return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        // Update dana_terpakai in danadesa
        $danaDesa = \App\Models\DanaDesa::findOrFail($kegiatan->sumber_dana);
        $danaDesa->decrement('dana_terpakai', $kegiatan->anggaran);
        
        // Delete image
        if (file_exists(public_path('images/'.$kegiatan->image))) {
            unlink(public_path('images/'.$kegiatan->image));
        }

        $kegiatan->delete();

        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus');
    }
}