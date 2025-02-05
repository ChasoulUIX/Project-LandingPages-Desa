@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Dana Desa</h1>
        <div class="flex gap-4">
            <!-- Tahun Filter -->
            <select id="tahunFilter" class="border rounded-lg px-4 py-2">
                @for($year = date('Y'); $year >= 2020; $year--)
                    <option value="{{ $year }}" {{ request('tahun', date('Y')) == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endfor
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

    <!-- Data Grid -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm md:text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sumber Anggaran</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pencairan</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dana Masuk</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dana Terpakai</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($danaDesa as $dana)
                    <tr class="text-gray-700" data-id="{{ $dana->id }}">
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $dana->tahun_anggaran }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $dana->sumber_anggaran }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">Rp {{ number_format($dana->nominal, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $dana->tgl_pencairan->format('d/m/Y') }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <div class="relative pt-1">
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                    <div style="width: {{ $dana->status_pencairan }}%" 
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                    </div>
                                </div>
                                <div class="text-xs mt-1">{{ $dana->status_pencairan }}%</div>
                            </div>
                        </td>
                        <td class="px-3 py-2 md:px-6 md:py-4">Rp {{ number_format($dana->dana_masuk, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">Rp {{ number_format($dana->dana_terpakai, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <button onclick="openEditModal({{ $dana->id }})" class="text-blue-500 hover:text-blue-700">
                                ✏️
                            </button>
                            <button onclick="deleteData({{ $dana->id }})" class="text-red-500 hover:text-red-700 ml-2">
                                🗑️
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data dana desa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 flex items-center justify-center">
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
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
});
document.getElementById('editDanaMasuk').addEventListener('input', function() {
    formatRupiah(this);
});
document.getElementById('editDanaTerpakai').addEventListener('input', function() {
    formatRupiah(this);
});

// Add event listener for status pencairan input
document.getElementById('editStatusPencairan').addEventListener('input', function() {
    const value = Math.min(Math.max(this.value, 0), 100); // Clamp between 0 and 100
    this.value = value;
    document.getElementById('editStatusBar').style.width = `${value}%`;
});

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Update form submission untuk handle format Rupiah
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Convert Rupiah format back to number before sending
    const nominalInput = document.getElementById('editNominal');
    const danaMasukInput = document.getElementById('editDanaMasuk');
    const danaTerpakaiInput = document.getElementById('editDanaTerpakai');

    formData.set('nominal', nominalInput.value.replace(/[^\d]/g, ''));
    formData.set('dana_masuk', danaMasukInput.value.replace(/[^\d]/g, ''));
    formData.set('dana_terpakai', danaTerpakaiInput.value.replace(/[^\d]/g, ''));
    
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
    window.location.href = '{{ route("dana.index") }}?tahun=' + this.value;
});
</script>
@endpush
