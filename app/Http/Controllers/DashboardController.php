<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah user login sebagai struktur
        if (Auth::guard('struktur')->check()) {
            $user = Auth::guard('struktur')->user();
            // Logic untuk dashboard struktur
            return view('cms.app.dashboard', [
                'user' => $user,
                // Tambahkan data lain yang diperlukan untuk dashboard struktur
            ]);
        }

        // Jika login sebagai user biasa
        $user = Auth::user();
        return view('cms.app.dashboard', [
            'user' => $user,
            // Tambahkan data lain yang diperlukan untuk dashboard user biasa
        ]);
    }
} 