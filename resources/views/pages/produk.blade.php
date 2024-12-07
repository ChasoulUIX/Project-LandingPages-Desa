@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-16">
        <!-- Hero Section -->
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Produk UMKM Desa Sumber Secang</h1>
                    <p class="text-blue-100">Temukan berbagai produk unggulan dari UMKM Desa Sumber Secang</p>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Product Card 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64">
                        <img src="{{ asset('images/madu.jpg') }}" alt="Madu Asli" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Madu Asli Sumber Secang</h3>
                        <p class="text-gray-600 mb-4">Madu murni hasil ternak lebah lokal dengan kualitas terbaik</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-500 font-bold">Rp 85.000</span>
                            <a href="https://wa.me/6281234567890" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64">
                        <img src="{{ asset('images/keripik.jpg') }}" alt="Keripik Singkong" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Keripik Singkong</h3>
                        <p class="text-gray-600 mb-4">Keripik singkong renyah dengan berbagai varian rasa</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-500 font-bold">Rp 15.000</span>
                            <a href="https://wa.me/6281234567890" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64">
                        <img src="{{ asset('images/kopi.jpg') }}" alt="Kopi Robusta" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Kopi Robusta</h3>
                        <p class="text-gray-600 mb-4">Kopi robusta pilihan dari perkebunan lokal</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-500 font-bold">Rp 45.000</span>
                            <a href="https://wa.me/6281234567890" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64">
                        <img src="{{ asset('images/batik.jpg') }}" alt="Batik Tulis" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Batik Tulis</h3>
                        <p class="text-gray-600 mb-4">Batik tulis dengan motif khas Probolinggo</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-500 font-bold">Rp 350.000</span>
                            <a href="https://wa.me/6281234567890" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 5 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64">
                        <img src="{{ asset('images/anyaman.jpg') }}" alt="Anyaman Bambu" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Anyaman Bambu</h3>
                        <p class="text-gray-600 mb-4">Kerajinan anyaman bambu berkualitas tinggi</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-500 font-bold">Rp 75.000</span>
                            <a href="https://wa.me/6281234567890" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 6 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64">
                        <img src="{{ asset('images/tempe.jpg') }}" alt="Tempe" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Tempe Murni</h3>
                        <p class="text-gray-600 mb-4">Tempe berkualitas dari kedelai pilihan</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-500 font-bold">Rp 10.000</span>
                            <a href="https://wa.me/6281234567890" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
