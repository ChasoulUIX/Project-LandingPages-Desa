<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\SuratKeteranganUsaha;
use Illuminate\Http\Request;

class CmsSuratUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratUsahas = SuratKeteranganUsaha::latest()->get();
        return view('cms.pages.suratketerangan.usaha', compact('suratUsahas'));
    }

    /**
     * Display surat usaha page.
     */
    public function usaha()
    {
        $suratUsahas = SuratKeteranganUsaha::latest()->get();
        return view('cms.pages.suratketerangan.usaha', compact('suratUsahas'));
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $surat = SuratKeteranganUsaha::findOrFail($id);
        $surat->status = $request->status;
        $surat->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
} 