@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-0">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-8 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8 sm:mb-12">
                    <a href="{{ url('/keterangan') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300 mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-center">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2 sm:mb-4">Surat Keterangan Kematian</h1>
                        <p class="text-sm sm:text-base text-blue-100">Layanan pembuatan surat keterangan kematian untuk keperluan administratif</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Deskripsi Layanan -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h2 class="text-xl font-semibold text-blue-900 mb-4">Tentang Layanan</h2>
                            <p class="text-gray-600 mb-6">Surat Keterangan Kematian adalah dokumen resmi yang dikeluarkan oleh pemerintah desa untuk mencatat peristiwa kematian warga. Surat ini diperlukan untuk berbagai keperluan administratif seperti pengurusan asuransi, warisan, atau pencatatan sipil.</p>
                            
                            <h3 class="text-lg font-semibold text-blue-900 mb-3">Waktu Pemrosesan</h3>
                            <div class="flex items-center mb-6">
                                <i class="fas fa-clock text-yellow-500 mr-3"></i>
                                <span class="text-gray-600">1-2 hari kerja</span>
                            </div>

                            <h3 class="text-lg font-semibold text-blue-900 mb-3">Biaya</h3>
                            <div class="flex items-center">
                                <i class="fas fa-money-bill text-yellow-500 mr-3"></i>
                                <span class="text-gray-600">Gratis</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Persyaratan -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-semibold text-blue-900 mb-4">Persyaratan</h3>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>KTP almarhum/almarhumah (asli dan fotokopi)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Kartu Keluarga (asli dan fotokopi)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Surat Pengantar RT/RW</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Surat keterangan dari rumah sakit/dokter (jika meninggal di RS)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>KTP pelapor/ahli waris</span>
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
        </div>
    </main>
@endsection
