@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Produk UMKM Desa</h1>
        <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Produk
        </button>
    </div>

    <!-- Replace Produk Grid with Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm md:text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. WA</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($produk->count() > 0)
                        @foreach($produk as $item)
                            <tr class="text-gray-700" data-id="{{ $item->id }}">
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    <button onclick="showPhotosModal(['{{ $item->image }}'])" 
                                            class="text-blue-500 hover:text-blue-700 flex items-center">
                                        📷 <span class="ml-1 text-sm">(1)</span>
                                    </button>
                                </td>
                                <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->nama }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->no_wa }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">{{ Str::limit($item->deskripsi, 100) }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    <button onclick="openEditModal({{ $item->id }})" class="text-blue-600 hover:text-blue-800 mr-3 text-lg">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('cms.produk.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-lg" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <div class="flex flex-col items-center justify-center py-12">
                                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Shopping%20Bags.png" 
                                         alt="No Data" 
                                         class="w-64 h-64 mb-6"
                                    >
                                    <h3 class="text-xl font-medium text-gray-600 mb-2">Belum Ada Produk</h3>
                                    <p class="text-gray-500">Silakan tambah produk UMKM baru dengan klik tombol di atas</p>
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
        <div class="bg-white rounded-lg w-full max-w-4xl mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Tambah Produk Baru</h3>
                <button onclick="closeAddModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('cms.produk.store') }}" method="POST" enctype="multipart/form-data" class="p-6" autocomplete="off">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                                Nama Produk
                            </label>
                            <input type="text" name="nama" id="nama" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="no_wa">
                                No. WA
                            </label>
                            <input type="text" name="no_wa" id="no_wa" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="harga">
                                Harga
                            </label>
                            <input type="number" name="harga" id="harga" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="deskripsi">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                Gambar Produk
                            </label>
                            <input type="file" name="image" id="image" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="image/*" onchange="previewImage(this, 'imagePreview')" required>
                            <div id="imagePreview" class="mt-4 hidden">
                                <img src="" alt="Preview" class="max-w-full h-64 object-contain rounded-lg border">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-4xl mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Edit Produk</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_nama">
                                Nama Produk
                            </label>
                            <input type="text" name="nama" id="edit_nama" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_no_wa">
                                No. WA
                            </label>
                            <input type="text" name="no_wa" id="edit_no_wa" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_harga">
                                Harga
                            </label>
                            <input type="number" name="harga" id="edit_harga" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_deskripsi">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" id="edit_deskripsi" rows="4" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_image">
                                Gambar Produk
                            </label>
                            <input type="file" name="image" id="edit_image" autocomplete="off" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="image/*" onchange="previewImage(this, 'editImagePreview')">
                            <div id="editImagePreview" class="mt-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar Saat Ini:</p>
                                <img src="" alt="Preview" class="max-w-full h-64 object-contain rounded-lg border">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Photos Modal -->
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
}

function closeAddModal() {
    document.getElementById('addModal').classList.remove('flex');
    document.getElementById('addModal').classList.add('hidden');
}

function openEditModal(id) {
    // Show modal
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Set form action URL
    const form = document.getElementById('editForm');
    form.action = `/cms/produk/${id}`;
    
    // Fetch data
    fetch(`/cms/produk/${id}/edit`)
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                const data = result.data;
                document.getElementById('edit_nama').value = data.nama || '';
                document.getElementById('edit_no_wa').value = data.no_wa || '';
                document.getElementById('edit_deskripsi').value = data.deskripsi || '';
                document.getElementById('edit_harga').value = data.harga || '';
                
                // Update image preview
                if (data.image) {
                    const previewImg = document.querySelector('#editImagePreview img');
                    previewImg.src = `/images/${data.image}`;
                    document.getElementById('editImagePreview').classList.remove('hidden');
                }
            } else {
                throw new Error(result.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data produk');
            closeEditModal();
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('flex');
    document.getElementById('editModal').classList.add('hidden');
}

// Add these new functions for photo modal
function showPhotosModal(photos) {
    const modal = document.getElementById('photosModal');
    const container = document.getElementById('photosContainer');
    
    // Clear previous photos
    container.innerHTML = '';
    
    // Add photos to the modal
    photos.forEach(photo => {
        const photoDiv = document.createElement('div');
        photoDiv.className = 'relative pt-[100%]';
        photoDiv.innerHTML = `
            <div class="absolute inset-0 p-1">
                <img src="/images/${photo}" 
                     class="w-full h-full rounded-lg cursor-pointer hover:opacity-75 transition-opacity object-contain bg-gray-100"
                     onclick="window.open('/images/${photo}', '_blank')"
                     alt="Produk Photo">
            </div>
        `;
        container.appendChild(photoDiv);
    });
    
    // Show modal
    modal.classList.remove('hidden');
}

function closePhotosModal() {
    document.getElementById('photosModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('photosModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePhotosModal();
    }
});

// Add this new function for image preview
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const previewImg = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
