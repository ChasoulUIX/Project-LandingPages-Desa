<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CmsHeroSliderController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'background_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'heading' => 'required|string|max:255',
                'subheading' => 'required|string|max:255',
                'tagline' => 'nullable|string|max:255',
                'order' => 'nullable|integer',
                'is_active' => 'nullable'
            ]);

            if ($request->hasFile('background_image')) {
                $image = $request->file('background_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                
                $path = public_path('images');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $image->move($path, $imageName);
                $validated['background_image'] = $imageName;
            }

            $validated['is_active'] = $request->has('is_active') ? 1 : 0;
            
            // Debug log
            Log::info('Validated data:', $validated);

            $slider = HeroSlider::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Slider berhasil ditambahkan',
                'data' => $slider
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating slider: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, HeroSlider $slider)
    {
        try {
            $validated = $request->validate([
                'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'heading' => 'required|string|max:255',
                'subheading' => 'required|string|max:255',
                'tagline' => 'nullable|string|max:255',
                'order' => 'nullable|integer',
                'is_active' => 'nullable'
            ]);

            if ($request->hasFile('background_image')) {
                // Hapus gambar lama
                if ($slider->background_image) {
                    $oldPath = public_path('images/' . $slider->background_image);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                // Upload gambar baru
                $image = $request->file('background_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $validated['background_image'] = $imageName;
            }

            // Set is_active
            $validated['is_active'] = $request->has('is_active') ? 1 : 0;

            // Update slider
            $slider->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Slider berhasil diupdate',
                'data' => $slider
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating slider: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(HeroSlider $slider)
    {
        if ($slider->background_image) {
            $path = public_path('images/sliders/' . $slider->background_image);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        
        $slider->delete();
        return response()->json(['success' => true]);
    }

    public function edit(HeroSlider $slider)
    {
        return response()->json($slider);
    }
}
