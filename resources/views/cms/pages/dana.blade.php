@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Dana Desa</h1>
        <div class="flex gap-4">
            <!-- Tahun Filter -->
            <select id="tahunFilter" class="border rounded-lg px-4 py-2">
                @foreach(App\Models\DanaDesa::select('tahun_anggaran')->distinct()->orderBy('tahun_anggaran', 'desc')->get() as $year)
                    <option value="{{ $year->tahun_anggaran }}" {{ request('tahun', date('Y')) == $year->tahun_anggaran ? 'selected' : '' }}>
                        {{ $year->tahun_anggaran }}
                    </option>
                @endforeach
            </select>
            <a href="{{ route('dana.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Dana
            </a>
        </div>
    </div>

    <!-- Overview Cards -->
    <div class="grid gap-4 mb-6 grid-cols-2 md:grid-cols-4 md:gap-6 md:mb-8">
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Total Dana Desa</h4>
            <p class="text-gray-800 text-xl md:text-2xl font-bold">Rp {{ number_format($totalDana, 0, ',', '.') }}</p>
            <p class="text-xs md:text-sm text-gray-600">Tahun Anggaran {{ request('tahun', date('Y')) }}</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Dana Masuk</h4>
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ number_format($persentaseMasuk, 1) }}%</p>
            <p class="text-xs md:text-sm text-gray-600">Rp {{ number_format($totalDanaMasuk, 0, ',', '.') }}</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Dana Terpakai</h4>
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ number_format($persentaseTerpakai, 1) }}%</p>
            <p class="text-xs md:text-sm text-gray-600">Rp {{ number_format($totalDanaTerpakai, 0, ',', '.') }}</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Sisa Dana</h4>
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ number_format($persentaseSisa, 1) }}%</p>
            <p class="text-xs md:text-sm text-gray-600">Rp {{ number_format($sisaDana, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 relative">
        <!-- Left Column - Dana Table -->
        <div id="tableSection" class="lg:col-span-3">
            <!-- Data Grid -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <!-- <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tahun</th> -->
                                <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Sumber Anggaran</th>
                                <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Nominal</th>
                                <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Tgl Pencairan</th>
                                <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Status</th>
                                <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Dana Masuk</th>
                                <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Dana Terpakai</th>
                                <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Foto</th>
                                <th class="px-2 py-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($danaDesa->count() > 0)
                                @foreach($danaDesa as $dana)
                                <tr class="text-gray-700 hover:bg-gray-50" data-id="{{ $dana->id }}">
                                    <!-- <td class="px-2 py-2 whitespace-nowrap">{{ $dana->tahun_anggaran }}</td> -->
                                    <td class="px-2 py-2 whitespace-nowrap">{{ $dana->sumber_anggaran }}</td>
                                    <td class="px-2 py-2 whitespace-nowrap">Rp {{ number_format($dana->nominal, 0, ',', '.') }}</td>
                                    <td class="px-2 py-2 whitespace-nowrap">{{ $dana->tgl_pencairan->format('d/m/Y') }}</td>
                                    <td class="px-2 py-2 whitespace-nowrap">
                                        <div class="relative pt-1">
                                            <div class="overflow-hidden h-1.5 text-sm flex rounded bg-blue-200">
                                                <div style="width: {{ $dana->status_pencairan }}%" 
                                                     class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                                </div>
                                            </div>
                                            <div class="text-sm">{{ $dana->status_pencairan }}%</div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap">Rp {{ number_format($dana->dana_masuk, 0, ',', '.') }}</td>
                                    <td class="px-2 py-2 whitespace-nowrap">Rp {{ number_format($dana->dana_terpakai, 0, ',', '.') }}</td>
                                    <td class="px-2 py-2 whitespace-nowrap">
                                        @if($dana->photos && count($dana->photos) > 0)
                                            <button onclick="showPhotosModal({{ json_encode($dana->photos) }})" 
                                                    class="text-blue-500 hover:text-blue-700 flex items-center">
                                                📷 <span class="ml-1">({{ count($dana->photos) }})</span>
                                            </button>
                                        @else
                                            <span class="text-gray-400">📷</span>
                                        @endif
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <button onclick="openEditModal({{ $dana->id }})" 
                                                    class="text-blue-500 hover:text-blue-700">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button onclick="deleteData({{ $dana->id }})" 
                                                    class="text-red-500 hover:text-red-700">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">
                                        <div class="flex flex-col items-center justify-center py-12">
                                            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Money%20Bag.png" 
                                                 alt="No Data" 
                                                 class="w-64 h-64 mb-6"
                                            >
                                            <h3 class="text-xl font-medium text-gray-600 mb-2">Data Kosong</h3>
                                            <p class="text-gray-500">Belum ada data dana desa yang tercatat</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Toggle Button -->
        <button id="toggleBtn" onclick="toggleKegiatan()" class="hidden lg:flex absolute -right-3 top-1/2 transform -translate-y-1/2 bg-white shadow-md rounded-full w-6 h-24 items-center justify-center hover:bg-gray-50 focus:outline-none">
            <svg id="toggleIcon" class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Right Column - Kegiatan History -->
        <div id="kegiatanSection" class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Pendanaan</h2>
                
                <!-- Kegiatan List -->
                <div class="space-y-4">
                    @php
                        $selectedYear = request('tahun', date('Y'));
                        $kegiatan = App\Models\Kegiatan::whereYear('tgl_mulai', $selectedYear)
                            ->orderBy('created_at', 'desc')
                            ->get();
                    @endphp
                    @foreach($kegiatan as $item)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-medium text-gray-800">{{ $item->judul }}</h3>
                                    <p class="text-sm text-gray-600">{{ $item->deskripsi }}</p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Anggaran: Rp {{ number_format($item->anggaran, 0, ',', '.') }}
                                    </p>
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ $item->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <div class="mt-2">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" 
                                         style="width: {{ $item->progress }}%">
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">
                                    Progress: {{ $item->progress }}%
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                <div class="mt-4 text-center">
                    <a href="/cms/kegiatan" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-700">
                        Lihat Semua Kegiatan
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 items-center justify-center">
        <div class="relative p-8 border w-full max-w-4xl shadow-xl rounded-lg bg-white">
            <!-- Header -->
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="mt-3">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Dana Desa</h2>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Tahun Anggaran</label>
                            <input type="text" id="editTahun" name="tahun_anggaran" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Sumber Anggaran</label>
                            <input type="text" id="editSumber" name="sumber_anggaran" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Nominal</label>
                            <input type="text" id="editNominal" name="nominal" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   oninput="formatRupiah(this)" placeholder="Rp 0">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Tgl Pencairan</label>
                            <input type="text" id="editTglPencairan" name="tgl_pencairan" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Status Pencairan (%)</label>
                            <div class="flex items-center space-x-4">
                                <input type="number" id="editStatusPencairan" name="status_pencairan" 
                                       min="0" max="100" step="1"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       readonly>
                                <div class="w-32">
                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                        <div id="editStatusBar" style="width: 0%" 
                                             class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Dana Masuk</label>
                            <input type="text" id="editDanaMasuk" name="dana_masuk" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Dana Terpakai</label>
                            <input type="text" id="editDanaTerpakai" name="dana_terpakai" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-8">
                        <button type="button" onclick="closeModal()" 
                                class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 font-medium">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
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
                
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Fungsi untuk format Rupiah
function formatRupiah(input) {
    let value = input.value.replace(/[^\d]/g, ''); // Hapus semua karakter kecuali angka
    if (value === '') {
        input.value = '';
        return;
    }
    
    // Convert to number and format
    const number = parseInt(value, 10);
    const formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(number);
    
    // Update input value (remove 'IDR' prefix and trim)
    input.value = formatted.replace('IDR', 'Rp').trim();
}

function openEditModal(id) {
    // Set form action
    const form = document.getElementById('editForm');
    form.action = `/cms/dana/${id}`;
    
    // Cari baris data berdasarkan ID
    const row = document.querySelector(`tr[data-id="${id}"]`);
    if (!row) {
        console.error('Row not found');
        return;
    }

    // Set form values
    document.getElementById('editId').value = id;
    document.getElementById('editTahun').value = row.cells[0].textContent.trim();
    document.getElementById('editSumber').value = row.cells[1].textContent.trim();
    document.getElementById('editTglPencairan').value = row.cells[3].textContent.trim();
    
    // Handle status pencairan - Get the percentage value directly from the progress bar width
    const statusBar = row.cells[4].querySelector('.bg-blue-500');
    const statusValue = statusBar.style.width.replace('%', '');
    
    // Update both the input and visual progress bar
    const editStatusInput = document.getElementById('editStatusPencairan');
    const editStatusBar = document.getElementById('editStatusBar');
    
    editStatusInput.value = statusValue;
    editStatusBar.style.width = `${statusValue}%`;

    // Format nominal fields
    const nominal = row.cells[2].textContent.replace(/[^\d]/g, '');
    const danaMasuk = row.cells[5].textContent.replace(/[^\d]/g, '');
    const danaTerpakai = row.cells[6].textContent.replace(/[^\d]/g, '');

    document.getElementById('editNominal').value = formatRupiahValue(nominal);
    document.getElementById('editDanaMasuk').value = formatRupiahValue(danaMasuk);
    document.getElementById('editDanaTerpakai').value = formatRupiahValue(danaTerpakai);
    
    // Show modal
    document.getElementById('editModal').classList.remove('hidden');
}

// Helper function to format value to Rupiah
function formatRupiahValue(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(value).replace('IDR', 'Rp').trim();
}

// Add input event listeners for all currency fields
document.getElementById('editNominal').addEventListener('input', function() {
    formatRupiah(this);
    const danaMasuk = document.getElementById('editDanaMasuk').value;
    const status = calculateStatus(this.value, danaMasuk);
    
    // Update status input and progress bar
    document.getElementById('editStatusPencairan').value = status;
    document.getElementById('editStatusBar').style.width = `${status}%`;
});

document.getElementById('editDanaMasuk').addEventListener('input', function() {
    formatRupiah(this);
    const nominal = document.getElementById('editNominal').value;
    const status = calculateStatus(nominal, this.value);
    
    // Update status input and progress bar
    document.getElementById('editStatusPencairan').value = status;
    document.getElementById('editStatusBar').style.width = `${status}%`;
});

// Disable manual input for status pencairan
document.getElementById('editStatusPencairan').readOnly = true;

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Update form submission to handle files
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Convert Rupiah format back to number before sending
    formData.set('nominal', document.getElementById('editNominal').value.replace(/[^\d]/g, ''));
    formData.set('dana_masuk', document.getElementById('editDanaMasuk').value.replace(/[^\d]/g, ''));
    formData.set('dana_terpakai', document.getElementById('editDanaTerpakai').value.replace(/[^\d]/g, ''));
    
    const url = this.action;

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeModal();
            window.location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data');
    });
});

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

