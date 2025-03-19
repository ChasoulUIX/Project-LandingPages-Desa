<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\ProfileDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sambutan;
use Illuminate\Support\Facades\Auth;

class ProfileDesaController extends Controller
{
    public function index()
    {
        $profileDesa = ProfileDesa::first();
        return view('cms.pages.profiledesa', compact('profileDesa'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string',
            'synopsis' => 'nullable|string',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'tahun_berdiri' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'visi' => 'nullable|array',
            'visi.*' => 'string',
            'misi' => 'nullable|array',
            'misi.*' => 'string',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
        ]);

        // Handle logo image upload if present
        if ($request->hasFile('logo_image')) {
            $image = $request->file('logo_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['logo_image'] = $imageName;
        }

        // Filter out empty values from visi and misi arrays
        if (isset($data['visi'])) {
            $data['visi'] = array_filter($data['visi'], fn($item) => !empty($item));
        }
        if (isset($data['misi'])) {
            $data['misi'] = array_filter($data['misi'], fn($item) => !empty($item));
        }

        // Update or create profile
        ProfileDesa::updateOrCreate(
            ['id' => 1],
            $data
        );

        return redirect()->back()->with('success', 'Profil desa berhasil diperbarui');
    }

    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'tahun_berdiri' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'visi' => 'nullable|array',
            'misi' => 'nullable|array',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desa' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
        ]);

        $profileDesa = ProfileDesa::first() ?? new ProfileDesa();

        // Handle logo upload
        if ($request->hasFile('logo_image')) {
            $logoImage = $request->file('logo_image');
            $logoName = time() . '_logo.' . $logoImage->getClientOriginalExtension();
            $logoImage->move(public_path('images'), $logoName);
            $profileDesa->logo_image = $logoName;
        }

        // Update all fields
        $profileDesa->fill([
            'judul' => $request->judul,
            'synopsis' => $request->synopsis,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'tahun_berdiri' => $request->tahun_berdiri,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'lokasi' => $request->lokasi,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
        ]);

        $profileDesa->save();

        return redirect()->back()->with('success', 'Profil desa berhasil diperbarui');
    }

    public function sambutan()
    {
        // Ambil data sambutan jika ada
        $sambutan = Sambutan::first();

        return view('cms.pages.sambutan', compact('sambutan'));
    }

    public function updateSambutan(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // ... logika update sambutan ...
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'required',
            'deskripsi' => 'required',
            // ... validasi field lainnya
        ]);

        // ... logika update profile desa ...
    }
}

