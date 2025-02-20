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

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            
            // Get existing gallery images or empty array
            $existingImages = $profileDesa->gallery_images ? json_decode($profileDesa->gallery_images, true) : [];
            
            // Handle removed images
            if ($request->has('removed_images')) {
                $removedImages = json_decode($request->removed_images, true);
                if (is_array($removedImages)) {
                    foreach ($removedImages as $removedImage) {
                        // Remove from existing images array
                        $existingImages = array_diff($existingImages, [$removedImage]);
                        
                        // Delete file from storage
                        $imagePath = public_path('images/' . $removedImage);
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }
            }
            
            // Add new images
            foreach ($request->file('gallery_images') as $image) {
                $imageName = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $galleryImages[] = $imageName;
            }
            
            // Merge existing and new images
            $profileDesa->gallery_images = json_encode(array_values(array_merge($existingImages, $galleryImages)));
        } elseif ($request->has('removed_images')) {
            // Handle case where images were only removed but no new ones added
            $existingImages = $profileDesa->gallery_images ? json_decode($profileDesa->gallery_images, true) : [];
            $removedImages = json_decode($request->removed_images, true);
            
            if (is_array($removedImages)) {
                foreach ($removedImages as $removedImage) {
                    // Remove from existing images array
                    $existingImages = array_diff($existingImages, [$removedImage]);
                    
                    // Delete file from storage
                    $imagePath = public_path('images/' . $removedImage);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                
                $profileDesa->gallery_images = json_encode(array_values($existingImages));
            }
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
