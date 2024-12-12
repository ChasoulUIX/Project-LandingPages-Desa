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
                            <h3 class="font-bold text-base">Kepala Desa</h3>
                            <p class="text-sm mt-1">Prabowo Subianto</p>
                        </div>
                        
                        <!-- Vertical Line -->
                        <div class="h-12 w-0.5 bg-gray-300"></div>

                        <!-- Second Level -->
                        <div class="flex justify-center gap-8 mb-8">
                            <div class="bg-blue-800 text-white p-4 rounded-lg shadow-lg w-48 text-center">
                                <img src="{{ asset('images/jokowi.jpg') }}" alt="Sekretaris Desa" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold text-base">Sekretaris Desa</h3>
                                <p class="text-sm mt-1">Joko Widodo</p>
                            </div>
                            <div class="bg-blue-800 text-white p-4 rounded-lg shadow-lg w-48 text-center">
                                <img src="{{ asset('images/joebiden.jpg') }}" alt="Bendahara Desa" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold text-base">Bendahara Desa</h3>
                                <p class="text-sm mt-1">Joe Biden</p>
                            </div>
                        </div>

                        <!-- Vertical Line -->
                        <div class="h-12 w-0.5 bg-gray-300"></div>

                        <!-- Third Level -->
                        <div class="flex justify-center gap-8 flex-wrap">
                            <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                <img src="{{ asset('images/obama.jpg') }}" alt="Kaur Umum" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold text-base">Kaur Umum</h3>
                                <p class="text-sm mt-1">Barack Obama</p>
                            </div>
                            <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                <img src="{{ asset('images/joebiden.jpg') }}" alt="Kaur Keuangan" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold text-base">Kaur Keuangan</h3>
                                <p class="text-sm mt-1">Hillary Clinton</p>
                            </div>
                            <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                <img src="{{ asset('images/ronald.jpg') }}" alt="Kasi Pemerintahan" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold text-base">Kasi Pemerintahan</h3>
                                <p class="text-sm mt-1">Ronald Reagan</p>
                            </div>
                            <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                <img src="{{ asset('images/trump.jpg') }}" alt="Kasi Kesejahteraan" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                <h3 class="font-bold text-base">Kasi Kesejahteraan</h3>
                                <p class="text-sm mt-1">Donald Trump</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Aparatur Desa -->
        <div class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Aparatur Desa Sumber Secang</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Mengenal lebih dekat para pemimpin desa yang mengabdi untuk masyarakat</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Kepala Desa Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/prabowo.jpg') }}" alt="Kepala Desa" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-bold mb-1">Prabowo Subianto</h3>
                                <p class="text-sm opacity-90">Kepala Desa</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>2021 - 2027</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sekretaris Desa Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/trump.jpg') }}" alt="Sekretaris Desa" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-bold mb-1">Donald Trump</h3>
                                <p class="text-sm opacity-90">Sekretaris Desa</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>2021 - 2027</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kaur Umum Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/joebiden.jpg') }}" alt="Kaur Umum" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-bold mb-1">Joe Biden</h3>
                                <p class="text-sm opacity-90">Kaur Umum</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>2021 - 2027</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kaur Keuangan Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/obama.jpg') }}" alt="Kaur Keuangan" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-bold mb-1">Barack Obama</h3>
                                <p class="text-sm opacity-90">Kaur Keuangan</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>2021 - 2027</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Pemerintahan Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/ronald.jpg') }}" alt="Kasi Pemerintahan" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-bold mb-1">Ronald Reagan</h3>
                                <p class="text-sm opacity-90">Kasi Pemerintahan</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>2021 - 2027</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Kesejahteraan Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/trump.jpg') }}" alt="Kasi Kesejahteraan" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-bold mb-1">Donald Trump</h3>
                                <p class="text-sm opacity-90">Kasi Kesejahteraan</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>2021 - 2027</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Pelayanan Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/jokowi.jpg') }}" alt="Kasi Pelayanan" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-bold mb-1">Joko Widodo</h3>
                                <p class="text-sm opacity-90">Kasi Pelayanan</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>2021 - 2027</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Pembangunan Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/joebiden.jpg') }}" alt="Kasi Pembangunan" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-bold mb-1">Joe Biden</h3>
                                <p class="text-sm opacity-90">Kasi Pembangunan</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>2021 - 2027</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
