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
                            <p class="text-gray-600"><i class="fas fa-map mr-2"></i> 
                                {{ $profileDesa->desa ?? '-' }}, 
                                {{ $profileDesa->kecamatan ?? '-' }}, 
                                {{ $profileDesa->kabupaten ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600"><i class="fas fa-calendar mr-2"></i> Berdiri: {{ $profileDesa->tahun_berdiri ?? '-' }}</p>
                            <p class="text-gray-600"><i class="fas fa-map-marker-alt mr-2"></i> 
                                @php
                                    $lokasi = $profileDesa->lokasi ?? 'Default Lokasi';
                                    // If it's a URL, extract the location name
                                    if (filter_var($lokasi, FILTER_VALIDATE_URL)) {
                                        // Extract location name from Google Maps URL
                                        if (preg_match('/place\/([^\/]+)/', $lokasi, $matches)) {
                                            $lokasi = str_replace('+', ' ', urldecode($matches[1]));
                                            // Remove any text after comma and question mark
                                            $lokasi = preg_replace('/,.+$/', '', $lokasi);
                                            $lokasi = preg_replace('/\?.+$/', '', $lokasi);
                                        }
                                    }
                                @endphp
                                {{ $lokasi }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-8 border-gray-200">

            <div>
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

            <hr class="my-8 border-gray-200">

            <div>
                <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
                <p class="text-gray-600">{{ $profileDesa->deskripsi ?? '-' }}</p>
            </div>

            <hr class="my-8 border-gray-200">

            <div>
                <h3 class="text-lg font-semibold mb-3">Alamat</h3>
                <p class="text-gray-600">{{ $profileDesa->alamat ?? '-' }}</p>
            </div>

            <hr class="my-8 border-gray-200">

            <div>
                <h3 class="text-lg font-semibold mb-3">Lokasi</h3>
                <div id="map" class="rounded-xl h-[400px] shadow-lg"></div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-3">Daftar Dusun</h3>
                @if(isset($profileDesa->dusun) && is_array($profileDesa->dusun))
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach($profileDesa->dusun as $dusun)
                            <li>{{ $dusun }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">-</p>
                @endif
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
                    <form action="{{ route('cms.profiledesa.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                                            onchange="previewImage(this)"
                                            autocomplete="off">
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
                                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="judul" value="{{ old('judul', $profileDesa->judul ?? '') }}" required autocomplete="off">
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Synopsis</label>
                                    <textarea class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="synopsis" rows="3" autocomplete="off">{{ old('synopsis', $profileDesa->synopsis ?? '') }}</textarea>
                                </div>
                            </div>

                            <div>
                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Email</label>
                                    <input type="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="email" value="{{ old('email', $profileDesa->email ?? '') }}" autocomplete="off">
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Telepon</label>
                                    <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="telephone" value="{{ old('telephone', $profileDesa->telephone ?? '') }}" autocomplete="off">
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Tahun Berdiri</label>
                                    <input type="number" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profileDesa->tahun_berdiri ?? '') }}" autocomplete="off">
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Desa</label>
                                    <input type="text" 
                                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" 
                                        name="desa" 
                                        value="{{ old('desa', $profileDesa->desa ?? '') }}" 
                                        autocomplete="off">
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Kecamatan</label>
                                    <input type="text" 
                                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" 
                                        name="kecamatan" 
                                        value="{{ old('kecamatan', $profileDesa->kecamatan ?? '') }}" 
                                        autocomplete="off">
                                </div>

                                <div class="mb-6">
                                    <label class="block font-bold mb-2">Kabupaten</label>
                                    <input type="text" 
                                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" 
                                        name="kabupaten" 
                                        value="{{ old('kabupaten', $profileDesa->kabupaten ?? '') }}" 
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block font-bold mb-2">Deskripsi</label>
                            <textarea class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-200 transition-all duration-200" name="deskripsi" rows="5" autocomplete="off">{{ old('deskripsi', $profileDesa->deskripsi ?? '') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-6">
                                <label class="block font-bold mb-2">Visi</label>
                                <div id="visi-container">
                                    @if(isset($profileDesa->visi) && is_array($profileDesa->visi))
                                        @foreach($profileDesa->visi as $visi)
                                            <div class="flex gap-2 mb-2">
                                                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="visi[]" value="{{ $visi }}" autocomplete="off">
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
                                                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="misi[]" value="{{ $misi }}" autocomplete="off">
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
                            <div class="mb-6">
                                <label class="block font-bold mb-2">Dusun</label>
                                <div id="dusun-container">
                                    @if(isset($profileDesa->dusun) && is_array($profileDesa->dusun))
                                        @foreach($profileDesa->dusun as $dusun)
                                            <div class="flex gap-2 mb-2">
                                                <input type="text" 
                                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" 
                                                       name="dusun[]" 
                                                       value="{{ $dusun }}" 
                                                       autocomplete="off">
                                                <button type="button" 
                                                        onclick="removeField(this)" 
                                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" 
                                        onclick="addField('dusun')" 
                                        class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i class="fas fa-plus mr-2"></i>Tambah Dusun
                                </button>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block font-bold mb-2">Alamat</label>
                            <textarea class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" name="alamat" rows="3" autocomplete="off">{{ old('alamat', $profileDesa->alamat ?? '') }}</textarea>
                        </div>

                        <div class="mb-8">
                            <label class="block font-bold mb-3">Lokasi Maps</label>
                            <input type="text" class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-200 transition-all duration-200 mb-3" 
                                name="lokasi" 
                                placeholder="Masukkan link Google Maps" 
                                value="{{ old('lokasi', $profileDesa->lokasi ?? '') }}"
                                onchange="handleMapsUrlChange(this.value)"
                                autocomplete="off">
                            <div id="map" class="rounded-xl h-[400px] shadow-lg"></div>
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
        
        let placeholder = '';
        switch(type) {
            case 'visi':
                placeholder = 'Masukkan visi...';
                break;
            case 'misi':
                placeholder = 'Masukkan misi...';
                break;
            case 'dusun':
                placeholder = 'Masukkan nama dusun...';
                break;
        }
        
        newField.innerHTML = `
            <input type="text" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-200" 
                name="${type}[]" 
                placeholder="${placeholder}"
                autocomplete="off">
            <button type="button" 
                    onclick="removeField(this)" 
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
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
        if (!document.querySelector('#dusun-container div')) {
            addField('dusun');
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
        let locationQuery = '';
        
        // Handle different Google Maps URL formats
        if (url.includes('google.com/maps/place/') || url.includes('google.co.id/maps/place/')) {
            // Extract location name from place URL
            const placeMatch = url.match(/place\/([^\/]+)/);
            if (placeMatch) {
                locationQuery = placeMatch[1];
                // Remove coordinates and additional parameters
                locationQuery = locationQuery.split('/@')[0];
                // Convert to embed URL format
                embedUrl = `https://www.google.com/maps?q=${locationQuery}&output=embed`;
            }
        } else if (url.includes('google.com/maps/d/')) {
            // Handle My Maps URLs
            embedUrl = url.replace('/edit', '/embed').replace('/viewer', '/embed');
        } else if (url.includes('google.com/maps?q=')) {
            // Already in correct format
            embedUrl = url.includes('output=embed') ? url : `${url}&output=embed`;
        } else {
            // Extract coordinates as fallback
            const pattern = /@(-?\d+\.\d+),(-?\d+\.\d+)/;
            const matches = url.match(pattern);
            if (matches) {
                const [, lat, lng] = matches;
                embedUrl = `https://www.google.com/maps?q=${lat},${lng}&output=embed`;
            }
        }
        
        // Update iframe if valid URL
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
</script>
@endpush
@endsection

