@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Data Kependudukan</h1>
        <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </button>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="relative">
            <input type="text" 
                   id="searchInput" 
                   placeholder="Cari berdasarkan NIK atau Nama..." 
                   oninput="filterData(this.value)"
                   class="w-full md:w-96 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- Data Grid -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                NIK
                                <button onclick="sortTable('nik')" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-sort"></i>
                                </button>
                            </div>
                        </th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                No KK
                                <button onclick="sortTable('no_kk')" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-sort"></i>
                                </button>
                            </div>
                        </th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1">
                                Nama Lengkap
                                <button onclick="sortTable('nama_lengkap')" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-sort"></i>
                                </button>
                            </div>
                        </th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No HP</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TTL</th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JK</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gol. Darah</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Agama</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerjaan</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendidikan</th>
                        <th class="hidden md:table-cell px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Keluarga</th>
                        <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $kependudukan = App\Models\Kependudukan::paginate(10);
                    @endphp
                    @forelse($kependudukan as $index => $item)
                    <tr>
                        <td class="px-2 py-2">{{ ($index + 1) + (request()->get('page', 1) - 1) * 10 }}</td>
                        <td class="px-2 py-2">{{ $item->nik }}</td>
                        <td class="px-2 py-2">{{ $item->no_kk }}</td>
                        <td class="px-2 py-2">{{ $item->nama_lengkap }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $item->nomor_hp }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $item->tempat_lahir }}, {{ date('d/m/Y', strtotime($item->tanggal_lahir)) }}</td>
                        <td class="px-2 py-2">
                            <span class="px-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->jenis_kelamin == 'Laki-Laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                {{ $item->jenis_kelamin == 'Laki-Laki' ? 'L' : 'P' }}
                            </span>
                        </td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $item->golongan_darah }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $item->agama }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $item->status_perkawinan }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $item->pekerjaan }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $item->pendidikan_terakhir }}</td>
                        <td class="hidden md:table-cell px-2 py-2">{{ $item->status_keluarga }}</td>
                        <td class="px-2 py-2 text-right text-sm font-medium">
                            <button onclick="openEditModal('{{ $item->nik }}')" class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('cms.kependudukan.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="14" class="px-2 py-4 text-center text-gray-500">
                            Tidak ada data kependudukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination - Moved completely outside -->
    <div class="flex justify-center mt-6">
        <div class="flex items-center gap-4">
            @if($kependudukan->previousPageUrl())
                <a href="{{ $kependudukan->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Previous
                </a>
            @endif

            <div class="flex items-center gap-2">
                @for($i = 1; $i <= $kependudukan->lastPage(); $i++)
                    <a href="{{ $kependudukan->url($i) }}" 
                       class="px-4 py-2 text-sm font-medium {{ $kependudukan->currentPage() == $i ? 'text-white bg-blue-600' : 'text-gray-700 bg-white' }} border border-gray-300 rounded-md hover:bg-gray-50">
                        {{ $i }}
                    </a>
                @endfor
            </div>

            @if($kependudukan->nextPageUrl())
                <a href="{{ $kependudukan->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Next
                </a>
            @endif
        </div>
    </div>

    <div class="flex justify-center mt-2">
        <p class="text-sm text-gray-700">
            Showing
            <span class="font-medium">{{ $kependudukan->firstItem() }}</span>
            to
            <span class="font-medium">{{ $kependudukan->lastItem() }}</span>
            of
            <span class="font-medium">{{ $kependudukan->total() }}</span>
            results
        </p>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-4xl mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Tambah Data Kependudukan</h3>
                <button onclick="closeAddModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('cms.kependudukan.store') }}" method="POST" class="p-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                            <input type="text" name="nik" required pattern="[0-9]{16}" 
                                   title="NIK harus 16 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No KK</label>
                            <input type="text" name="no_kk" required pattern="[0-9]{16}" 
                                   title="No KK harus 16 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="text" name="nomor_hp" required pattern="[0-9]{10,15}" 
                                   title="Nomor HP harus 10-15 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                            <select name="golongan_darah" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <select name="agama" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan</label>
                            <select name="status_perkawinan" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Kawin">Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Keluarga</label>
                            <select name="status_keluarga" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Kepala Keluarga">Kepala Keluarga</option>
                                <option value="Suami">Suami</option>
                                <option value="Istri">Istri</option>
                                <option value="Anak">Anak</option>
                                <option value="Orang Tua">Orang Tua</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg w-full max-w-4xl mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-lg font-semibold">Edit Data Kependudukan</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                            <input type="text" name="nik" id="editNik" required 
                                   pattern="[0-9]{16}" title="NIK harus 16 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No KK</label>
                            <input type="text" name="no_kk" id="editNoKK" required 
                                   pattern="[0-9]{16}" title="No KK harus 16 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="editNamaLengkap" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="text" name="nomor_hp" id="editNomorHP" required 
                                   pattern="[0-9]{10,15}" title="Nomor HP harus 10-15 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="editTempatLahir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="editTanggalLahir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="editJenisKelamin" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                            <select name="golongan_darah" id="editGolonganDarah" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Golongan Darah</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <select name="agama" id="editAgama" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan</label>
                            <select name="status_perkawinan" id="editStatusPerkawinan" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Status Perkawinan</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Kawin">Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="editPekerjaan" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" id="editPendidikanTerakhir" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Keluarga</label>
                            <select name="status_keluarga" id="editStatusKeluarga" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Status Keluarga</option>
                                <option value="Kepala Keluarga">Kepala Keluarga</option>
                                <option value="Suami">Suami</option>
                                <option value="Istri">Istri</option>
                                <option value="Anak">Anak</option>
                                <option value="Orang Tua">Orang Tua</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
    document.getElementById('addModal').classList.add('flex');
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
    document.getElementById('addModal').classList.remove('flex');
}

