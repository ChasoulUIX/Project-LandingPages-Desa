@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Pendanaan Desa</h1>
        <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Kegiatan
        </button>
    </div>

    <!-- Replace Kegiatan Grid with Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm md:text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggaran</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan as $item)
                    <tr class="text-gray-700" data-id="{{ $item->id }}">
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->judul }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ Str::limit($item->deskripsi, 100) }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->kategori }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">Rp {{ number_format($item->anggaran, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->progress }}%</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            {{ $item->tgl_mulai->format('d/m/Y') }} - {{ $item->tgl_selesai->format('d/m/Y') }}
                        </td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <button onclick="showPhotosModal(['{{ $item->image }}'])" 
                                    class="text-blue-500 hover:text-blue-700 flex items-center">
                                📷 <span class="ml-1 text-sm">(1)</span>
                            </button>
                        </td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <button onclick="openEditModal({{ $item->id }})" class="text-blue-500 hover:text-blue-700">
                                ✏️
                            </button>
                            <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-2" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            Belum ada kegiatan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-4xl mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Tambah Kegiatan Baru</h3>
                <button onclick="closeAddModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
                            <input type="text" name="judul" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="kategori" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kategori</option>
                                <option value="Infrastruktur">Infrastruktur</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Ekonomi">Ekonomi</option>
                                <option value="Lingkungan">Lingkungan</option>
                                <option value="Pemerintahan">Pemerintahan</option>
                                <option value="Kemasyarakatan">Kemasyarakatan</option>
                                <option value="Keadaan Darurat">Keadaan Darurat</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Anggaran</label>
                            <input type="text" id="anggaran_display" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <input type="hidden" name="anggaran" id="anggaran_actual">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Dana</label>
                            <select name="sumber_dana" id="sumber_dana" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Pilih Sumber Dana</option>
                                @foreach(App\Models\DanaDesa::where('tahun_anggaran', date('Y'))->get() as $dana)
                                    <option value="{{ $dana->id }}" data-nominal="{{ $dana->nominal }}" data-terpakai="{{ $dana->dana_terpakai }}">
                                        {{ $dana->sumber_anggaran }} - Rp {{ number_format($dana->nominal, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            <p id="sisa_dana" class="text-sm text-gray-600 mt-1"></p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Progress (%)</label>
                            <div class="relative">
                                <input type="number" name="progress" min="0" max="100" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2 text-gray-500">%</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                            <input type="file" name="image" required accept="image/*" class="w-full">
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-4xl mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Edit Kegiatan</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
                            <input type="text" name="judul" id="editJudul" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="deskripsi" id="editDeskripsi" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="kategori" id="editKategori" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kategori</option>
                                <option value="Infrastruktur">Infrastruktur</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Ekonomi">Ekonomi</option>
                                <option value="Lingkungan">Lingkungan</option>
                                <option value="Pemerintahan">Pemerintahan</option>
                                <option value="Kemasyarakatan">Kemasyarakatan</option>
                                <option value="Keadaan Darurat">Keadaan Darurat</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Anggaran</label>
                            <input type="text" id="editAnggaran_display" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <input type="hidden" name="anggaran" id="editAnggaran_actual">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Dana</label>
                            <select name="sumber_dana" id="editSumber_dana" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Pilih Sumber Dana</option>
                                @foreach(App\Models\DanaDesa::where('tahun_anggaran', date('Y'))->get() as $dana)
                                    <option value="{{ $dana->id }}" data-nominal="{{ $dana->nominal }}" data-terpakai="{{ $dana->dana_terpakai }}">
                                        {{ $dana->sumber_anggaran }} - Rp {{ number_format($dana->nominal, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            <p id="editSisa_dana" class="text-sm text-gray-600 mt-1"></p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" id="editTglMulai" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" id="editTglSelesai" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Progress (%)</label>
                            <div class="relative">
                                <input type="number" name="progress" id="editProgress" min="0" max="100" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <span class="absolute right-3 top-2 text-gray-500">%</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Baru (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full">
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Update Kegiatan
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
    document.getElementById('addModal').classList.add('hidden');
    document.getElementById('addModal').classList.remove('flex');
}

function openEditModal(id) {
    fetch(`/cms/kegiatan/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editJudul').value = data.judul;
            document.getElementById('editDeskripsi').value = data.deskripsi;
            document.getElementById('editKategori').value = data.kategori;
            document.getElementById('editAnggaran_display').value = new Intl.NumberFormat('id-ID').format(data.anggaran);
            document.getElementById('editAnggaran_actual').value = data.anggaran;
            document.getElementById('editSumber_dana').value = data.sumber_dana;
            document.getElementById('editTglMulai').value = data.tgl_mulai;
            document.getElementById('editTglSelesai').value = data.tgl_selesai;
            document.getElementById('editProgress').value = data.progress;
            document.getElementById('editForm').action = `/cms/kegiatan/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
            
            // Update sisa dana display
            checkEditAvailableFunds();
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

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
                     alt="Kegiatan Photo">
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

document.addEventListener('DOMContentLoaded', function() {
    const anggaranDisplay = document.getElementById('anggaran_display');
    const anggaranActual = document.getElementById('anggaran_actual');
    const sumberDana = document.getElementById('sumber_dana');
    const sisaDana = document.getElementById('sisa_dana');

    // Format currency input
    anggaranDisplay.addEventListener('input', function(e) {
        // Remove non-numeric characters
        let value = this.value.replace(/\D/g, '');
        
        // Format the number with thousand separator
        const formattedValue = new Intl.NumberFormat('id-ID').format(value);
        this.value = formattedValue;
        
        // Store the raw number in hidden input (convert to decimal format)
        anggaranActual.value = (parseFloat(value) || 0).toFixed(2);
        
        // Check available funds
        checkAvailableFunds();
    });

    sumberDana.addEventListener('change', checkAvailableFunds);

    function checkAvailableFunds() {
        const selectedOption = sumberDana.options[sumberDana.selectedIndex];
        if (selectedOption.value) {
            const nominal = parseInt(selectedOption.dataset.nominal);
            const terpakai = parseInt(selectedOption.dataset.terpakai) || 0;
            const anggaran = parseFloat(anggaranActual.value) || 0;
            const sisaAnggaran = nominal - terpakai;
            
            sisaDana.textContent = `Sisa dana: Rp ${new Intl.NumberFormat('id-ID').format(sisaAnggaran)}`;

            if (anggaran > sisaAnggaran) {
                alert('Anggaran melebihi sisa dana yang tersedia!');
                anggaranDisplay.value = '';
                anggaranActual.value = '';
            }
        }
    }

    // Edit form currency formatting
    const editAnggaranDisplay = document.getElementById('editAnggaran_display');
    const editAnggaranActual = document.getElementById('editAnggaran_actual');
    const editSumberDana = document.getElementById('editSumber_dana');
    const editSisaDana = document.getElementById('editSisa_dana');

    editAnggaranDisplay.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, '');
        const formattedValue = new Intl.NumberFormat('id-ID').format(value);
        this.value = formattedValue;
        editAnggaranActual.value = value;
        checkEditAvailableFunds();
    });

    editSumberDana.addEventListener('change', checkEditAvailableFunds);

    function checkEditAvailableFunds() {
        const selectedOption = editSumberDana.options[editSumberDana.selectedIndex];
        if (selectedOption.value) {
            const nominal = parseInt(selectedOption.dataset.nominal);
            const terpakai = parseInt(selectedOption.dataset.terpakai) || 0;
            const anggaran = parseFloat(editAnggaranActual.value) || 0;
            const sisaAnggaran = nominal - terpakai;
            
            editSisaDana.textContent = `Sisa dana: Rp ${new Intl.NumberFormat('id-ID').format(sisaAnggaran)}`;

            if (anggaran > sisaAnggaran) {
                alert('Anggaran melebihi sisa dana yang tersedia!');
                editAnggaranDisplay.value = '';
                editAnggaranActual.value = '';
            }
        }
    }
});
</script>
@endsection
