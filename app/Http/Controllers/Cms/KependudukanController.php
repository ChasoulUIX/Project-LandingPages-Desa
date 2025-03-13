<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kependudukan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KependudukanController extends Controller
{
    public function index()
    {
        return view('cms.pages.kependudukan');
    }

    public function create()
    {
        return view('cms.app.kependudukan.create');
    }

    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'nik' => 'required|unique:kependudukan',
                'nama_lengkap' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'no_kk' => 'required',
                'nomor_hp' => 'required',
                'golongan_darah' => 'required',
                'agama' => 'required',
                'status_perkawinan' => 'required',
                'pekerjaan' => 'required',
                'pendidikan_terakhir' => 'required',
                'status_keluarga' => 'required'
            ]);

            $result = Kependudukan::create($validated);

            if ($result) {
                return redirect('/cms/app/kependudukan')
                    ->with('success', 'Data penduduk berhasil ditambahkan');
            }

            return redirect()->back()
                ->with('error', 'Gagal menambahkan data penduduk')
                ->withInput();

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($nik)
    {
        try {
            $penduduk = Kependudukan::where('nik', $nik)->first();
            
            if (!$penduduk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data penduduk tidak ditemukan'
                ], 404);
            }

            // Format tanggal lahir jika perlu
            if ($penduduk->tanggal_lahir) {
                $penduduk->tanggal_lahir = date('Y-m-d', strtotime($penduduk->tanggal_lahir));
            }

            return response()->json([
                'success' => true,
                'penduduk' => $penduduk
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $nik)
    {
       

        try {
            $penduduk = Kependudukan::where('nik', $nik)->first();
            
            if (!$penduduk) {
                return redirect('/cms/app/kependudukan')
                    ->with('error', 'Data penduduk tidak ditemukan');
            }

            $validated = $request->validate([
                'nik' => 'required|unique:kependudukan,nik,' . $nik . ',nik',
                'nama_lengkap' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required',
                'no_kk' => 'required',
                'nomor_hp' => 'required',
                'golongan_darah' => 'required',
                'agama' => 'required',
                'status_perkawinan' => 'required',
                'pekerjaan' => 'required',
                'pendidikan_terakhir' => 'required',
                'status_keluarga' => 'required'
            ]);

            $penduduk->update($validated);

            return redirect('/cms/app/kependudukan')
                ->with('success', 'Data penduduk berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($nik)
    {
        try {
            $penduduk = Kependudukan::where('nik', $nik)->first();
            
            if (!$penduduk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data penduduk tidak ditemukan'
                ], 404);
            }

            $penduduk->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data penduduk berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}