function openEditModal(nik) {
    Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/cms/kependudukan/${nik}/edit`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        Swal.close();
        
        if (!data) {
            throw new Error('Data tidak ditemukan');
        }

        // Mengisi form dengan data yang diterima
        document.getElementById('editNik').value = data.nik || '';
        document.getElementById('editNoKK').value = data.no_kk || '';
        document.getElementById('editNamaLengkap').value = data.nama_lengkap || '';
        document.getElementById('editNomorHP').value = data.nomor_hp || '';
        document.getElementById('editTempatLahir').value = data.tempat_lahir || '';
        // Format tanggal lahir ke format YYYY-MM-DD untuk input type="date"
        if (data.tanggal_lahir) {
            const date = new Date(data.tanggal_lahir);
            const formattedDate = date.toISOString().split('T')[0];
            document.getElementById('editTanggalLahir').value = formattedDate;
        }
        document.getElementById('editJenisKelamin').value = data.jenis_kelamin || '';
        document.getElementById('editGolonganDarah').value = data.golongan_darah || '';
        document.getElementById('editAgama').value = data.agama || '';
        document.getElementById('editStatusPerkawinan').value = data.status_perkawinan || '';
        document.getElementById('editPekerjaan').value = data.pekerjaan || '';
        document.getElementById('editPendidikanTerakhir').value = data.pendidikan_terakhir || '';
        document.getElementById('editStatusKeluarga').value = data.status_keluarga || '';
        
        // Set action URL untuk form menggunakan NIK
        document.getElementById('editForm').action = `/cms/kependudukan/${nik}`;
        
        // Tampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat mengambil data'
        });
    });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function filterData(searchValue) {
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        // Skip empty state row
        if (row.children.length === 1) return;
        
        const nik = row.children[1].textContent.toLowerCase(); // Column index 1 for NIK
        const nama_lengkap = row.children[3].textContent.toLowerCase(); // Column index 3 for nama_lengkap
        const searchTerm = searchValue.toLowerCase();
        
        if (nik.includes(searchTerm) || nama_lengkap.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update the "Showing X to Y of Z results" text
    updateResultsCount();
}

function updateResultsCount() {
    const visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])');
    const totalRows = document.querySelectorAll('tbody tr').length;
    
    const firstItem = visibleRows.length > 0 ? 1 : 0;
    const lastItem = visibleRows.length;
    
    document.querySelector('.text-sm.text-gray-700').innerHTML = `
        Showing
        <span class="font-medium">${firstItem}</span>
        to
        <span class="font-medium">${lastItem}</span>
        of
        <span class="font-medium">${totalRows}</span>
        results
    `;
}

// SweetAlert notifications
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        timer: 3000,
        showConfirmButton: false
    });
@endif

// Confirm Delete with SweetAlert
document.querySelectorAll('form').forEach(form => {
    if (form.action.includes('destroy')) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    }
});

function sortTable(column) {
    const currentOrder = new URLSearchParams(window.location.search).get('order') || 'asc';
    const newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
    window.location.href = `{{ route('cms.kependudukan.index') }}?sort=${column}&order=${newOrder}`;
}

function filterTable(column, value) {
    // Create a delay to prevent too many requests
    clearTimeout(window.filterTimeout);
    window.filterTimeout = setTimeout(() => {
        const currentUrl = new URL(window.location.href);
        const params = new URLSearchParams(currentUrl.search);
        
        if (value) {
            params.set(`filter[${column}]`, value);
        } else {
            params.delete(`filter[${column}]`);
        }
        
        // Reset to page 1 when filtering
        params.set('page', '1');
        
        window.location.href = `${currentUrl.pathname}?${params.toString()}`;
    }, 500);
}

// Keep filter values after page reload
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    
    for (const [key, value] of urlParams.entries()) {
        if (key.startsWith('filter[')) {
            const column = key.replace('filter[', '').replace(']', '');
            const input = document.querySelector(`[onkeyup="filterTable('${column}', this.value)"]`) ||
                         document.querySelector(`[onchange="filterTable('${column}', this.value)"]`);
            if (input) {
                input.value = value;
            }
        }
    }
});
</script>
@endsection
