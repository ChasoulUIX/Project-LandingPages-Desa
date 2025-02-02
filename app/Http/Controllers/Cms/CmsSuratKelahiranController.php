<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\SuratKelahiran;
use Illuminate\Http\Request;

class CmsSuratKelahiranController extends Controller
{
    public function index()
    {
        return view('cms.pages.suratketerangan.kelahiran');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $surat = SuratKelahiran::findOrFail($id);
        $surat->status = $request->status;
        $surat->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
} 
