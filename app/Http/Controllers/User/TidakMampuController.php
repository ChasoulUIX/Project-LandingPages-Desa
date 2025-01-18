<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SuratTidakMampu;
use Illuminate\Http\Request;

class TidakMampuController extends Controller
{
    public function index()
    {
        return view('user.pages.layanan.suratketerangan.tidakmampu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'required|string|max:255',
            'penghasilan' => 'required|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:0',
            'status_rumah' => 'required|in:milik_sendiri,sewa,menumpang',
            'keperluan' => 'required|string'
        ]);

        $suratTidakMampu = SuratTidakMampu::create($request->all());

        return redirect()
            ->route('surat-tidak-mampu.index')
            ->with('success', 'Permohonan surat keterangan tidak mampu berhasil diajukan!');
    }
}