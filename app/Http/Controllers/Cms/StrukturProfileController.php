<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class StrukturProfileController extends Controller
{
    public function edit()
    {
        return view('cms.pages.editprofile');
    }

    public function update(Request $request)
    {
        $struktur = Auth::guard('struktur')->user();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16'],
            'jabatan' => ['required', 'string', 'max:255'],
            'no_wa' => ['required', 'string', 'max:15'],
            'akses' => ['required', 'string'],
            'periode_mulai' => ['required', 'date'],
            'periode_akhir' => ['required', 'date', 'after:periode_mulai'],
            'status' => ['required', 'boolean'],
            'password' => ['nullable', 'string', 'min:3', 'confirmed'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        try {
            // Update basic information
            $struktur->nama = $validated['nama'];
            $struktur->nik = $validated['nik'];
            $struktur->jabatan = $validated['jabatan'];
            $struktur->no_wa = $validated['no_wa'];
            $struktur->akses = $validated['akses'];
            $struktur->periode_mulai = $validated['periode_mulai'];
            $struktur->periode_akhir = $validated['periode_akhir'];
            $struktur->status = $validated['status'];

            // Update password if provided
            if ($request->filled('password')) {
                $struktur->password = Hash::make($validated['password']);
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old photo if exists
                if ($struktur->image) {
                    $oldPath = public_path('images/' . $struktur->image);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Store new photo in public/images directory
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Ensure the images directory exists
                $path = public_path('images');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                // Move the uploaded file to public/images
                $file->move($path, $filename);
                
                $struktur->image = $filename;
            }

            $struktur->save();

            return back()->with('success', 'Profile updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating profile: ' . $e->getMessage());
        }
    }
} 