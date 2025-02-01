<?php

namespace App\Http\Controllers\Cms;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsPengaduanController extends Controller
{
    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return response()->json([
            'status' => $pengaduan->status,
            'response' => $pengaduan->response
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Selesai',
            'response' => 'required|string'
        ]);

        $pengaduan->update($validated);

        return redirect()->back()->with('success', 'Pengaduan berhasil diupdate');
    }
}