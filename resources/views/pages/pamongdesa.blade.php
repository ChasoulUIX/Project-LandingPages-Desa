@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Struktur Organisasi Tree -->
                <div class="text-center mb-16">
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Struktur Organisasi Desa</h1>
                    <div class="h-1 w-24 bg-yellow-500 mx-auto"></div>
                </div>

                <div class="relative">
                    <!-- Tree Structure -->
                    <div class="flex flex-col items-center">
                        <!-- Kepala Desa -->
                        <div class="bg-blue-900 text-white p-4 rounded-lg shadow-lg mb-8 w-64 text-center">
                            <img src="{{ asset('images/prabowo.jpg') }}" alt="Kepala Desa" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="font-bold">Kepala Desa</h3>
                        </div>
                        
                        <!-- Vertical Line -->
                        <div class="h-12 w-0.5 bg-gray-300"></div>

                        <!-- Second Level -->
                        <div class="flex justify-center gap-8 mb-8">
                            <div class="bg-blue-800 text-white p-4 rounded-lg shadow-lg w-48 text-center">
                                <img src="{{ asset('images/jokowi.jpg') }}" alt="Sekretaris Desa" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold">Sekretaris Desa</h3>
                            </div>
                        </div>

                        <!-- Vertical Line -->
                        <div class="h-12 w-0.5 bg-gray-300"></div>

                        <!-- Third Level -->
                        <div class="flex justify-center gap-8 flex-wrap">
                            <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                <img src="{{ asset('images/obama.jpg') }}" alt="Kaur Umum" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold">Kaur Umum</h3>
                            </div>
                            <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                <img src="{{ asset('images/joebiden.jpg') }}" alt="Kaur Keuangan" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold">Kaur Keuangan</h3>
                            </div>
                            <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                <img src="{{ asset('images/ronald.jpg') }}" alt="Kasi Pemerintahan" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold">Kasi Pemerintahan</h3>
                            </div>
                            <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                <img src="{{ asset('images/trump.jpg') }}" alt="Kasi Kesejahteraan" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold">Kasi Kesejahteraan</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Aparatur Desa -->
                <div class="mt-32">
                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-12">Aparatur Desa Sumber Secang</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Kepala Desa Card -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('images/prabowo.jpg') }}" alt="Kepala Desa" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Nama Kepala Desa</h3>
                                <p class="text-gray-600 mb-4">Kepala Desa</p>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>Masa Jabatan: 2021 - 2027</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sekretaris Desa Card -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('images/trump.jpg') }}" alt="Sekretaris Desa" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Nama Sekretaris</h3>
                                <p class="text-gray-600 mb-4">Sekretaris Desa</p>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>Masa Jabatan: 2021 - 2027</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kaur/Kasi Cards -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('images/joebiden.jpg') }}" alt="Kaur Umum" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Nama Kaur</h3>
                                <p class="text-gray-600 mb-4">Kaur Umum</p>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>Masa Jabatan: 2021 - 2027</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
