<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\SuratKelahiran;
use Illuminate\Http\Request;

class CmsSuratKelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function kelahiran()  // Menggunakan nama method yang sesuai dengan route
    {
        $suratKelahirans = SuratKelahiran::latest()->get();
        return view('cms.pages.suratketerangan.kelahiran', compact('suratKelahirans'));
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processed,completed,rejected',
        ]);

        $surat = SuratKelahiran::findOrFail($id);
        $surat->status = $request->status;
        $surat->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
} 
