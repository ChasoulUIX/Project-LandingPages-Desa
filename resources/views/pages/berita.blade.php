@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-20">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Berita & Informasi Terkini</h1>
                    <p class="text-blue-100">Temukan informasi dan berita terbaru seputar kegiatan di desa kami</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Berita Item 1 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <img src="https://source.unsplash.com/600x400/?village,development" alt="Berita 1" class="w-full h-48 object-cover rounded-lg mb-4">
                        <div class="flex items-center text-gray-500 text-sm mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>22 Januari 2024</span>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Pembangunan Infrastruktur Desa</h3>
                        <p class="text-gray-600 mb-4">Progres pembangunan infrastruktur desa yang meliputi perbaikan jalan dan jembatan telah mencapai 70%...</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Baca selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Berita Item 2 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <img src="https://source.unsplash.com/600x400/?vaccine,health" alt="Berita 2" class="w-full h-48 object-cover rounded-lg mb-4">
                        <div class="flex items-center text-gray-500 text-sm mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>20 Januari 2024</span>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Program Vaksinasi Covid-19</h3>
                        <p class="text-gray-600 mb-4">Pelaksanaan program vaksinasi Covid-19 tahap kedua telah mencapai target dengan partisipasi masyarakat...</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Baca selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Berita Item 3 -->
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300">
                        <img src="https://source.unsplash.com/600x400/?culture,festival" alt="Berita 3" class="w-full h-48 object-cover rounded-lg mb-4">
                        <div class="flex items-center text-gray-500 text-sm mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>18 Januari 2024</span>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3">Festival Budaya Desa</h3>
                        <p class="text-gray-600 mb-4">Festival budaya tahunan desa akan diselenggarakan pada bulan depan dengan menampilkan berbagai...</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                            <span>Baca selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="px-4 py-2 border border-blue-600 bg-blue-600 text-white rounded-lg">1</a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2</a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3</a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </main>
@endsection
