<?php

namespace App\Http\Controllers\User;

use App\Models\Pengaduan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class PengaduanController extends Controller
{
    public function __construct()
    {
        // Create pengaduans table if it doesn't exist
        if (!Schema::hasTable('pengaduans')) {
            Schema::create('pengaduans', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('nik', 16);
                $table->string('phone', 15);
                $table->string('category');
                $table->text('description');
                $table->string('attachment')->nullable();
                $table->timestamps();
            });
        }
    }

    public function index()
    {
        return view('user.pages.layanan.pengaduan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'phone' => 'required|string|max:15',
            'category' => 'required|string',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['attachment'] = $filename;
        }

        Pengaduan::create($data);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim. Kami akan menindaklanjuti sesegera mungkin.');
    }
}