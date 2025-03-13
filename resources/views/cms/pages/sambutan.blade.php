@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(auth()->guard('web')->check() || (auth()->guard('struktur')->check() && auth()->guard('struktur')->user()->jabatan === 'Operator Desa' && auth()->guard('struktur')->user()->akses === 'full'))
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Sambutan Kepala Desa</h1>
            <button onclick="openEditModal({{ $sambutan->id }})" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg flex items-center transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-edit mr-2"></i> Edit Sambutan
            </button>
        </div>

        <!-- Sambutan Display -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="relative">
                @if($sambutan->image)
                    <img src="{{ asset('images/' . $sambutan->image) }}" alt="{{ $sambutan->nama }}" class="w-64 h-64 object-contain float-left mr-6">
                @else
                    <img src="{{ asset('images/default.jpg') }}" alt="Default Image" class="w-64 h-64 object-contain float-left mr-6">
                @endif
                <div class="absolute top-0 right-0 p-3 flex space-x-2">
                    <button onclick="openEditModal({{ $sambutan->id }})" class="bg-white p-2 rounded-full shadow-md text-blue-600 hover:text-blue-800 transition duration-300">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $sambutan->nama }}</h3>
                <p class="text-blue-600 font-semibold text-md mb-2">Kepala Desa</p>
                <p class="text-gray-600">{{ $sambutan->sambutan }}</p>
                <p class="text-gray-600 mt-4">Periode: {{ $sambutan->periode }}</p>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl w-full max-w-4xl mx-4 shadow-2xl transform transition-all">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-2xl font-bold text-gray-900">Edit Sambutan</h3>
                    <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800 transition duration-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="editForm" method="POST" action="{{ route('sambutan.update', $sambutan->id) }}" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                                <input type="text" name="nama" id="edit_nama" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                                <input type="text" name="jabatan" id="edit_jabatan" value="Kepala Desa" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 bg-gray-100" readonly required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Sambutan</label>
                                <textarea name="sambutan" id="edit_sambutan" rows="6" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                                <input type="text" name="periode" id="edit_periode" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                                    <img id="imagePreview" src="{{ asset('images/' . $sambutan->image) }}" alt="Preview" class="w-full h-64 object-contain mb-4">
                                    <input type="file" name="image" id="imageInput" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onchange="previewImage(this)">
                                    @if($sambutan->image)
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-600">Current image: {{ $sambutan->image }}</p>
                                            <input type="hidden" name="old_image" value="{{ $sambutan->image }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-3 px-4 hover:bg-blue-700 transition duration-300 font-semibold">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Slider Section -->
        <div class="mt-12">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Hero Sliders</h2>
                <button onclick="openSliderModal()" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add New Slider
                </button>
            </div>

            <!-- Sliders List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(App\Models\HeroSlider::orderBy('order')->get() as $slider)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="{{ asset('images/' . $slider->background_image) }}" alt="Slider" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">{{ $slider->heading }}</h3>
                        <p class="text-gray-600">{{ $slider->subheading }}</p>
                        <p class="text-gray-500 text-sm mt-2">{{ $slider->tagline }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex space-x-2">
                                <button onclick="editSlider({{ $slider->id }})" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteSlider({{ $slider->id }})" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-500 mr-2">Order:</span>
                                <span class="font-semibold">{{ $slider->order }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Slider Modal -->
        <div id="sliderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl w-full max-w-4xl mx-4 shadow-2xl">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-2xl font-bold text-gray-900" id="sliderModalTitle">Add New Slider</h3>
                    <button onclick="closeSliderModal()" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="sliderForm" class="p-6" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" id="slider_id" name="slider_id">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom Kiri - Form Fields -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Heading</label>
                                <input type="text" name="heading" id="slider_heading" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                    placeholder="Masukkan heading slider"
                                    autocomplete="off">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Subheading</label>
                                <input type="text" name="subheading" id="slider_subheading" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                    placeholder="Masukkan subheading slider"
                                    autocomplete="off">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tagline</label>
                                <textarea name="tagline" id="slider_tagline" rows="4" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                    placeholder="Masukkan tagline slider"
                                    autocomplete="off"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Order</label>
                                <input type="number" name="order" id="slider_order" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                    value="0">
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="slider_is_active" 
                                    class="w-5 h-5 rounded border-gray-300 text-blue-600" value="1" checked>
                                <label class="ml-2 text-sm font-medium text-gray-700">Active</label>
                            </div>
                        </div>

                        <!-- Kolom Kanan - Image Preview -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Background Image</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                                <div class="mb-4 bg-gray-50 rounded-lg overflow-hidden">
                                    <img id="preview_image" src="{{ asset('images/placeholder.jpg') }}" 
                                        alt="Preview" class="w-full h-64 object-contain">
                                </div>
                                <div class="mt-2">
                                    <input type="file" name="background_image" id="background_image" 
                                        class="hidden" accept="image/*" onchange="previewImage(this)">
                                    <label for="background_image" 
                                        class="cursor-pointer bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Pilih Gambar
                                    </label>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Rekomendasi: Gambar dengan rasio 16:9, maksimal 2MB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-3 px-4 hover:bg-blue-700 transition duration-300 font-semibold">
                            Save Slider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <!-- Read-only view for non-admin users -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Sambutan Kepala Desa</h1>
        </div>
        <!-- ... rest of the read-only display code ... -->
    @endif
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview_image');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        preview.src = "{{ asset('images/placeholder.jpg') }}";
    }
}

