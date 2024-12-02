@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-b from-blue-900 to-blue-800">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 hero-pattern opacity-10"></div>
            <div class="relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="text-center md:text-left space-y-8">
                            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white leading-tight">
                                Selamat Datang di<br>
                                <span class="text-yellow-400">Portal Desa Digital</span>
                            </h1>
                            <p class="text-lg sm:text-xl text-blue-100 max-w-2xl">
                                Wujudkan pelayanan desa yang modern, efisien, dan transparan melalui sistem informasi terintegrasi
                            </p>
                            <div class="flex flex-col sm:flex-row justify-center md:justify-start space-y-4 sm:space-y-0 sm:space-x-6">
                                <a href="#" class="bg-yellow-500 text-blue-900 px-8 py-4 rounded-lg hover:bg-yellow-400 transition duration-300 font-bold text-base flex items-center justify-center space-x-3 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <span>Mulai Sekarang</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white hover:text-blue-900 transition duration-300 font-semibold text-base flex items-center justify-center space-x-3">
                                    <i class="fas fa-play-circle text-xl"></i>
                                    <span>Lihat Video</span>
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <img src="https://dummyimage.com/600x400/blue/white&text=Village+Illustration" alt="Hero Image" class="rounded-2xl shadow-2xl transform hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>
                
                <!-- Stats Section -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-20">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="bg-white rounded-xl shadow-2xl p-6 transform hover:-translate-y-2 transition duration-300">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-900 flex items-center justify-center space-x-3">
                                <i class="fas fa-users text-yellow-500"></i>
                                <span>5,234+</span>
                            </div>
                            <div class="text-gray-600 text-center mt-3 font-medium">Penduduk</div>
                        </div>
                        <div class="bg-white rounded-xl shadow-2xl p-6 transform hover:-translate-y-2 transition duration-300">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-900 flex items-center justify-center space-x-3">
                                <i class="fas fa-file-alt text-yellow-500"></i>
                                <span>1,789+</span>
                            </div>
                            <div class="text-gray-600 text-center mt-3 font-medium">Layanan</div>
                        </div>
                        <div class="bg-white rounded-xl shadow-2xl p-6 transform hover:-translate-y-2 transition duration-300">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-900 flex items-center justify-center space-x-3">
                                <i class="fas fa-chart-line text-yellow-500"></i>
                                <span>95%</span>
                            </div>
                            <div class="text-gray-600 text-center mt-3 font-medium">Kepuasan</div>
                        </div>
                        <div class="bg-white rounded-xl shadow-2xl p-6 transform hover:-translate-y-2 transition duration-300">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-900 flex items-center justify-center space-x-3">
                                <i class="fas fa-award text-yellow-500"></i>
                                <span>10+</span>
                            </div>
                            <div class="text-gray-600 text-center mt-3 font-medium">Penghargaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gray-50 pt-32 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Layanan Unggulan</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-lg">Nikmati berbagai layanan digital yang kami sediakan untuk memudahkan urusan administrasi dan pelayanan publik di desa Anda</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="p-8">
                            <div class="w-16 h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-file-alt text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-blue-900 mb-4">Administrasi Digital</h3>
                            <p class="text-gray-600 mb-6">Akses layanan administrasi desa secara online:</p>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Surat Keterangan Domisili</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Surat Pengantar KTP</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Surat Keterangan Usaha</span>
                                </li>
                            </ul>
                        </div>
                        <div class="px-8 pb-8">
                            <a href="#" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="p-8">
                            <div class="w-16 h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-bullhorn text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-blue-900 mb-4">Informasi & Pengumuman</h3>
                            <p class="text-gray-600 mb-6">Dapatkan informasi terkini seputar desa:</p>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Program Pembangunan</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Kegiatan Masyarakat</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Transparansi Anggaran</span>
                                </li>
                            </ul>
                        </div>
                        <div class="px-8 pb-8">
                            <a href="#" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="p-8">
                            <div class="w-16 h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-comments text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-blue-900 mb-4">Aspirasi Masyarakat</h3>
                            <p class="text-gray-600 mb-6">Sampaikan aspirasi Anda:</p>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Pengaduan Online</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Forum Diskusi</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                    <span>Survei Kepuasan</span>
                                </li>
                            </ul>
                        </div>
                        <div class="px-8 pb-8">
                            <a href="#" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
