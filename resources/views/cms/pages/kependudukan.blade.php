@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Data Kependudukan</h1>
        <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </button>
    </div>

    <!-- Data Grid -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JK</th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerjaan</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendidikan</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach(App\Models\Kependudukan::all() as $index => $kependudukan)
                    <tr>
                        <td class="px-2 py-2">{{ $index + 1 }}</td>
                        <td class="px-2 py-2">{{ $kependudukan->nik }}</td>
                        <td class="px-2 py-2">{{ $kependudukan->nama }}</td>
                        <td class="px-2 py-2">
                            <span class="px-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kependudukan->jenis_kelamin == 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                {{ $kependudukan->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}
                            </span>
                        </td>
                        <td class="px-2 py-2">{{ $kependudukan->usia }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $kependudukan->status_keluarga }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $kependudukan->mata_pencaharian }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $kependudukan->pendidikan }}</td>
                        <td class="hidden md:table-cell px-2 py-2 max-w-xs truncate">{{ $kependudukan->alamat }}</td>
                        <td class="px-2 py-2 text-right text-sm font-medium">
                            <button onclick="openEditModal({{ $kependudukan->id }})" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('cms.kependudukan.destroy', $kependudukan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Tambah Data Kependudukan</h3>
                <button onclick="closeAddModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('cms.kependudukan.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                        <input type="text" name="nik" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="nama" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Usia</label>
                        <input type="number" name="usia" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Keluarga</label>
                        <select name="status_keluarga" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pencaharian</label>
                        <select name="mata_pencaharian" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Petani">Petani</option>
                            <option value="Pedagang">Pedagang</option>
                            <option value="PNS">PNS</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Buruh">Buruh</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan</label>
                        <select name="pendidikan" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Edit Data Kependudukan</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                        <input type="text" name="nik" id="editNik" required 
                               pattern="[0-9]{16}" title="NIK harus 16 digit angka"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="nama" id="editNama" required 
                               pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf dan spasi"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="editJenisKelamin" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Usia</label>
                        <input type="number" name="usia" id="editUsia" required 
                               min="0" max="120" title="Usia harus antara 0-120 tahun"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Keluarga</label>
                        <select name="status_keluarga" id="editStatusKeluarga" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Status Keluarga</option>
                            <option value="Kepala Keluarga">Kepala Keluarga</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pencaharian</label>
                        <select name="mata_pencaharian" id="editMataPencaharian" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Mata Pencaharian</option>
                            <option value="Petani">Petani</option>
                            <option value="Pedagang">Pedagang</option>
                            <option value="PNS">PNS</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Buruh">Buruh</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan</label>
                        <select name="pendidikan" id="editPendidikan" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Pendidikan</option>
                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" id="editAlamat" required rows="3" 
                                  minlength="10" maxlength="255"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Update Data
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
    fetch(`/cms/kependudukan/${id}/edit`, {
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            console.log('Response Status:', response.status);
            return response.text().then(text => {
                console.log('Response Text:', text);
                throw new Error(`HTTP error! status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Received data:', data);
        
        if (data) {
            document.getElementById('editNik').value = data.nik;
            document.getElementById('editNama').value = data.nama;
            document.getElementById('editJenisKelamin').value = data.jenis_kelamin;
            document.getElementById('editUsia').value = data.usia;
            document.getElementById('editStatusKeluarga').value = data.status_keluarga;
            document.getElementById('editMataPencaharian').value = data.mata_pencaharian;
            document.getElementById('editPendidikan').value = data.pendidikan;
            document.getElementById('editAlamat').value = data.alamat;
            document.getElementById('editForm').action = `/cms/kependudukan/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        } else {
            throw new Error('Data tidak ditemukan');
        }
    })
    .catch(error => {
        console.error('Detail Error:', error);
        alert('Terjadi kesalahan saat mengambil data: ' + error.message);
    });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}
</script>
@endsection