function openEditModal(id) {
    fetch(`/cms/sambutan/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_nama').value = data.nama;
            document.getElementById('edit_jabatan').value = data.jabatan;
            document.getElementById('edit_sambutan').value = data.sambutan;
            document.getElementById('edit_periode').value = data.periode;
            document.getElementById('imagePreview').src = `/images/${data.image}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function openSliderModal() {
    document.getElementById('sliderModalTitle').textContent = 'Add New Slider';
    document.getElementById('sliderForm').reset();
    document.getElementById('slider_id').value = '';
    document.getElementById('preview_image').src = "{{ asset('images/placeholder.jpg') }}";
    document.getElementById('sliderModal').classList.remove('hidden');
    document.getElementById('sliderModal').classList.add('flex');
}

function closeSliderModal() {
    document.getElementById('sliderModal').classList.add('hidden');
    document.getElementById('sliderModal').classList.remove('flex');
}

function editSlider(id) {
    document.getElementById('sliderModalTitle').textContent = 'Edit Slider';
    fetch(`/cms/sliders/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('slider_id').value = data.id;
            document.getElementById('slider_heading').value = data.heading;
            document.getElementById('slider_subheading').value = data.subheading;
            document.getElementById('slider_tagline').value = data.tagline;
            document.getElementById('slider_order').value = data.order;
            document.getElementById('slider_is_active').checked = data.is_active;
            document.getElementById('preview_image').src = `/images/${data.background_image}`;
            document.getElementById('sliderModal').classList.remove('hidden');
            document.getElementById('sliderModal').classList.add('flex');
        });
}

function deleteSlider(id) {
    if (confirm('Are you sure you want to delete this slider?')) {
        fetch(`/cms/sliders/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

// Form submit handler
document.getElementById('sliderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const sliderId = document.getElementById('slider_id').value;
    
    // Tentukan URL dan method berdasarkan ada tidaknya slider_id
    const url = sliderId ? `/cms/sliders/${sliderId}` : '/cms/sliders';
    const method = sliderId ? 'POST' : 'POST'; // Gunakan POST untuk keduanya
    
    if (!formData.has('is_active')) {
        formData.append('is_active', '0');
    }

    // Jika update, tambahkan _method field
    if (sliderId) {
        formData.append('_method', 'PUT'); // Untuk method spoofing di Laravel
    }

    fetch(url, {
        method: 'POST', // Selalu gunakan POST, Laravel akan menangani method spoofing
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(sliderId ? 'Slider berhasil diupdate' : 'Slider berhasil ditambahkan');
            location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan slider');
    });
});
</script>
@endsection
