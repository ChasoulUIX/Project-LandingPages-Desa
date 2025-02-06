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
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 w-full max-w-4xl">
        <div class="bg-white rounded-xl shadow-lg">
            <div class="px-6 py-4 border-b flex items-center justify-between">
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

@push('styles')
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
</style>
@endpush

@push('scripts')
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
        
        // Check if it's a My Maps URL (contains "google.com/maps/d/embed" or "google.com/maps/d/u/0/embed")
        if (url.includes('google.com/maps/d/')) {
            const mapContainer = document.getElementById('map');
            mapContainer.innerHTML = `<iframe 
                src="${url}" 
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>`;
            return;
        }
        
        // Convert regular Google Maps URL to embed URL with polygon styling
        let embedUrl = '';
        
        if (url.includes('!3d') && url.includes('!4d')) {
            const lat = url.split('!3d')[1].split('!')[0];
            const lng = url.split('!4d')[1].split('!')[0];
            embedUrl = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951!2d${lng}!3d${lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6ff7e322d8fe3%3A0x761642564682d2ab!2sSumbersecang%2C%20Gading%2C%20Probolinggo%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid`;
        } else if (url.includes('@')) {
            const coords = url.split('@')[1].split(',');
            if (coords.length >= 2) {
                const lat = coords[0];
                const lng = coords[1].split(',')[0];
                embedUrl = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951!2d${lng}!3d${lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6ff7e322d8fe3%3A0x761642564682d2ab!2sSumbersecang%2C%20Gading%2C%20Probolinggo%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid`;
            }
        }
        
        if (embedUrl) {
            const mapContainer = document.getElementById('map');
            mapContainer.innerHTML = `<iframe 
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

    window.addEventListener('load', initMap);

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
