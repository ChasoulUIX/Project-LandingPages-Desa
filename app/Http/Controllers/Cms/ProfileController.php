<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('cms.pages.editprofile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:3', 'confirmed'],
            'photo_profile' => ['nullable', 'image', 'max:2048']
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('photo_profile')) {
            // Delete old photo if exists
            if ($user->photo_profile) {
                $oldPath = public_path('images/' . $user->photo_profile);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Store new photo in public/images directory
            $file = $request->file('photo_profile');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Ensure the images directory exists
            $path = public_path('images');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Move the uploaded file to public/images
            $file->move($path, $filename);

            $user->photo_profile = $filename;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }
}
