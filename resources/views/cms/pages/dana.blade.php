@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Manajemen Dana Desa</h1>
        <button type="button" onclick="toggleModal('addModal')" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </button>
    </div>

    <!-- Overview Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-4">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-4 font-semibold text-gray-600">Total Dana Desa</h4>
            <p class="text-gray-800 text-2xl font-bold">Rp {{ number_format(\App\Models\DanaDesa::sum('anggaran'), 0, ',', '.') }}</p>
            <p class="text-sm text-gray-600">Tahun Anggaran 2024</p>
        </div>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-4 font-semibold text-gray-600">Dana Terserap</h4>
            @php
                $totalAnggaran = \App\Models\DanaDesa::sum('anggaran');
                $terserap = \App\Models\DanaDesa::all()->sum(function($program) {
                    return ($program->anggaran * $program->progress) / 100;
                });
                $persentase = $totalAnggaran > 0 ? ($terserap / $totalAnggaran) * 100 : 0;
            @endphp
            <p class="text-gray-800 text-2xl font-bold">{{ number_format($persentase, 1) }}%</p>
            <p class="text-sm text-gray-600">Rp {{ number_format($terserap, 0, ',', '.') }}</p>
        </div>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-4 font-semibold text-gray-600">Sisa Anggaran</h4>
            @php
                $sisa = $totalAnggaran - $terserap;
                $persentaseSisa = $totalAnggaran > 0 ? ($sisa / $totalAnggaran) * 100 : 0;
            @endphp
            <p class="text-gray-800 text-2xl font-bold">{{ number_format($persentaseSisa, 1) }}%</p>
            <p class="text-sm text-gray-600">Rp {{ number_format($sisa, 0, ',', '.') }}</p>
        </div>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-4 font-semibold text-gray-600">Total Program</h4>
            <p class="text-gray-800 text-2xl font-bold">{{ $totalPrograms }}</p>
            <p class="text-sm text-gray-600">Program Aktif</p>
        </div>
    </div>

    <!-- Data Grid -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\DanaDesa::all() as $program)
                    <tr class="text-gray-700">
                        <td class="px-6 py-4">{{ $program->nama_program }}</td>
                        <td class="px-6 py-4">{{ $program->kategori }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($program->anggaran, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <div class="relative pt-1">
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                    <div style="width: {{ $program->progress }}%" 
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center {{ $program->progress < 50 ? 'bg-red-500' : ($program->progress < 75 ? 'bg-yellow-500' : 'bg-green-500') }}">
                                    </div>
                                </div>
                                <div class="text-xs mt-1">{{ $program->progress }}%</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $program->status === 'Selesai' ? 'text-green-700 bg-green-100' : ($program->status === 'Berjalan' ? 'text-yellow-700 bg-yellow-100' : 'text-gray-700 bg-gray-100') }}">
                                {{ $program->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $program->target }}</td>
                        <td class="px-6 py-4">
                            <button onclick="openEditModal({{ $program->id }})" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('dana.destroy', $program->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="text-red-500 hover:text-red-700 ml-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50" style="display: block;">
        <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg mt-20">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-2xl font-bold text-gray-900">Tambah Program Dana Desa</h3>
                <button type="button" onclick="toggleModal('addModal')" class="text-black close-modal">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
            <form action="{{ route('dana.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Program</label>
                        <input type="text" name="nama_program" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Infrastruktur">Infrastruktur</option>
                            <option value="Pemberdayaan Masyarakat">Pemberdayaan Masyarakat</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Ekonomi">Ekonomi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Anggaran</label>
                        <input type="number" name="anggaran" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Progress (%)</label>
                        <input type="number" name="progress" min="0" max="100" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Target</label>
                        <input type="text" name="target" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                            <option value="">Pilih Status</option>
                            <option value="Dalam Perencanaan">Dalam Perencanaan</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="mt-8">
                    <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-3 px-4 hover:bg-blue-700 transition duration-300 font-semibold">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" style="display: none;">
        <div class="bg-white rounded-xl w-full max-w-md mx-4 shadow-2xl">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-2xl font-bold text-gray-900">Edit Program Dana Desa</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800 transition duration-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Program</label>
                        <input type="text" name="nama_program" id="editNamaProgram" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" id="editKategori" class="w-full p-2 border rounded" required>
                            <option value="Infrastruktur">Infrastruktur</option>
                            <option value="Pemberdayaan Masyarakat">Pemberdayaan Masyarakat</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Ekonomi">Ekonomi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Anggaran</label>
                        <input type="number" name="anggaran" id="editAnggaran" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Progress (%)</label>
                        <input type="number" name="progress" id="editProgress" min="0" max="100" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Target</label>
                        <input type="text" name="target" id="editTarget" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="editStatus" class="w-full p-2 border rounded" required>
                            <option value="Dalam Perencanaan">Dalam Perencanaan</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            console.log('Toggling modal:', modalId);
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        }
    }

    // Tambahkan event listener untuk menutup modal saat mengklik di luar
    window.onclick = function(event) {
        const modal = document.getElementById('addModal');
        if (modal && event.target === modal) {
            modal.style.display = 'none';
        }
    }

    // Edit modal functions
    function openEditModal(id) {
        fetch(`/cms/dana/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editNamaProgram').value = data.nama_program;
                document.getElementById('editKategori').value = data.kategori;
                document.getElementById('editAnggaran').value = data.anggaran;
                document.getElementById('editProgress').value = data.progress;
                document.getElementById('editTarget').value = data.target;
                document.getElementById('editStatus').value = data.status;
                document.getElementById('editForm').action = `/cms/dana/${id}`;
                toggleModal('editModal');
            });
    }
</script>
@endpush

@endsection
