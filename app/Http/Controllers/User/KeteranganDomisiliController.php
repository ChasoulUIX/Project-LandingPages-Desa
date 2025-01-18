<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KeteranganDomisili;
use Illuminate\Http\Request;

class KeteranganDomisiliController extends Controller
{
    public function create()
    {
        return view('user.pages.layanan.suratketerangan.domisili');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16', // NIK harus 16 digit
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file uploads
        $ktpPath = $request->file('ktp')->store('public/domicili/ktp');
        $kkPath = $request->file('kk')->store('public/domicili/kk');

        // Create request
        KeteranganDomisili::create([
            'user_id' => auth()->id(),
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'ktp_file' => $ktpPath,
            'kk_file' => $kkPath,
            'status' => 'pending'
        ]);

        return redirect()->route('user.domisili.layanan.suratketerangan.domisili')
            ->with('success', 'Permohonan surat keterangan domisili berhasil diajukan!');
    }
}