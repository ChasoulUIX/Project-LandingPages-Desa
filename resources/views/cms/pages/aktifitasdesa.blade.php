@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Aktivitas Desa</h1>
        <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Aktivitas
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm md:text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kegiatan</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($aktifitas->count() > 0)
                        @foreach($aktifitas as $item)
                            <tr class="text-gray-700" data-id="{{ $item->id }}">
                                <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->judul }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">{{ Str::limit($item->deskripsi, 100) }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->tgl_mulai->format('d/m/Y') }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    <button onclick="showPhotosModal(['{{ $item->image }}'])" 
                                            class="text-blue-500 hover:text-blue-700 flex items-center">
                                        📷 <span class="ml-1 text-sm">(1)</span>
                                    </button>
                                </td>
                                <td class="px-3 py-2 md:px-6 md:py-3">
                                    <div class="flex items-center justify-start space-x-3">
                                        <button onclick="openEditModal({{ $item->id }})" class="text-blue-600 hover:text-blue-800 mr-3 text-lg">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('cms.aktifitasdesa.destroy', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus aktivitas ini?')" class="text-red-600 hover:text-red-800 text-lg">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <div class="flex flex-col items-center justify-center py-12">
                                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Spiral%20Calendar.png" 
                                         alt="No Data" 
                                         class="w-64 h-64 mb-6"
                                    >
                                    <h3 class="text-xl font-medium text-gray-600 mb-2">Belum Ada Aktivitas</h3>
                                    <p class="text-gray-500">Silakan tambah aktivitas baru dengan klik tombol di atas</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Tambah Aktivitas Baru</h3>
                <button onclick="closeAddModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('cms.aktifitasdesa.store') }}" method="POST" enctype="multipart/form-data" class="p-6" autocomplete="off" id="addForm">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
                        <input type="text" name="judul" autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-red-500 text-sm mt-1 hidden error-message" id="judul-error"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <p class="text-red-500 text-sm mt-1 hidden error-message" id="deskripsi-error"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="image" accept="image/*" autocomplete="off" class="w-full">
                        <p class="text-red-500 text-sm mt-1 hidden error-message" id="image-error"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tgl_mulai" autocomplete="off" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-red-500 text-sm mt-1 hidden error-message" id="tgl_mulai-error"></p>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Simpan Aktivitas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-4xl mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Edit Aktivitas</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
                            <input type="text" name="judul" id="editJudul" autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-red-500 text-sm mt-1 hidden error-message" id="edit-judul-error"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="deskripsi" id="editDeskripsi" rows="8" autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            <p class="text-red-500 text-sm mt-1 hidden error-message" id="edit-deskripsi-error"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                            <input type="date" name="tgl_mulai" id="editTanggal" autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-red-500 text-sm mt-1 hidden error-message" id="edit-tgl_mulai-error"></p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                            <div class="mb-4">
                                <img id="currentImage" src="" alt="Current Image" class="w-full h-64 object-contain bg-gray-100 rounded-lg">
                            </div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Baru (Opsional)</label>
                            <input type="file" name="image" accept="image/*" autocomplete="off" class="w-full">
                        </div>
                    </div>
                </div>

                <!-- Submit Button - Full Width -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Update Aktivitas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Photos Modal -->
    <div id="photosModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Photos</h3>
                <button onclick="closePhotosModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="photosContainer" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Photos will be inserted here -->
            </div>
        </div>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
    document.getElementById('addModal').classList.add('flex');
    
    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="tgl_mulai"]').value = today;
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
    document.getElementById('addModal').classList.remove('flex');
}

function openEditModal(id) {
    fetch(`/cms/aktifitas/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editJudul').value = data.judul;
            document.getElementById('editDeskripsi').value = data.deskripsi;
            const date = new Date(data.tgl_mulai);
            const formattedDate = date.toISOString().split('T')[0];
            document.getElementById('editTanggal').value = formattedDate;
            document.getElementById('currentImage').src = `/images/${data.image}`;
            document.getElementById('editForm').action = `/cms/aktifitas/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function showPhotosModal(photos) {
    const modal = document.getElementById('photosModal');
    const container = document.getElementById('photosContainer');
    
    container.innerHTML = '';
    
    photos.forEach(photo => {
        const photoDiv = document.createElement('div');
        photoDiv.className = 'relative pt-[100%]';
        photoDiv.innerHTML = `
            <div class="absolute inset-0 p-1">
                <img src="/images/${photo}" 
                     class="w-full h-full rounded-lg cursor-pointer hover:opacity-75 transition-opacity object-contain bg-gray-100"
                     onclick="window.open('/images/${photo}', '_blank')"
                     alt="Aktivitas Photo">
            </div>
        `;
        container.appendChild(photoDiv);
    });
    
    modal.classList.remove('hidden');
}

function closePhotosModal() {
    document.getElementById('photosModal').classList.add('hidden');
}

document.getElementById('photosModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePhotosModal();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Form validation for Add Modal
    const addForm = document.getElementById('addForm');
    addForm.addEventListener('submit', function(e) {
        e.preventDefault();
        clearErrors();
        
        let hasError = false;
        const fields = [
            { name: 'judul', label: 'Nama Kegiatan' },
            { name: 'deskripsi', label: 'Deskripsi' },
            { name: 'image', label: 'Gambar' },
            { name: 'tgl_mulai', label: 'Tanggal' }
        ];

        fields.forEach(field => {
            const input = addForm.querySelector(`[name="${field.name}"]`);
            if (!input.value) {
                showError(field.name, `${field.label} harus diisi`);
                hasError = true;
            }
        });

        if (!hasError) {
            this.submit();
        }
    });

    // Form validation for Edit Modal
    const editForm = document.getElementById('editForm');
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        clearErrors();
        
        let hasError = false;
        const fields = [
            { name: 'judul', label: 'Nama Kegiatan' },
            { name: 'deskripsi', label: 'Deskripsi' },
            { name: 'tgl_mulai', label: 'Tanggal' }
        ];

        fields.forEach(field => {
            const input = editForm.querySelector(`[name="${field.name}"]`);
            if (!input.value) {
                showError(field.name, `${field.label} harus diisi`, 'edit-');
                hasError = true;
            }
        });

        if (!hasError) {
            this.submit();
        }
    });

    function showError(fieldName, message, prefix = '') {
        const errorElement = document.getElementById(`${prefix}${fieldName}-error`);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
            
            // Add red border to input
            const input = document.querySelector(`[name="${fieldName}"]`);
            if (input) {
                input.classList.add('border-red-500');
            }
        }
    }

    function clearErrors() {
        // Clear all error messages
        document.querySelectorAll('.error-message').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        
        // Remove red borders
        document.querySelectorAll('input, select, textarea').forEach(el => {
            el.classList.remove('border-red-500');
        });
    }
});
</script>
@endsection
