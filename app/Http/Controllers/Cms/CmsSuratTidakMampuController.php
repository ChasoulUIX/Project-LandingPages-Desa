<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\SuratTidakMampu;
use Illuminate\Http\Request;

class CmsSuratTidakMampuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratTidakMampus = SuratTidakMampu::all(); // Ambil semua data surat tidak mampu
        return view('cms.pages.suratketerangan.tidakmampu', compact('suratTidakMampus'));
    }

    /**
     * Display surat tidak mampu page.
     */
    public function tidakMampu()
    {
        $suratTidakMampus = SuratTidakMampu::all(); // Ambil semua data surat tidak mampu
        return view('cms.pages.suratketerangan.tidakmampu', compact('suratTidakMampus'));
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $surat = SuratTidakMampu::findOrFail($id);
        $surat->status = $request->status;
        $surat->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
} 