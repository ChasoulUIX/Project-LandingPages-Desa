@extends('cms.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg">
        <div class="px-6 py-4 border-b flex items-center justify-between">
            <h4 class="text-xl font-bold text-gray-800">Profil Desa</h4>
            <button onclick="openEditModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm font-medium">
                <i class="fas fa-edit"></i>
                <span>Edit Profil</span>
            </button>
        </div>
        <div class="p-8">
            <div class="flex items-start gap-8">
                @if(isset($profileDesa) && $profileDesa->logo_image)
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/' . $profileDesa->logo_image) }}" alt="Logo Desa" class="h-32 w-auto">
                    </div>
                @endif
                <div class="flex-grow">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $profileDesa->judul ?? 'Default Nama' }}</h2>
                    <p class="text-gray-600 mb-4">{{ $profileDesa->synopsis ?? 'Default Sambutan' }}</p>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600"><i class="fas fa-envelope mr-2"></i> {{ $profileDesa->email ?? '-' }}</p>
                            <p class="text-gray-600"><i class="fas fa-phone mr-2"></i> {{ $profileDesa->telephone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600"><i class="fas fa-calendar mr-2"></i> Berdiri: {{ $profileDesa->tahun_berdiri ?? '-' }}</p>
                            <p class="text-gray-600"><i class="fas fa-map-marker-alt mr-2"></i> 
                                @php
                                    $lokasi = $profileDesa->lokasi ?? 'Default Lokasi';
                                    // If it's a URL, extract the location name with city and province
                                    if (filter_var($lokasi, FILTER_VALIDATE_URL)) {
                                        $parts = explode('/', $lokasi);
                                        $locationPart = array_values(array_filter($parts, function($part) {
                                            return strpos($part, '+') !== false || strpos($part, ',') !== false;
                                        }));
                                        if (!empty($locationPart)) {
                                            $lokasi = str_replace('+', ' ', urldecode($locationPart[0]));
                                            $lokasi = preg_replace('/\s*\+\s*/', ', ', $lokasi); // Replace + with comma and space
                                        }
                                    }
                                @endphp
                                {{ $lokasi }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Visi</h3>
                        @if(isset($profileDesa->visi) && is_array($profileDesa->visi))
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach($profileDesa->visi as $visi)
                                    <li>{{ $visi }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">-</p>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Misi</h3>
                        @if(isset($profileDesa->misi) && is_array($profileDesa->misi))
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach($profileDesa->misi as $misi)
                                    <li>{{ $misi }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600">-</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
                <p class="text-gray-600">{{ $profileDesa->deskripsi ?? '-' }}</p>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-3">Alamat</h3>
                <p class="text-gray-600">{{ $profileDesa->alamat ?? '-' }}</p>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-3">Lokasi</h3>
                <div id="map" class="rounded-xl h-[400px] shadow-lg"></div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-3">Galeri Slider</h3>
                <div class="relative">
                    <!-- Main Slider -->
                    <div class="swiper mainSwiper mb-4">
                        <div class="swiper-wrapper">
                            @if($profileDesa && !empty($profileDesa->gallery_images))
                                @foreach($profileDesa->gallery_images as $index => $image)
                                    <div class="swiper-slide bg-gray-100">
                                        <div class="relative w-full h-[500px]">
                                            <img src="{{ asset('images/' . $image) }}" 
                                                alt="Gallery Image {{ $index + 1 }}" 
                                                class="absolute inset-0 w-full h-full object-contain">
                                            @if(isset($profileDesa->gallery_texts[$index]))
                                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                                                    <p class="text-lg">{{ $profileDesa->gallery_texts[$index] }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-button-next !text-white !bg-black/50 hover:!bg-black/70 transition-colors"></div>
                        <div class="swiper-button-prev !text-white !bg-black/50 hover:!bg-black/70 transition-colors"></div>
                    </div>

                    <!-- Thumbnail Slider -->
                    <div class="swiper thumbSwiper">
                        <div class="swiper-wrapper">
                            @if($profileDesa && !empty($profileDesa->gallery_images))
                                @foreach($profileDesa->gallery_images as $index => $image)
                                    <div class="swiper-slide bg-gray-100">
                                        <div class="relative w-full h-24">
                                            <img src="{{ asset('images/' . $image) }}" 
                                                alt="Gallery Thumbnail {{ $index + 1 }}" 
                                                class="absolute inset-0 w-full h-full object-cover rounded-lg cursor-pointer">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="relative min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:mx-auto w-full max-w-4xl">
            <div class="bg-white rounded-xl shadow-lg max-h-[90vh] overflow-y-auto">
                <div class="sticky top-0 px-6 py-4 border-b bg-white flex items-center justify-between z-10">
                    <h4 class="text-xl font-bold text-gray-800">Edit Profil Desa</h4>
                    <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6">
                    <form action="{{ route('cms.profiledesa.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">Logo Desa</label>
                                    <div class="flex">
                                        <input type="file" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200 text-sm text-gray-700" 
                                            name="logo_image" 
                                            accept="image/*" 
                                            id="logo-input"
                                            onchange="previewImage(this)">
                                    </div>
                                    @if(isset($profileDesa) && $profileDesa->logo_image)
                                        <div class="mt-2">
                                            <img src="{{ asset('images/' . $profileDesa->logo_image) }}" alt="Logo Desa" class="h-20 w-auto">
                                        </div>
                                    @endif
                                    <div id="logo-preview" class="mt-2"></div>
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Judul</label>
                                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="judul" value="{{ old('judul', $profileDesa->judul ?? '') }}" required>
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Synopsis</label>
                                    <textarea class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="synopsis" rows="3">{{ old('synopsis', $profileDesa->synopsis ?? '') }}</textarea>
                                </div>
                            </div>

                            <div>
                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Email</label>
                                    <input type="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="email" value="{{ old('email', $profileDesa->email ?? '') }}">
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Telepon</label>
                                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="telephone" value="{{ old('telephone', $profileDesa->telephone ?? '') }}">
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Tahun Berdiri</label>
                                    <input type="number" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profileDesa->tahun_berdiri ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block font-bold mb-2">Deskripsi</label>
                            <textarea class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-200 transition-all duration-200" name="deskripsi" rows="5">{{ old('deskripsi', $profileDesa->deskripsi ?? '') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-6">
                                <label class="block font-bold mb-2">Visi</label>
                                <div id="visi-container">
                                    @if(isset($profileDesa->visi) && is_array($profileDesa->visi))
                                        @foreach($profileDesa->visi as $visi)
                                            <div class="flex gap-2 mb-2">
                                                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="visi[]" value="{{ $visi }}">
                                                <button type="button" onclick="removeField(this)" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" onclick="addField('visi')" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i class="fas fa-plus mr-2"></i>Tambah Visi
                                </button>
                            </div>
                            <div class="mb-6">
                                <label class="block font-bold mb-2">Misi</label>
                                <div id="misi-container">
                                    @if(isset($profileDesa->misi) && is_array($profileDesa->misi))
                                        @foreach($profileDesa->misi as $misi)
                                            <div class="flex gap-2 mb-2">
                                                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="misi[]" value="{{ $misi }}">
                                                <button type="button" onclick="removeField(this)" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" onclick="addField('misi')" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i class="fas fa-plus mr-2"></i>Tambah Misi
                                </button>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block font-bold mb-2">Alamat</label>
                            <textarea class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="alamat" rows="3">{{ old('alamat', $profileDesa->alamat ?? '') }}</textarea>
                        </div>

                        <div class="mb-8">
                            <label class="block font-bold mb-3">Lokasi Maps</label>
                            <input type="text" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-200 transition-all duration-200 mb-3" 
                                name="lokasi" 
                                placeholder="Masukkan link Google Maps" 
                                value="{{ old('lokasi', $profileDesa->lokasi ?? '') }}"
                                onchange="handleMapsUrlChange(this.value)">
                            <div id="map" class="rounded-xl h-[400px] shadow-lg"></div>
                        </div>

                        <!-- Gallery section in edit modal -->
                        <div class="mb-8">
                            <label class="block font-bold mb-3">Galeri Slider</label>
                            <div class="flex items-center gap-4 mb-4">
                                <input type="file" 
                                    class="hidden" 
                                    name="gallery_images[]" 
                                    id="gallery-input"
                                    accept="image/*"
                                    multiple
                                    onchange="previewGalleryImages(this)">
                                <label for="gallery-input" 
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg cursor-pointer flex items-center gap-2 text-sm font-medium">
                                    <i class="fas fa-images"></i>
                                    <span>Tambah Slide</span>
                                </label>
                            </div>

                            <!-- Existing Gallery Items -->
                            <div id="existing-gallery-preview" class="grid grid-cols-1 gap-4 mb-4">
                                @if($profileDesa && !empty($profileDesa->gallery_images))
                                    @foreach($profileDesa->gallery_images as $index => $image)
                                        <div class="relative group bg-gray-50 p-4 rounded-lg" data-index="{{ $index }}">
                                            <div class="flex gap-4">
                                                <div class="w-40 h-40 flex-shrink-0">
                                                    <img src="{{ asset('images/' . $image) }}" 
                                                        alt="Gallery Image" 
                                                        class="w-full h-full object-cover rounded-lg">
                                                </div>
                                                <div class="flex-grow">
                                                    <textarea 
                                                        name="existing_gallery_texts[]" 
                                                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200"
                                                        rows="4"
                                                        placeholder="Teks untuk slide ini">{{ $profileDesa->gallery_texts[$index] ?? '' }}</textarea>
                                                </div>
                                                <button type="button" 
                                                    onclick="removeExistingImage(this, {{ $index }})"
                                                    class="h-8 w-8 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- New Gallery Items Preview -->
                            <div id="new-gallery-preview" class="grid grid-cols-1 gap-4">
                                <!-- New items will be added here via JavaScript -->
                            </div>

                            <input type="hidden" name="removed_indexes" id="removed-indexes" value="[]">
                        </div>

                        <div class="flex justify-end mt-8">
                            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-200 flex items-center justify-center gap-2 text-sm font-medium">
                                <i class="fas fa-save"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
.form-control:focus {
    @apply ring-2 ring-blue-200 border-blue-300;
}
input[type="text"], input[type="email"], input[type="number"], textarea {
    @apply text-sm text-gray-700 transition-all duration-200;
}
label {
    @apply text-sm font-semibold text-gray-800;
}
#map {
    @apply rounded-xl shadow-lg;
}
.swiper {
    width: 100%;
    height: 100%;
}

.mainSwiper {
    height: 500px;
    width: 100%;
    background: #f3f4f6;
    border-radius: 0.75rem;
}

.thumbSwiper {
    height: 100px;
    box-sizing: border-box;
    padding: 10px 0;
}

.thumbSwiper .swiper-slide {
    width: 25%;
    height: 100%;
    opacity: 0.4;
    transition: all 0.3s ease;
}

.thumbSwiper .swiper-slide-thumb-active {
    opacity: 1;
    transform: scale(1.05);
}

.swiper-button-next,
.swiper-button-prev {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    --swiper-navigation-size: 20px;
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 20px;
}

.swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.75rem;
    overflow: hidden;
}

/* Add hover effect for thumbnails */
.thumbSwiper .swiper-slide:hover {
    opacity: 0.8;
    transform: scale(1.02);
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    function addField(type) {
        const container = document.getElementById(`${type}-container`);
        const newField = document.createElement('div');
        newField.className = 'flex gap-2 mb-2';
        newField.innerHTML = `
            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="${type}[]" placeholder="Masukkan ${type}...">
            <button type="button" onclick="removeField(this)" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                <i class="fas fa-minus"></i>
            </button>
        `;
        container.appendChild(newField);
    }

    function removeField(button) {
        button.parentElement.remove();
    }

    // Initialize empty containers with one field if empty
    window.onload = function() {
        if (!document.querySelector('#visi-container div')) {
            addField('visi');
        }
        if (!document.querySelector('#misi-container div')) {
            addField('misi');
        }
    }

    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
        // Reinitialize map in modal if needed
        initMap();
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) {
            closeEditModal();
        }
    }

    function handleMapsUrlChange(url) {
        if (!url) return;
        
        let embedUrl = '';
        
        // Cek jika URL adalah dari Google My Maps
        if (url.includes('google.com/maps/d/')) {
            // Jika URL sudah dalam format embed, gunakan langsung
            if (url.includes('/embed')) {
                embedUrl = url;
            } else {
                // Jika URL dalam format edit atau view, konversi ke format embed
                embedUrl = url.replace('/edit', '/embed').replace('/viewer', '/embed');
                
                // Pastikan mid parameter ada
                if (!embedUrl.includes('mid=')) {
                    const midMatch = url.match(/[?&]mid=([^&]+)/);
                    if (midMatch) {
                        embedUrl = `https://www.google.com/maps/d/embed?mid=${midMatch[1]}`;
                    }
                }
            }
        } else {
            // Untuk URL Google Maps biasa, ekstrak koordinat
            const pattern = /@(-?\d+\.\d+),(-?\d+\.\d+)/;
            const matches = url.match(pattern);
            
            if (matches) {
                const [, lat, lng] = matches;
                embedUrl = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.0!2d${lng}!3d${lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM!5e0!3m2!1sen!2sid!4v1`;
            }
        }
        
        // Update iframe jika ada valid URL
        if (embedUrl) {
            const mapContainer = document.getElementById('map');
            mapContainer.innerHTML = `
                <iframe 
                    src="${embedUrl}"
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>`;
        }
    }

    // Initialize map when page loads
    document.addEventListener('DOMContentLoaded', function() {
        const locationInput = document.querySelector('input[name="lokasi"]');
        if (locationInput && locationInput.value) {
            handleMapsUrlChange(locationInput.value);
        }
    });

    // Handle map URL changes
    document.querySelector('input[name="lokasi"]')?.addEventListener('change', function(e) {
        handleMapsUrlChange(e.target.value);
    });

    function initMap() {
        const locationInput = document.querySelector('input[name="lokasi"]');
        // Default My Maps URL with polygon boundary (ganti dengan URL My Maps Anda)
        const defaultUrl = 'https://www.google.com/maps/d/embed?mid=YOUR_MAP_ID';
        
        if (locationInput && locationInput.value) {
            handleMapsUrlChange(locationInput.value);
        } else {
            const mapContainer = document.getElementById('map');
            mapContainer.innerHTML = `<iframe 
                src="${defaultUrl}" 
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>`;
        }

        if (locationInput) {
            locationInput.addEventListener('change', (e) => {
                handleMapsUrlChange(e.target.value);
            });
        }
    }

    function previewImage(input) {
        const preview = document.getElementById('logo-preview');
        preview.innerHTML = '';
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('h-20', 'w-auto', 'mt-2');
                preview.appendChild(img);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewGalleryImages(input) {
        const preview = document.getElementById('new-gallery-preview');
        const existingCount = document.getElementById('existing-gallery-preview')
            .querySelectorAll('.group').length;
        
        if (input.files) {
            // Get previously selected files and their texts
            const prevFiles = Array.from(preview.querySelectorAll('.group')).map(group => ({
                file: group.querySelector('img').src,
                text: group.querySelector('textarea').value
            }));
            
            // Clear the preview
            preview.innerHTML = '';
            
            // Create new FileList
            let dataTransfer = new DataTransfer();
            
            // Add new files
            Array.from(input.files).forEach(file => {
                dataTransfer.items.add(file);
            });
            
            // Update input files
            const fileInput = document.querySelector('input[name="gallery_images[]"]');
            fileInput.files = dataTransfer.files;
            
            // Restore previous files and texts, then add new files
            prevFiles.forEach((item, idx) => {
                const div = createGalleryItem(item.file, item.text, existingCount + idx);
                preview.appendChild(div);
            });
            
            // Add new files
            Array.from(input.files).forEach((file, idx) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = createGalleryItem(e.target.result, '', existingCount + prevFiles.length + idx);
                    preview.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    function createGalleryItem(imgSrc, text, index) {
        const div = document.createElement('div');
        div.className = 'relative group bg-gray-50 p-4 rounded-lg';
        div.dataset.index = index;
        div.innerHTML = `
            <div class="flex gap-4">
                <div class="w-40 h-40 flex-shrink-0">
                    <img src="${imgSrc}" 
                        alt="Gallery Preview" 
                        class="w-full h-full object-cover rounded-lg">
                </div>
                <div class="flex-grow">
                    <textarea 
                        name="new_gallery_texts[]" 
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200"
                        rows="4"
                        placeholder="Teks untuk slide ini">${text}</textarea>
                </div>
                <button type="button" 
                    onclick="removeNewImage(this)"
                    class="h-8 w-8 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        return div;
    }

    function removeNewImage(button) {
        const container = button.closest('.group');
        const preview = document.getElementById('new-gallery-preview');
        const fileInput = document.querySelector('input[name="gallery_images[]"]');
        
        // Get all current items with their texts
        const items = Array.from(preview.querySelectorAll('.group')).map(group => ({
            file: group.querySelector('img').src,
            text: group.querySelector('textarea').value,
            element: group
        }));
        
        // Remove the selected item
        const indexToRemove = items.findIndex(item => item.element === container);
        items.splice(indexToRemove, 1);
        
        // Clear preview
        preview.innerHTML = '';
        
        // Create new FileList without removed file
        const dt = new DataTransfer();
        Array.from(fileInput.files).forEach((file, idx) => {
            if (idx !== indexToRemove) {
                dt.items.add(file);
            }
        });
        fileInput.files = dt.files;
        
        // Restore remaining items
        items.forEach((item, idx) => {
            const div = createGalleryItem(item.file, item.text, idx);
            preview.appendChild(div);
        });
    }

    function removeExistingImage(button, index) {
        const removedIndexesInput = document.getElementById('removed-indexes');
        let removedIndexes = JSON.parse(removedIndexesInput.value);
        removedIndexes.push(index);
        removedIndexesInput.value = JSON.stringify(removedIndexes);
        button.closest('.group').remove();
    }

    // Initialize Swiper
    document.addEventListener('DOMContentLoaded', function() {
        var thumbSwiper = new Swiper(".thumbSwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {
                320: { slidesPerView: 2, spaceBetween: 10 },
                480: { slidesPerView: 3, spaceBetween: 10 },
                640: { slidesPerView: 4, spaceBetween: 10 }
            }
        });
        
        var mainSwiper = new Swiper(".mainSwiper", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: thumbSwiper,
            },
            keyboard: {
                enabled: true,
            },
        });
    });
</script>
@endpush
@endsection
