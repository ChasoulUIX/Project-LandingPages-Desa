<?php

namespace App\Http\Controllers\Cms;

use App\Models\Struktur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StrukturProfileController extends Controller
{
    /**
     * Menampilkan form edit profile struktur
     */
    public function edit()
    {
        return view('cms.pages.editprofile');
    }

    /**
     * Update profile struktur yang sedang login
     */
    public function update(Request $request)
    {
        // Ambil data user yang sedang login
        $authStruktur = Auth::guard('struktur')->user();
        if (!$authStruktur) {
            return back()->with('error', 'User not found or not logged in.');
        }

        // Debugging untuk melihat data yang dikirim
        Log::info('Updating profile for struktur ID: ' . $authStruktur->id);
        Log::info('Request Data:', $request->all());

        // Validasi input
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => [
                'required',
                'string',
                'max:16',
                Rule::unique('strukturs', 'nik')->ignore($authStruktur->id)
            ],
            'jabatan' => ['required', 'string', 'max:255'],
            'no_wa' => ['required', 'string', 'max:15'],
            'akses' => ['required', 'string'],
            'periode_mulai' => ['required', 'date'],
            'periode_akhir' => ['required', 'date', 'after:periode_mulai'],
            'status' => ['required', Rule::in(['0', '1'])], // Pastikan hanya menerima '0' atau '1'
            'password' => ['nullable', 'string', 'min:3', 'confirmed'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        try {
            // Ambil struktur dari database untuk update
            $struktur = Struktur::findOrFail($authStruktur->id);

            // Update informasi dasar
            $struktur->nama = $validated['nama'];
            $struktur->nik = $validated['nik'];
            $struktur->jabatan = $validated['jabatan'];
            $struktur->no_wa = $validated['no_wa'];
            $struktur->akses = $validated['akses'];
            $struktur->periode_mulai = $validated['periode_mulai'];
            $struktur->periode_akhir = $validated['periode_akhir'];
            $struktur->status = (bool) $validated['status'];

            // Update password jika diisi
            if ($request->filled('password')) {
                $struktur->password = Hash::make($validated['password']);
            }

            // Handle upload gambar
            if ($request->hasFile('image')) {
                // Hapus foto lama jika ada
                if ($struktur->image) {
                    $oldPath = public_path('images/' . $struktur->image);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Simpan gambar baru
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Pastikan direktori images ada
                $path = public_path('images');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // Pindahkan file ke direktori public/images
                $file->move($path, $filename);

                $struktur->image = $filename;
            }

            // Simpan perubahan ke database
            $struktur->update();

            // Refresh session user
            Auth::guard('struktur')->setUser($struktur->fresh());

            return redirect()->route('struktur.profile.edit')->with('success', 'Profile berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage())
                         ->withInput();
        }
    }

    /**
     * Update profile struktur berdasarkan ID (untuk admin)
     */
    public function updateById(Request $request, $id)
    {
        // Pastikan user yang login adalah admin atau operator dengan akses penuh
        $isAdmin = Auth::guard('web')->check();
        $isOperatorFull = Auth::guard('struktur')->check() &&
                          Auth::guard('struktur')->user()->jabatan === 'Operator Desa' &&
                          Auth::guard('struktur')->user()->akses === 'full';

        if (!$isAdmin && !$isOperatorFull) {
            return back()->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
        }

        // Validasi input
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => [
                'required',
                'string',
                'max:16',
                Rule::unique('strukturs', 'nik')->ignore($id)
            ],
            'jabatan' => ['required', 'string', 'max:255'],
            'no_wa' => ['required', 'string', 'max:15'],
            'akses' => ['required', 'string'],
            'periode_mulai' => ['required', 'date'],
            'periode_akhir' => ['required', 'date', 'after:periode_mulai'],
            'status' => ['required', Rule::in(['0', '1'])],
            'password' => ['nullable', 'string', 'min:3', 'confirmed'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        try {
            // Ambil struktur dari database
            $struktur = Struktur::findOrFail($id);

            // Update informasi dasar
            $struktur->nama = $validated['nama'];
            $struktur->nik = $validated['nik'];
            $struktur->jabatan = $validated['jabatan'];
            $struktur->no_wa = $validated['no_wa'];
            $struktur->akses = $validated['akses'];
            $struktur->periode_mulai = $validated['periode_mulai'];
            $struktur->periode_akhir = $validated['periode_akhir'];
            $struktur->status = (bool) $validated['status'];

            // Update password jika diisi
            if ($request->filled('password')) {
                $struktur->password = Hash::make($validated['password']);
            }

            // Handle upload gambar
            if ($request->hasFile('image')) {
                // Hapus foto lama jika ada
                if ($struktur->image) {
                    $oldPath = public_path('images/' . $struktur->image);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                // Simpan gambar baru
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Pastikan direktori images ada
                $path = public_path('images');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // Pindahkan file ke direktori public/images
                $file->move($path, $filename);

                $struktur->image = $filename;
            }

            // Simpan perubahan ke database
            $struktur->update();

            return back()->with('success', 'Profile struktur berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating struktur profile: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui profil struktur: ' . $e->getMessage())
                         ->withInput();
        }
    }
}
