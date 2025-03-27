<?php

namespace App\Http\Controllers\Cms;

use App\Models\Struktur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class StrukturProfileController extends Controller
{
    /**
     * Menampilkan form edit profile struktur
     */
    public function edit()
    {
        // Tambahkan pengecekan auth
        if (!Auth::guard('struktur')->check()) {
            Log::error('User not authenticated as struktur');
            return redirect()->route('login');
        }

        try {
            // Ambil data terbaru dari database
            $authUser = Auth::guard('struktur')->user();
            Log::info('User auth ID: ' . $authUser->id);

            // Gunakan query builder untuk mendapatkan data terbaru
            $struktur = DB::table('strukturs')->where('id', $authUser->id)->first();

            if (!$struktur) {
                Log::error('Struktur tidak ditemukan untuk ID: ' . $authUser->id);
                return redirect()->route('login')
                    ->with('error', 'Data pengguna tidak ditemukan, silakan login ulang.');
            }

            // Refresh session dengan data model terbaru (jika ditemukan)
            $strukturModel = Struktur::where('id', $authUser->id)->first();
            if ($strukturModel) {
                Auth::guard('struktur')->login($strukturModel);
                Log::info('Refreshed auth session with updated struktur data');
            }

            Log::info('Accessing edit profile for struktur: ' . $struktur->nama);

            // Convert objek stdClass ke array untuk view
            $struktur = (array) $struktur;

            return view('cms.pages.editprofile', compact('struktur'));
        } catch (\Exception $e) {
            Log::error('Error accessing edit profile: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat mengakses profil: ' . $e->getMessage());
        }
    }

    


    /**
     * Update profile struktur berdasarkan ID (untuk admin)
     */
    public function updateById(Request $request, $id)
    {
        // Logging untuk debug parameter id yang diterima
        Log::info('Params updateById - id type: ' . gettype($id) . ', value: ' . $id);

        // Konversi ID ke integer untuk memastikan tidak ada masalah
        try {
            $id = (int) $id;
            if ($id <= 0) {
                Log::error('Invalid ID: ' . $id);
                return back()->with('error', 'ID tidak valid.')
                    ->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Error converting ID to integer: ' . $e->getMessage());
            return back()->with('error', 'ID tidak valid: ' . $e->getMessage())
                ->withInput();
        }

        // Pastikan user yang login adalah admin atau operator dengan akses penuh
        $isAdmin = Auth::guard('web')->check();
        $isOperatorFull = Auth::guard('struktur')->check() &&
                          Auth::guard('struktur')->user()->jabatan === 'Operator Desa' &&
                          Auth::guard('struktur')->user()->akses === 'full';

        if (!$isAdmin && !$isOperatorFull) {
            return back()->with('error', 'Anda tidak memiliki izin untuk melakukan tindakan ini.');
        }

        // Logging
        Log::info('Updating struktur by ID: ' . $id);
        Log::info('Requested NIK: ' . $request->nik);

        try {
            // Cari struktur di database terlebih dahulu dengan query builder
            $struktur = DB::table('strukturs')->where('id', $id)->first();

            if (!$struktur) {
                Log::error('Struktur tidak ditemukan di database dengan ID: ' . $id);
                return back()->with('error', 'Data struktur tidak ditemukan.')
                    ->withInput();
            }

            Log::info('Struktur ditemukan di database dengan ID: ' . $id);

            // Periksa NIK duplikat
            if ($request->nik != $struktur->nik) {
                $nikExists = DB::table('strukturs')
                    ->where('nik', $request->nik)
                    ->where('id', '!=', $id)
                    ->exists();

                if ($nikExists) {
                    return back()->with('error', 'NIK sudah digunakan oleh struktur lain.')
                        ->withInput();
                }
            }

            // Validasi input
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'nik' => ['required', 'string', 'max:16'],
                'jabatan' => ['required', 'string', 'max:255'],
                'no_wa' => ['required', 'string', 'max:15'],
                'akses' => ['required', 'string'],
                'periode_mulai' => ['required', 'date'],
                'periode_akhir' => ['required', 'date', 'after:periode_mulai'],
                'status' => ['required', Rule::in(['0', '1'])],
                'password' => ['nullable', 'string', 'min:3', 'confirmed'],
                'image' => ['nullable', 'image', 'max:2048']
            ]);

            // Persiapkan data update
            $updateData = [
                'nama' => $validated['nama'],
                'nik' => $validated['nik'],
                'jabatan' => $validated['jabatan'],
                'no_wa' => $validated['no_wa'],
                'akses' => $validated['akses'],
                'periode_mulai' => $validated['periode_mulai'],
                'periode_akhir' => $validated['periode_akhir'],
                'status' => $validated['status'],
                'updated_at' => now()
            ];

            Log::info('Data yang akan diupdate: ' . json_encode($updateData));

            // Update password jika diisi
            if (!empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            // Handle upload gambar
            if ($request->hasFile('image')) {
                // Hapus foto lama jika ada
                if (!empty($struktur->image)) {
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

                // Pindahkan file
                $file->move($path, $filename);
                $updateData['image'] = $filename;
            }

            // Update dengan query builder yang lebih reliable
            $updated = DB::table('strukturs')
                ->where('id', $id)
                ->update($updateData);

            if ($updated === false) {
                Log::error('Gagal update data struktur: ' . $id);
                return back()->with('error', 'Gagal menyimpan data. Database error.')
                    ->withInput();
            }

            Log::info('Berhasil update data struktur by ID: ' . $id);
            return back()->with('success', 'Profile struktur berhasil diperbarui');

        } catch (\Exception $e) {
            Log::error('Error updating struktur profile: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui profil struktur: ' . $e->getMessage())
                         ->withInput();
        }
    }
}
