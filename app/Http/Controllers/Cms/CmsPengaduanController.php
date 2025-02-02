<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class CmsPengaduanController extends Controller
{
    public function index()
    {
        return view('cms.pages.pengaduan');
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return response()->json($pengaduan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,resolved,rejected',
            'response' => 'nullable|string'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->response = $request->response;
        $pengaduan->save();

        return redirect()->back()->with('success', 'Pengaduan berhasil diperbarui');
    }
}