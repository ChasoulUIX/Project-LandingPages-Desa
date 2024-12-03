@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Galeri Desa</h1>
                    <p class="text-gray-600">Dokumentasi kegiatan dan momen penting di desa kami</p>
                </div>

                <!-- Filter Categories -->
                <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <button class="bg-yellow-500 text-gray-900 px-4 py-2 rounded-full hover:bg-yellow-400 transition duration-300">
                        Semua
                    </button>
                    <button class="bg-gray-100 text-gray-900 px-4 py-2 rounded-full hover:bg-gray-200 transition duration-300">
                        Kegiatan
                    </button>
                    <button class="bg-gray-100 text-gray-900 px-4 py-2 rounded-full hover:bg-gray-200 transition duration-300">
                        Pembangunan
                    </button>
                    <button class="bg-gray-100 text-gray-900 px-4 py-2 rounded-full hover:bg-gray-200 transition duration-300">
                        Budaya
                    </button>
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Gallery Item 1 -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <img src="{{ asset('images/galery1.jpg') }}" alt="Galeri 1" 
                             class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-0 p-6">
                                <h3 class="text-white text-xl font-semibold mb-2">Upacara Adat</h3>
                                <p class="text-gray-200 text-sm">Pelaksanaan upacara adat tahunan desa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Item 2 -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <img src="{{ asset('images/galery2.jpg') }}" alt="Galeri 2" 
                             class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-0 p-6">
                                <h3 class="text-white text-xl font-semibold mb-2">Pembangunan Jalan</h3>
                                <p class="text-gray-200 text-sm">Proyek perbaikan infrastruktur desa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Item 3 -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <img src="{{ asset('images/galery3.jpg') }}" alt="Galeri 3" 
                             class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-0 p-6">
                                <h3 class="text-white text-xl font-semibold mb-2">Festival Budaya</h3>
                                <p class="text-gray-200 text-sm">Perayaan kesenian dan budaya lokal</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Item 4 -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <img src="{{ asset('images/galery4.jpeg') }}" alt="Galeri 4" 
                             class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-0 p-6">
                                <h3 class="text-white text-xl font-semibold mb-2">Musyawarah Desa</h3>
                                <p class="text-gray-200 text-sm">Pertemuan rutin aparatur desa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Item 5 -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <img src="{{ asset('images/galery5.jpg') }}" alt="Galeri 5" 
                             class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-0 p-6">
                                <h3 class="text-white text-xl font-semibold mb-2">Panen Raya</h3>
                                <p class="text-gray-200 text-sm">Kegiatan panen bersama petani desa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Item 6 -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <img src="{{ asset('images/galery6.jpg') }}" alt="Galeri 6" 
                             class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-0 p-6">
                                <h3 class="text-white text-xl font-semibold mb-2">Pembinaan Pemuda</h3>
                                <p class="text-gray-200 text-sm">Program pengembangan pemuda desa</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-12">
                    <button class="bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg hover:bg-yellow-400 transition duration-300 font-medium">
                        Muat Lebih Banyak
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection
