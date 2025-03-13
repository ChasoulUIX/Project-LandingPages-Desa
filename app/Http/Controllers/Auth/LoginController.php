<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],  // This field will accept either email or NIK
            'password' => ['required'],
        ]);

        // Try regular user (admin) authentication first
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (Auth::guard('web')->attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->boolean('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended('/cms/app/dashboard');
            }
        }

        // Try Struktur authentication
        $struktur = \App\Models\Struktur::where('nik', $request->email)->first();

        if ($struktur) {
            // Cek apakah jabatan adalah Operator Desa dan akses adalah full
            if ($struktur->jabatan === 'Operator Desa' && $struktur->akses === 'full') {
                if (password_verify($request->password, $struktur->password)) {
                    // Check if all required fields are filled
                    $requiredFields = ['nama', 'jabatan', 'no_wa', 'akses', 'periode_mulai', 'periode_akhir', 'status', 'image'];
                    $isComplete = !collect($requiredFields)->contains(function ($field) use ($struktur) {
                        return empty($struktur->$field);
                    });

                    // Login the Struktur user using struktur guard
                    Auth::guard('struktur')->login($struktur);
                    $request->session()->regenerate();

                    if ($isComplete) {
                        return redirect()->intended('/cms/app/dashboard');
                    } else {
                        return redirect()->route('profile.edit')->with('warning', 'Silakan lengkapi data profil Anda terlebih dahulu.');
                    }
                }
            } else {
                throw ValidationException::withMessages([
                    'email' => ['Akses tidak diizinkan. Hanya Operator Desa dengan akses penuh yang dapat login.'],
                ]);
            }
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout from both guards
        Auth::guard('web')->logout();
        Auth::guard('struktur')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}