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
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_texts' => 'nullable|array',
            'gallery_texts.*' => 'nullable|string',
        ]);

        $profileDesa = ProfileDesa::first() ?? new ProfileDesa();
        
        // Handle logo upload
        if ($request->hasFile('logo_image')) {
            $logoImage = $request->file('logo_image');
            $logoName = time() . '_logo.' . $logoImage->getClientOriginalExtension();
            $logoImage->move(public_path('images'), $logoName);
            $profileDesa->logo_image = $logoName;
        }

        // Handle gallery images and texts
        $galleryImages = [];
        $galleryTexts = [];
        
        // Keep existing images and texts that weren't removed
        if ($profileDesa->gallery_images) {
            $removedIndexes = json_decode($request->removed_indexes ?? '[]', true);
            foreach ($profileDesa->gallery_images as $index => $image) {
                if (!in_array($index, $removedIndexes)) {
                    $galleryImages[] = $image;
                    // Get text from existing_gallery_texts array
                    $galleryTexts[] = $request->existing_gallery_texts[$index] ?? '';
                }
            }
        }

        // Add new images and texts
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $imageName = time() . '_gallery_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $galleryImages[] = $imageName;
                // Get text from new gallery_texts array
                $galleryTexts[] = $request->new_gallery_texts[$index] ?? '';
            }
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
            'gallery_images' => array_values($galleryImages), // Reindex array
            'gallery_texts' => array_values($galleryTexts) // Reindex array
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

    // Method untuk user biasa yang bisa edit
    public function updateSambutan(Request $request)
    {
        if (Auth::guard('struktur')->check()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah data');
        }

        $validated = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // ... logika update sambutan ...
    }

    public function updateProfile(Request $request)
    {
        if (Auth::guard('struktur')->check()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah data');
        }

        $validated = $request->validate([
            'nama_desa' => 'required',
            'deskripsi' => 'required',
            // ... validasi field lainnya
        ]);

        // ... logika update profile desa ...
    }
}

