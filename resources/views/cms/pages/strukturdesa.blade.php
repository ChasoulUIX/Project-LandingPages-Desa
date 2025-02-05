@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Struktur Desa</h1>
        <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg flex items-center transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i> Tambah Anggota
        </button>
    </div>

    <!-- Struktur Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($strukturs as $struktur)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
            <div class="relative">
                <img src="{{ asset('images/' . $struktur->image) }}" alt="{{ $struktur->nama }}" 
                    class="w-full h-56 object-contain bg-gray-100">
                <div class="absolute top-0 right-0 p-3 flex space-x-2">
                    <button onclick="openEditModal({{ $struktur->id }})" class="bg-white p-2 rounded-full shadow-md text-blue-600 hover:text-blue-800 transition duration-300">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('struktur.destroy', $struktur->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-white p-2 rounded-full shadow-md text-red-600 hover:text-red-800 transition duration-300" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $struktur->nama }}</h3>
                <p class="text-blue-600 font-semibold text-md mb-2">{{ $struktur->jabatan }}</p>
                <p class="text-gray-600 text-sm">Periode: {{ $struktur->periode_mulai }} - {{ $struktur->periode_akhir }}</p>
                <p class="text-gray-600 text-sm">Status: {{ ucfirst($struktur->status) }}</p>
                <p class="text-gray-600 text-sm">NIK: {{ $struktur->nik }}</p>
                <p class="text-gray-600 text-sm">WhatsApp: {{ $struktur->no_wa }}</p>
                <p class="text-gray-600 text-sm">Hak Akses: {{ ucfirst($struktur->akses) }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-4xl mx-4 shadow-2xl transform transition-all">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-2xl font-bold text-gray-900">Tambah Anggota Baru</h3>
                <button onclick="closeAddModal()" class="text-gray-600 hover:text-gray-800 transition duration-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form action="{{ route('struktur.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                            <input type="text" name="nik" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <input type="password" name="password" value="123456" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp</label>
                            <input type="text" name="no_wa" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                            <input type="text" name="nama" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                            <select name="jabatan" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="Kepala Desa">Kepala Desa</option>
                                <option value="Sekretaris Desa">Sekretaris Desa</option>
                                <option value="Bendahara Desa">Bendahara Desa</option>
                                <option value="Kaur Umum">Kaur Umum</option>
                                <option value="Kaur Keuangan">Kaur Keuangan</option>
                                <option value="Kasi Pemerintahan">Kasi Pemerintahan</option>
                                <option value="Kasi Kesejahteraan">Kasi Kesejahteraan</option>
                                <option value="Kasi Pelayanan">Kasi Pelayanan</option>
                                <option value="Kasi Pembangunan">Kasi Pembangunan</option>
                                <option value="Operator Desa">Operator Desa</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Hak Akses</label>
                            <select name="akses" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                <option value="full">Full Akses</option>
                                <option value="view">View Only</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Periode Mulai</label>
                            <input type="date" name="periode_mulai" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Periode Akhir</label>
                            <input type="date" name="periode_akhir" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto</label>
                            <input type="file" name="image" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
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
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-4xl mx-4 shadow-2xl transform transition-all">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-2xl font-bold text-gray-900">Edit Anggota</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800 transition duration-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                            <input type="text" name="nik" id="edit_nik" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp</label>
                            <input type="text" name="no_wa" id="edit_no_wa" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                            <input type="text" name="nama" id="edit_nama" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                            <select name="jabatan" id="edit_jabatan" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="Kepala Desa">Kepala Desa</option>
                                <option value="Sekretaris Desa">Sekretaris Desa</option>
                                <option value="Bendahara Desa">Bendahara Desa</option>
                                <option value="Kaur Umum">Kaur Umum</option>
                                <option value="Kaur Keuangan">Kaur Keuangan</option>
                                <option value="Kasi Pemerintahan">Kasi Pemerintahan</option>
                                <option value="Kasi Kesejahteraan">Kasi Kesejahteraan</option>
                                <option value="Kasi Pelayanan">Kasi Pelayanan</option>
                                <option value="Kasi Pembangunan">Kasi Pembangunan</option>
                                <option value="Operator Desa">Operator Desa</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Hak Akses</label>
                            <select name="akses" id="edit_akses" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                <option value="full">Full Akses</option>
                                <option value="view">View Only</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Periode Mulai</label>
                            <input type="date" name="periode_mulai" id="edit_periode_mulai" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Periode Akhir</label>
                            <input type="date" name="periode_akhir" id="edit_periode_akhir" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status" id="edit_status" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Baru (Opsional)</label>
                            <input type="file" name="image" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
    fetch(`/struktur/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_nik').value = data.nik;
            document.getElementById('edit_no_wa').value = data.no_wa;
            document.getElementById('edit_nama').value = data.nama;
            document.getElementById('edit_jabatan').value = data.jabatan;
            document.getElementById('edit_akses').value = data.akses;
            document.getElementById('edit_periode_mulai').value = data.periode_mulai;
            document.getElementById('edit_periode_akhir').value = data.periode_akhir;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('editForm').action = `/struktur/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}
</script>
@endsection
