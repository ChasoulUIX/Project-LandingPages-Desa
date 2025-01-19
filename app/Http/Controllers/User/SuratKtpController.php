<?php

namespace App\Http\Controllers\User;

use App\Models\SuratKtp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKtpController extends Controller
{
    public function index()
    {
        $suratKtps = SuratKtp::where('user_id', Auth::id())->get();
        return view('user.pages.layanan.suratketerangan.ktp', compact('suratKtps'));
    }

    public function create()
    {
        return view('user.pages.layanan.suratketerangan.ktp');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'keperluan' => 'required|in:baru,perpanjangan,penggantian',
        ]);

        $suratKtp = SuratKtp::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('surat-ktp.index')
            ->with('success', 'Permohonan surat pengantar KTP berhasil diajukan');
    }

    public function show(SuratKtp $suratKtp)
    {
        return view('user.pages.layanan.suratketerangan.ktp-show', compact('suratKtp'));
    }
}