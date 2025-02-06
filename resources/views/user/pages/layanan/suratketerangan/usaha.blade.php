@extends('user.layouts.app')

@section('content')
    <main class="pt-0">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button and Title -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <a href="{{ url('/keterangan') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300 mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-center">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Surat Keterangan Usaha</h1>
                        <p class="text-sm text-blue-100">Surat keterangan untuk kepemilikan usaha di wilayah desa</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <!-- Form Section -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <form action="{{ route('surat-usaha.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Data Pemohon -->
                        <div class="border-b pb-6">
                            <h2 class="text-xl font-semibold text-blue-900 mb-4">Data Pemohon</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="nama" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                    <input type="text" name="nik" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <!-- Data Usaha -->
                        <div class="border-b pb-6">
                            <h2 class="text-xl font-semibold text-blue-900 mb-4">Data Usaha</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Usaha</label>
                                    <input type="text" name="nama_usaha" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Usaha</label>
                                    <input type="text" name="jenis_usaha" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Usaha</label>
                                    <textarea name="alamat_usaha" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Mulai Usaha</label>
                                    <input type="number" name="tahun_mulai" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                Ajukan Permohonan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Sidebar -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Persyaratan -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-blue-900 mb-4">Persyaratan</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>KTP asli dan fotokopi</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>Kartu Keluarga asli dan fotokopi</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>Surat Pengantar RT/RW</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>Foto lokasi usaha</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-blue-900 mb-4">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-user-tie text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <p class="font-medium">Petugas Pelayanan</p>
                                    <p class="text-gray-600">Bpk. Suryanto</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-phone text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <p class="font-medium">Telepon/WhatsApp</p>
                                    <p class="text-gray-600">0812-3456-7890</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <p class="font-medium">Jam Layanan</p>
                                    <p class="text-gray-600">Senin - Jumat, 08.00 - 15.00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
