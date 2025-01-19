<?php

namespace App\Http\Controllers\User;

use App\Models\SuratKelahiran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKelahiranController extends Controller
{
    public function index()
    {
        $suratKelahiran = SuratKelahiran::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('user.pages.layanan.suratketerangan.kelahiran', compact('suratKelahiran'));
    }

    public function create()
    {
        return view('user.pages.layanan.suratketerangan.kelahiran');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_anak' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'required|string|size:16',
            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'required|string|size:16',
        ]);

        $validated['user_id'] = Auth::id();
        
        SuratKelahiran::create($validated);

        return redirect()
            ->route('surat-kelahiran.index')
            ->with('success', 'Permohonan surat keterangan kelahiran berhasil diajukan');
    }

    public function show(SuratKelahiran $suratKelahiran)
    {
        $this->authorize('view', $suratKelahiran);
        
        return view('user.pages.layanan.suratketerangan.kelahiran-show', compact('suratKelahiran'));
    }
} 