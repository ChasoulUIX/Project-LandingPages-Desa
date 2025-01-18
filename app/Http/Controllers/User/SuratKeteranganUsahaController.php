<?php

namespace App\Http\Controllers\User;

use App\Models\SuratKeteranganUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SuratKeteranganUsahaController extends Controller
{
    public function index()
    {
        $suratUsaha = SuratKeteranganUsaha::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.pages.layanan.suratketerangan.usaha', compact('suratUsaha'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'alamat_usaha' => 'required|string',
            'tahun_mulai' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $validated['user_id'] = Auth::id();
        
        SuratKeteranganUsaha::create($validated);

        return redirect()->route('surat-usaha.index')
            ->with('success', 'Permohonan surat keterangan usaha berhasil diajukan');
    }
}