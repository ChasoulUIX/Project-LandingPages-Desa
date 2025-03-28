<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Sambutan;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{

    /**
     *
     * ini penyebab tidak muncul nya modal edit di module sambutan kepala desa
     */

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (auth()->guard('web')->check() ||
    //             (auth()->guard('struktur')->check() &&
    //              (auth()->guard('struktur')->user()->jabatan === 'Operator Desa' &&
    //              auth()->guard('struktur')->user()->akses === 'full'))) {
    //             return $next($request);
    //         }
    //         return redirect()->back()->with('error', 'Unauthorized access');
    //     })->except(['index', 'show']);
    // }

    public function index()
    {
        // Ambil data sambutan yang ada, atau buat data default jika belum ada
        $sambutan = Sambutan::first();

        if (!$sambutan) {
            $sambutan = Sambutan::create([
                'nama' => 'Nama Kepala Desa',
                'jabatan' => 'Kepala Desa',
                'sambutan' => 'Selamat datang di website desa kami...',
                'periode' => '2024-2029',
                'image' => 'default.jpg'
            ]);
        }

        $sliders = HeroSlider::orderBy('order')->get();
        return view('cms.pages.sambutan', compact('sambutan', 'sliders'));
    }

    public function edit($id)
    {
        $sambutan = Sambutan::findOrFail($id);
        return response()->json($sambutan);
    }

    public function update(Request $request, $id)
    {
        $sambutan = Sambutan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'sambutan' => 'required',
            'periode' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['nama', 'jabatan', 'sambutan', 'periode']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($sambutan->image && file_exists(public_path('images/' . $sambutan->image))) {
                unlink(public_path('images/' . $sambutan->image));
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $data['image'] = $imageName;
        }

        $sambutan->update($data);

        return redirect()->back()->with('success', 'Sambutan berhasil diperbarui');
    }
}