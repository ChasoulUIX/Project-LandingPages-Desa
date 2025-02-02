@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Manajemen Dana Desa</h1>
        <a href="{{ route('dana.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </a>
    </div>

    <!-- Overview Cards -->
    <div class="grid gap-4 mb-6 grid-cols-2 md:grid-cols-4 md:gap-6 md:mb-8">
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Total Dana Desa</h4>
            <p class="text-gray-800 text-xl md:text-2xl font-bold">Rp {{ number_format(\App\Models\DanaDesa::sum('anggaran'), 0, ',', '.') }}</p>
            <p class="text-xs md:text-sm text-gray-600">Tahun Anggaran 2024</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Dana Terserap</h4>
            @php
                $totalAnggaran = \App\Models\DanaDesa::sum('anggaran');
                $terserap = \App\Models\DanaDesa::all()->sum(function($program) {
                    return ($program->anggaran * $program->progress) / 100;
                });
                $persentase = $totalAnggaran > 0 ? ($terserap / $totalAnggaran) * 100 : 0;
            @endphp
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ number_format($persentase, 1) }}%</p>
            <p class="text-xs md:text-sm text-gray-600">Rp {{ number_format($terserap, 0, ',', '.') }}</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Sisa Anggaran</h4>
            @php
                $sisa = $totalAnggaran - $terserap;
                $persentaseSisa = $totalAnggaran > 0 ? ($sisa / $totalAnggaran) * 100 : 0;
            @endphp
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ number_format($persentaseSisa, 1) }}%</p>
            <p class="text-xs md:text-sm text-gray-600">Rp {{ number_format($sisa, 0, ',', '.') }}</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Total Program</h4>
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ $totalPrograms }}</p>
            <p class="text-xs md:text-sm text-gray-600">Program Aktif</p>
        </div>
    </div>

    <!-- Data Grid -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm md:text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggaran</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\DanaDesa::all() as $program)
                    <tr class="text-gray-700">
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $program->nama_program }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $program->kategori }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">Rp {{ number_format($program->anggaran, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <div class="relative pt-1">
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                    <div style="width: {{ $program->progress }}%" 
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center {{ $program->progress < 50 ? 'bg-red-500' : ($program->progress < 75 ? 'bg-yellow-500' : 'bg-green-500') }}">
                                    </div>
                                </div>
                                <div class="text-xs mt-1">{{ $program->progress }}%</div>
                            </div>
                        </td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $program->status === 'Selesai' ? 'text-green-700 bg-green-100' : ($program->status === 'Berjalan' ? 'text-yellow-700 bg-yellow-100' : 'text-gray-700 bg-gray-100') }}">
                                {{ $program->status }}
                            </span>
                        </td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $program->target }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <button onclick="openEditModal({{ $program->id }}, '{{ $program->nama_program }}', '{{ $program->kategori }}', {{ $program->anggaran }}, {{ $program->progress }}, '{{ $program->target }}', '{{ $program->status }}')" 
                                    class="text-blue-500 hover:text-blue-700">
                                ✏️
                            </button>
                            <button onclick="deleteData({{ $program->id }})" class="text-red-500 hover:text-red-700 ml-2">
                                🗑️
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data program dana desa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Edit Program Dana Desa</h2>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Program</label>
                        <input type="text" id="editNama" name="nama_program" class="w-full px-3 py-2 border rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="editKategori" name="kategori" class="w-full px-3 py-2 border rounded-md">
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Infrastruktur">Infrastruktur</option>
                            <option value="Pemberdayaan Masyarakat">Pemberdayaan Masyarakat</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Anggaran</label>
                        <input type="text" id="editAnggaran" name="anggaran" class="w-full px-3 py-2 border rounded-md" 
                               oninput="formatRupiah(this)" placeholder="Rp 0">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Progress (%)</label>
                        <input type="number" id="editProgress" name="progress" class="w-full px-3 py-2 border rounded-md" min="0" max="100">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Target</label>
                        <input type="text" id="editTarget" name="target" class="w-full px-3 py-2 border rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="editStatus" name="status" class="w-full px-3 py-2 border rounded-md">
                            <option value="Belum Dimulai">Belum Dimulai</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Simpan
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

function openEditModal(id, nama, kategori, anggaran, progress, target, status) {
    // Set form action
    const form = document.getElementById('editForm');
    form.action = `/cms/dana/${id}`;
    
    // Set form values
    document.getElementById('editId').value = id;
    document.getElementById('editNama').value = nama;
    document.getElementById('editKategori').value = kategori;
    // Format anggaran saat modal dibuka
    const formattedAnggaran = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(anggaran).replace('IDR', 'Rp').trim();
    document.getElementById('editAnggaran').value = formattedAnggaran;
    document.getElementById('editProgress').value = progress;
    document.getElementById('editTarget').value = target;
    document.getElementById('editStatus').value = status;
    
    // Show modal
    document.getElementById('editModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Update form submission untuk handle format Rupiah
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Convert Rupiah format back to number before sending
    const anggaranInput = document.getElementById('editAnggaran');
    const anggaranValue = anggaranInput.value.replace(/[^\d]/g, '');
    formData.set('anggaran', anggaranValue);
    
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
</script>
@endpush
