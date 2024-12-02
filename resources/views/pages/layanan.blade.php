@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-20">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Layanan Kami</h1>
                    <p class="text-blue-100">Berbagai layanan yang kami sediakan untuk memudahkan masyarakat desa</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Surat Keterangan -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Surat Keterangan</h3>
                        <p class="text-gray-600 mb-4">Pembuatan berbagai surat keterangan untuk keperluan administratif</p>
                        <a href="{{ url('/keterangan') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Pengaduan -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Pengaduan</h3>
                        <p class="text-gray-600 mb-4">Layanan pengaduan masyarakat untuk peningkatan pelayanan desa</p>
                        <a href="{{ url('/pengaduan') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Informasi Desa -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Informasi Desa</h3>
                        <p class="text-gray-600 mb-4">Akses informasi terkini seputar kegiatan dan program desa</p>
                        <a href="{{ url('/informasidesa') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Data Kependudukan -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Data Kependudukan</h3>
                        <p class="text-gray-600 mb-4">Pengelolaan data penduduk desa secara digital dan terintegrasi</p>
                        <a href="{{ url('/datakependudukan') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Bantuan Sosial -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Bantuan Sosial</h3>
                        <p class="text-gray-600 mb-4">Informasi dan pendaftaran program bantuan sosial untuk masyarakat</p>
                        <a href="{{ url('/bantuansosial') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Potensi Desa -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-3xl mb-4">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Dana Desa</h3>
                        <p class="text-gray-600 mb-4">Informasi potensi dan peluang pengembangan ekonomi desa</p>
                        <a href="{{ url('/danadesa') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

   @endsection
