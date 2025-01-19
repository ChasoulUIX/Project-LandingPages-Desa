<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Kependudukan;
use Illuminate\Http\Request;

class KependudukanController extends Controller
{
    public function index()
    {
        $kependudukans = Kependudukan::all();
        return view('cms.pages.kependudukan', compact('kependudukans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:kependudukans,nik',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'usia' => 'required|numeric',
            'status_keluarga' => 'required',
            'mata_pencaharian' => 'required',
            'pendidikan' => 'required',
            'alamat' => 'required',
        ]);

        Kependudukan::create($request->all());

        return redirect()->route('cms.kependudukan.index')
            ->with('success', 'Data kependudukan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        try {
            $kependudukan = Kependudukan::findOrFail($id);
            return response()->json($kependudukan);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }

    public function update(Request $request, Kependudukan $kependudukan)
    {
        $request->validate([
            'nik' => 'required|unique:kependudukans,nik,' . $kependudukan->id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'usia' => 'required|numeric',
            'status_keluarga' => 'required',
            'mata_pencaharian' => 'required',
            'pendidikan' => 'required',
            'alamat' => 'required',
        ]);

        $kependudukan->update($request->all());

        return redirect()->route('cms.kependudukan.index')
            ->with('success', 'Data kependudukan berhasil diperbarui.');
    }

    public function destroy(Kependudukan $kependudukan)
    {
        $kependudukan->delete();

        return redirect()->route('cms.kependudukan.index')
            ->with('success', 'Data kependudukan berhasil dihapus.');
    }
}