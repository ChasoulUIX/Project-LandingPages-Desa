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
        $domisilis = KeteranganDomisili::all(); // Ambil semua data domisili
        return view('cms.pages.suratketerangan.domisili', compact('domisilis'));
    }

    /**
     * Display domisili page.
     */
    public function domisili()
    {
        $domisilis = KeteranganDomisili::all(); // Ambil semua data domisili
        return view('cms.pages.suratketerangan.domisili', compact('domisilis'));
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $domisili = KeteranganDomisili::findOrFail($id);
        $domisili->status = $request->status;
        $domisili->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}