function deleteData(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        fetch(`/cms/dana/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || 'Gagal menghapus data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus data');
        });
    }
}

// Add year filter functionality
document.getElementById('tahunFilter').addEventListener('change', function() {
    window.location.href = '/cms/dana?tahun=' + this.value;
});

// Add function to remove photo
function removePhoto(danaId, filename, button) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        fetch(`/cms/dana/${danaId}/remove-photo`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ filename: filename })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.closest('.relative').remove();
            } else {
                alert('Gagal menghapus foto');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus foto');
        });
    }
}

// Add these new functions to your existing scripts
function showPhotosModal(photos) {
    const modal = document.getElementById('photosModal');
    const container = document.getElementById('photosContainer');
    
    // Clear previous photos
    container.innerHTML = '';
    
    // Add photos to the modal
    photos.forEach(photo => {
        const photoDiv = document.createElement('div');
        photoDiv.className = 'relative pt-[100%]'; // Create 1:1 aspect ratio container
        photoDiv.innerHTML = `
            <div class="absolute inset-0 p-1">
                <img src="/images/${photo}" 
                     class="w-full h-full rounded-lg cursor-pointer hover:opacity-75 transition-opacity object-contain bg-gray-100"
                     onclick="window.open('/images/${photo}', '_blank')"
                     alt="Dana Photo">
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

function toggleKegiatan() {
    const tableSection = document.getElementById('tableSection');
    const kegiatanSection = document.getElementById('kegiatanSection');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (kegiatanSection.classList.contains('hidden')) {
        // Show Kegiatan
        kegiatanSection.classList.remove('hidden');
        tableSection.classList.remove('lg:col-span-4');
        tableSection.classList.add('lg:col-span-3');
        toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />';
    } else {
        // Hide Kegiatan
        kegiatanSection.classList.add('hidden');
        tableSection.classList.remove('lg:col-span-3');
        tableSection.classList.add('lg:col-span-4');
        toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />';
    }
}

// Add keyboard shortcut
document.addEventListener('keydown', function(e) {
    // Alt + K to toggle kegiatan
    if (e.altKey && e.key === 'k') {
        toggleKegiatan();
    }
});

// Add this function to automatically calculate status
function calculateStatus(nominal, danaMasuk) {
    // Remove currency formatting and convert to numbers
    const nominalValue = parseInt(nominal.replace(/[^\d]/g, '')) || 0;
    const danaMasukValue = parseInt(danaMasuk.replace(/[^\d]/g, '')) || 0;
    
    // Calculate percentage
    let percentage = 0;
    if (nominalValue > 0) {
        percentage = Math.round((danaMasukValue / nominalValue) * 100);
    }
    
    // Ensure percentage is between 0 and 100
    return Math.min(Math.max(percentage, 0), 100);
}
</script>
@endpush
