<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\ProfileDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get or create profile desa
        $profileDesa = ProfileDesa::first() ?? new ProfileDesa();

        // Handle logo image upload
        if ($request->hasFile('logo_image')) {
            // Delete old image if exists
            if ($profileDesa->logo_image && file_exists(public_path('images/' . $profileDesa->logo_image))) {
                unlink(public_path('images/' . $profileDesa->logo_image));
            }
            
            $image = $request->file('logo_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $profileDesa->logo_image = $imageName;
        }

        // Update other fields
        $profileDesa->judul = $request->judul;
        $profileDesa->synopsis = $request->synopsis;
        $profileDesa->email = $request->email;
        $profileDesa->telephone = $request->telephone;
        $profileDesa->tahun_berdiri = $request->tahun_berdiri;
        $profileDesa->deskripsi = $request->deskripsi;
        $profileDesa->alamat = $request->alamat;
        $profileDesa->lokasi = $request->lokasi;
        $profileDesa->visi = $request->visi;
        $profileDesa->misi = $request->misi;

        $profileDesa->save();

        return redirect()->back()->with('success', 'Profil desa berhasil diperbarui');
    }
}
