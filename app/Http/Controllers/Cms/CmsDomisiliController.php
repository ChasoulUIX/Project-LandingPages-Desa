<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\KeteranganDomisili;
use Illuminate\Http\Request;

class CmsDomisiliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cms.pages.suratketerangan.domisili');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Disetujui,Ditolak',
        ]);

        $domisili = KeteranganDomisili::findOrFail($id);
        $domisili->status = $request->status;
        $domisili->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}