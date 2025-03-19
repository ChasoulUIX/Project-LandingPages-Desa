@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-2 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Data Kependudukan</h1>
        @if(auth()->guard('web')->check() || (auth()->guard('struktur')->check() && auth()->guard('struktur')->user()->jabatan === 'Operator Desa' && auth()->guard('struktur')->user()->akses === 'full'))
            <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Data
            </button>
        @endif
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
        @if(App\Models\Kependudukan::count() == 0)
            <div class="flex flex-col items-center justify-center py-12">
                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Page%20Facing%20Up.png"
                     alt="No Data"
                     class="w-32 h-32 mb-4"
                >
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                   Tidak ada data kependudukan
                </h3>
                <p class="text-sm text-gray-500 text-center mb-4">
                    Mulai tambahkan data sekarang
                </p>
                @if(auth()->guard('web')->check() || (auth()->guard('struktur')->check() && auth()->guard('struktur')->user()->jabatan === 'Operator Desa' && auth()->guard('struktur')->user()->akses === 'full') )
                    <button onclick="openAddModal()"
                            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Tambah Data
                    </button>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="w-[5%] sticky left-0 bg-gray-50 px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="w-[15%] px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center gap-1 cursor-pointer" onclick="sortTable('nik')">
                                    NIK
                                    <i class="fas fa-sort{{ request()->get('sort') === 'nik' ? (request()->get('order') === 'asc' ? '-up' : '-down') : '' }}"></i>
                                </div>
                            </th>
                            <th class="w-[20%] px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center gap-1 cursor-pointer" onclick="sortTable('nama_lengkap')">
                                    Nama
                                    <i class="fas fa-sort{{ request()->get('sort') === 'nama_lengkap' ? (request()->get('order') === 'asc' ? '-up' : '-down') : '' }}"></i>
                                </div>
                            </th>
                            <th class="w-[20%] px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">TTL</th>
                            <th class="w-[10%] px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">JK</th>
                            <th class="w-[10%] px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Agama</th>
                            <th class="w-[12%] px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="w-[8%] sticky right-0 bg-gray-50 px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $sort = request()->get('sort');
                            $order = request()->get('order', 'asc');

                            $kependudukan = App\Models\Kependudukan::when($sort, function($query) use ($sort, $order) {
                                return $query->orderBy($sort, $order);
                            })->paginate(10);
                        @endphp
                        @forelse($kependudukan as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="sticky left-0 bg-white px-6 py-4 text-base whitespace-nowrap">{{ ($index + 1) + (request()->get('page', 1) - 1) * 10 }}</td>
                            <td class="px-6 py-4 text-base whitespace-nowrap">{{ $item->nik }}</td>
                            <td class="px-6 py-4 text-base whitespace-nowrap">{{ $item->nama_lengkap }}</td>
                            <td class="px-6 py-4 text-base whitespace-nowrap">{{ $item->tempat_lahir }}, {{ date('d/m/Y', strtotime($item->tanggal_lahir)) }}</td>
                            <td class="px-6 py-4 text-base whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->jenis_kelamin == 'Laki-Laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $item->jenis_kelamin == 'Laki-Laki' ? 'L' : 'P' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-base whitespace-nowrap">{{ $item->agama }}</td>
                            <td class="px-6 py-4 text-base whitespace-nowrap">{{ $item->status_perkawinan }}</td>
                            @if(auth()->guard('web')->check() || (auth()->guard('struktur')->check() && auth()->guard('struktur')->user()->jabatan === 'Operator Desa' && auth()->guard('struktur')->user()->akses === 'full'))
                                <td class="sticky right-0 bg-white px-6 py-4 text-right text-base font-medium whitespace-nowrap">
                                    <button onclick="openEditModal('{{ $item->nik }}')" class="text-blue-600 hover:text-blue-800 mr-3 text-lg">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteData('{{ $item->nik }}')" class="text-red-600 hover:text-red-800 text-lg">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 text-lg">
                                Tidak ada data kependudukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Pagination - Moved completely outside -->
    <div class="flex justify-center mt-6">
        <div class="flex items-center gap-4">
            @if(App\Models\Kependudukan::count() > 0 && $kependudukan->previousPageUrl())
                <a href="{{ $kependudukan->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Previous
                </a>
            @endif

            <div class="flex items-center gap-2">
                @if(App\Models\Kependudukan::count() > 0)
                    @for($i = 1; $i <= $kependudukan->lastPage(); $i++)
                        <a href="{{ $kependudukan->url($i) }}"
                       class="px-4 py-2 text-sm font-medium {{ $kependudukan->currentPage() == $i ? 'text-white bg-blue-600' : 'text-gray-700 bg-white' }} border border-gray-300 rounded-md hover:bg-gray-50">
                        {{ $i }}
                    </a>
                @endfor
                @else
                    <p class="text-gray-500 text-center mb-6">
                        Belum ada data kependudukan yang tersedia. Mulai tambahkan data sekarang!
                    </p>
                @endif
            </div>

            @if(App\Models\Kependudukan::count() > 0 && $kependudukan->nextPageUrl())
                <a href="{{ $kependudukan->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Next
                </a>
            @endif
        </div>
    </div>

    <div class="flex justify-center mt-2">
        <p class="text-sm text-gray-700">
            Showing
            <span class="font-medium">{{ App\Models\Kependudukan::count() > 0 ? $kependudukan->firstItem() : 0 }}</span>
            to
            <span class="font-medium">{{ App\Models\Kependudukan::count() > 0 ? $kependudukan->lastItem() : 0 }}</span>
            of
            <span class="font-medium">{{ App\Models\Kependudukan::count() > 0 ? $kependudukan->total() : 0 }}</span>
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
            <form action="{{ route('cms.kependudukan.store') }}" method="POST" class="p-6" autocomplete="off">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                            <input type="text" name="nik" required pattern="[0-9]{16}"
                                   title="NIK harus 16 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No KK</label>
                            <input type="text" name="no_kk" required pattern="[0-9]{16}"
                                   title="No KK harus 16 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="text" name="nomor_hp" required pattern="[0-9]{10,15}"
                                   title="Nomor HP harus 10-15 digit angka"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
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
                            <select name="pekerjaan" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Pekerjaan</option>
                                <option value="Petani">Petani</option>
                                <option value="PNS">PNS</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Swasta">Swasta</option>
                                <option value="Pedagang">Pedagang</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Pendidikan</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2/S3">S2/S3</option>
                            </select>
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
            <form id="editForm" method="POST" class="p-6" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                            <input type="text" name="nik" id="editNik" required
                                   pattern="[0-9]{16}" title="NIK harus 16 digit angka"
                                   value="{{ old('nik') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No KK</label>
                            <input type="text" name="no_kk" id="editNoKK" required
                                   pattern="[0-9]{16}" title="No KK harus 16 digit angka"
                                   value="{{ old('no_kk') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="editNamaLengkap" required
                                   value="{{ old('nama_lengkap') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="text" name="nomor_hp" id="editNomorHP" required
                                   pattern="[0-9]{10,15}" title="Nomor HP harus 10-15 digit angka"
                                   value="{{ old('nomor_hp') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="editTempatLahir" required
                                   value="{{ old('tempat_lahir') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="editTanggalLahir" required
                                   value="{{ old('tanggal_lahir', isset($penduduk) ? date('Y-m-d', strtotime($penduduk->tanggal_lahir)) : '') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="editJenisKelamin" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                            <select name="golongan_darah" id="editGolonganDarah" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                                <option value="-" {{ old('golongan_darah') == '-' ? 'selected' : '' }}>-</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <select name="agama" id="editAgama" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan</label>
                            <select name="status_perkawinan" id="editStatusPerkawinan" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                            <select name="pekerjaan" id="editPekerjaan" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Petani" {{ old('pekerjaan') == 'Petani' ? 'selected' : '' }}>Petani</option>
                                <option value="PNS" {{ old('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                <option value="Wiraswasta" {{ old('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                <option value="Swasta" {{ old('pekerjaan') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                <option value="Pedagang" {{ old('pekerjaan') == 'Pedagang' ? 'selected' : '' }}>Pedagang</option>
                                <option value="Lainnya" {{ old('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" id="editPendidikanTerakhir" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2/S3" {{ old('pendidikan_terakhir') == 'S2/S3' ? 'selected' : '' }}>S2/S3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Keluarga</label>
                            <select name="status_keluarga" id="editStatusKeluarga" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Kepala Keluarga" {{ old('status_keluarga') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                <option value="Suami" {{ old('status_keluarga') == 'Suami' ? 'selected' : '' }}>Suami</option>
                                <option value="Istri" {{ old('status_keluarga') == 'Istri' ? 'selected' : '' }}>Istri</option>
                                <option value="Anak" {{ old('status_keluarga') == 'Anak' ? 'selected' : '' }}>Anak</option>
                                <option value="Orang Tua" {{ old('status_keluarga') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                <option value="Lainnya" {{ old('status_keluarga') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
    document.body.classList.add('modal-open');
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
    document.getElementById('addModal').classList.remove('flex');
    document.body.classList.remove('modal-open');
}

function openEditModal(nik) {
    // Tampilkan loading dengan SweetAlert2
    Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Ambil data dengan fetch
    fetch(`/cms/app/kependudukan/${nik}/edit`)
        .then(response => response.json())
        .then(data => {
            Swal.close();

            if (data.penduduk) {
                // Isi form dengan data yang diterima
                document.getElementById('editNik').value = data.penduduk.nik;
                document.getElementById('editNoKK').value = data.penduduk.no_kk;
                document.getElementById('editNamaLengkap').value = data.penduduk.nama_lengkap;
                document.getElementById('editNomorHP').value = data.penduduk.nomor_hp;
                document.getElementById('editTempatLahir').value = data.penduduk.tempat_lahir;
                document.getElementById('editTanggalLahir').value = data.penduduk.tanggal_lahir ? new Date(data.penduduk.tanggal_lahir).toISOString().split('T')[0] : '';
                document.getElementById('editJenisKelamin').value = data.penduduk.jenis_kelamin;
                document.getElementById('editGolonganDarah').value = data.penduduk.golongan_darah;
                document.getElementById('editAgama').value = data.penduduk.agama;
                document.getElementById('editStatusPerkawinan').value = data.penduduk.status_perkawinan;
                document.getElementById('editPekerjaan').value = data.penduduk.pekerjaan;
                document.getElementById('editPendidikanTerakhir').value = data.penduduk.pendidikan_terakhir;
                document.getElementById('editStatusKeluarga').value = data.penduduk.status_keluarga;

                // Set action URL form
                document.getElementById('editForm').action = `/cms/app/kependudukan/${nik}`;

                // Tampilkan modal
                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editModal').classList.add('flex');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Data tidak ditemukan'
                });
            }
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
    document.body.classList.remove('modal-open');
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
    const urlParams = new URLSearchParams(window.location.search);
    const currentSort = urlParams.get('sort');
    const currentOrder = urlParams.get('order') || 'asc';

    let newOrder = 'asc';
    if (currentSort === column && currentOrder === 'asc') {
        newOrder = 'desc';
    }

    urlParams.set('sort', column);
    urlParams.set('order', newOrder);

    // Maintain the current page and any other existing parameters
    window.location.href = `${window.location.pathname}?${urlParams.toString()}`;
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

function deleteData(nik) {
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
            const token = document.querySelector('meta[name="csrf-token"]').content;

            fetch(`/cms/app/kependudukan/${nik}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message || 'Terjadi kesalahan saat menghapus data'
                });
            });
        }
    });
}
</script>

<style>
/* Container width control */
.container {
    max-width: 1380px !important;
    margin: 0 auto;
    width: 100%;
}

/* Modal styling improvements */
#addModal,
#editModal {
    position: fixed;
    inset: 0;
    display: none;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 50;
    padding: 1rem;
    overflow-y: auto;
}

/* Modal content container */
#addModal .bg-white,
#editModal .bg-white {
    width: 100%;
    max-width: 800px;
    margin: auto;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Form layout adjustments */
.grid.grid-cols-2 {
    gap: 1.5rem;
}

/* Input field sizing */
.px-3.py-2 {
    height: 2.5rem;
}

/* Table scrollbar styling */
.overflow-x-auto {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

/* Table layout */
table {
    table-layout: fixed;
    width: 100%;
}

/* Sticky columns */
.sticky {
    position: sticky;
    z-index: 1;
    background-color: inherit;
}

.sticky.left-0 {
    left: 0;
    border-right: 1px solid #e5e7eb;
}

.sticky.right-0 {
    right: 0;
    border-left: 1px solid #e5e7eb;
}

/* Ensure sticky columns have proper background */
thead .sticky {
    background-color: #f9fafb;
}

tbody .sticky {
    background-color: #ffffff;
}

/* Modal scroll behavior */
body.modal-open {
    overflow: hidden;
}

/* Ensure modals are properly centered */
#addModal.flex,
#editModal.flex {
    display: flex !important;
}
</style>
@endsection
