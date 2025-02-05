<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Kependudukan;
use Illuminate\Http\Request;

class KependudukanController extends Controller
{
    public function index()
    {
        $kependudukan = Kependudukan::query();

        // Apply search if provided
        if (request()->has('search')) {
            $search = request()->get('search');
            $kependudukan->where(function($query) use ($search) {
                $query->where('nik', 'like', "%{$search}%")
                      ->orWhere('nama_lengkap', 'like', "%{$search}%");
            });
        }

        // Apply sorting if provided
        if (request()->has('sort')) {
            $sortBy = request()->get('sort');
            $sortOrder = request()->get('order', 'asc');
            $kependudukan->orderBy($sortBy, $sortOrder);
        }

        // Paginate the results
        $kependudukan = $kependudukan->paginate(15);

        return view('cms.pages.kependudukan', compact('kependudukan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:kependudukan,nik',
            'no_kk' => 'required|string|size:16',
            'nama_lengkap' => 'required|string|max:100',
            'nomor_hp' => 'required|string|max:15',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'golongan_darah' => 'required|in:A,B,AB,O,-',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:50',
            'pendidikan_terakhir' => 'required|string|max:50',
            'status_keluarga' => 'required|in:Kepala Keluarga,Suami,Istri,Anak,Orang Tua,Lainnya'
        ]);

        Kependudukan::create($request->all());

        return redirect()->route('cms.kependudukan.index')
            ->with('success', 'Data kependudukan berhasil ditambahkan.');
    }

    public function edit($nik)
    {
        try {
            $kependudukan = Kependudukan::where('nik', $nik)->firstOrFail();
            return response()->json($kependudukan);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $nik)
    {
        $kependudukan = Kependudukan::findOrFail($nik);
        
        $request->validate([
            'nik' => 'required|string|size:16|unique:kependudukan,nik,' . $nik . ',nik',
            'no_kk' => 'required|string|size:16',
            'nama_lengkap' => 'required|string|max:100',
            'nomor_hp' => 'required|string|max:15',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'golongan_darah' => 'required|in:A,B,AB,O,-',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:50',
            'pendidikan_terakhir' => 'required|string|max:50',
            'status_keluarga' => 'required|in:Kepala Keluarga,Suami,Istri,Anak,Orang Tua,Lainnya'
        ]);

        $kependudukan->update($request->all());

        return redirect()->route('cms.kependudukan.index')
            ->with('success', 'Data kependudukan berhasil diperbarui.');
    }

    public function destroy($nik)
    {
        $kependudukan = Kependudukan::findOrFail($nik);
        $kependudukan->delete();

        return redirect()->route('cms.kependudukan.index')
            ->with('success', 'Data kependudukan berhasil dihapus.');
    }
}