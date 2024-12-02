@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button and Title -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300 mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-center">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Bantuan Sosial</h1>
                        <p class="text-sm text-blue-100">Informasi program bantuan sosial untuk masyarakat</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <!-- Program Bantuan Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- BLT Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Bantuan Langsung Tunai (BLT)</h3>
                        <p class="text-gray-600 mb-4">Program bantuan tunai untuk keluarga prasejahtera</p>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><i class="fas fa-calendar-alt mr-2"></i>Periode: Januari - Juni 2024</p>
                            <p><i class="fas fa-users mr-2"></i>Penerima: 150 KK</p>
                            <p><i class="fas fa-money-bill-wave mr-2"></i>Nominal: Rp 300.000/bulan</p>
                        </div>
                    </div>

                    <!-- BPNT Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Bantuan Pangan Non Tunai</h3>
                        <p class="text-gray-600 mb-4">Bantuan sembako untuk keluarga rentan</p>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><i class="fas fa-calendar-alt mr-2"></i>Distribusi: Setiap bulan</p>
                            <p><i class="fas fa-users mr-2"></i>Penerima: 200 KK</p>
                            <p><i class="fas fa-box mr-2"></i>Paket: Beras, Telur, Minyak</p>
                        </div>
                    </div>

                    <!-- PKH Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Program Keluarga Harapan</h3>
                        <p class="text-gray-600 mb-4">Bantuan untuk pendidikan dan kesehatan</p>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><i class="fas fa-calendar-alt mr-2"></i>Tahap: Triwulan</p>
                            <p><i class="fas fa-users mr-2"></i>Penerima: 100 KK</p>
                            <p><i class="fas fa-check-circle mr-2"></i>Mencakup: Pendidikan & Kesehatan</p>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Persyaratan -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-semibold text-blue-900 mb-4">Persyaratan Umum</h3>
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>Kartu Keluarga dan KTP yang masih berlaku</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>Surat Keterangan Tidak Mampu dari Desa</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>Bukti foto rumah dan kondisi ekonomi</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span>Dokumen pendukung sesuai jenis bantuan</span>
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
                                    <p class="font-medium">Petugas Bantuan Sosial</p>
                                    <p class="text-gray-600">Bpk. Ahmad Suharto</p>
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
