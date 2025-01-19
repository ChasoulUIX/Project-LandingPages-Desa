@extends('user.layouts.app')

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
                        @foreach(App\Models\Struktur::all() as $struktur)
                            @if($struktur->jabatan == 'Kepala Desa')
                                <!-- Kepala Desa -->
                                <div class="bg-blue-900 text-white p-4 rounded-lg shadow-lg mb-8 w-64 text-center">
                                    <img src="{{ asset('images/'.$struktur->image) }}" alt="Kepala Desa" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                                    <h3 class="font-bold text-base">{{ $struktur->jabatan }}</h3>
                                    <p class="text-sm mt-1">{{ $struktur->nama }}</p>
                                </div>
                            @endif
                        @endforeach
                        
                        <!-- Vertical Line -->
                        <div class="h-12 w-0.5 bg-gray-300"></div>

                        <!-- Second Level -->
                            <div class="flex justify-center gap-8 mb-8">
                                @foreach(App\Models\Struktur::all() as $struktur)
                                @if($struktur->jabatan == 'Sekretaris Desa' || $struktur->jabatan == 'Bendahara Desa')
                                    <div class="bg-blue-800 text-white p-4 rounded-lg shadow-lg w-48 text-center">
                                        <img src="{{ asset('images/'.$struktur->image) }}" alt="{{ $struktur->jabatan }}" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                                        <h3 class="font-bold text-base">{{ $struktur->jabatan }}</h3>
                                        <p class="text-sm mt-1">{{ $struktur->nama }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Vertical Line -->
                        <div class="h-12 w-0.5 bg-gray-300"></div>

                        <!-- Third Level -->
                        <div class="flex justify-center gap-8 flex-wrap">
                            @foreach(App\Models\Struktur::all() as $struktur)
                                @if(in_array($struktur->jabatan, ['Kaur Umum', 'Kaur Keuangan', 'Kasi Pemerintahan', 'Kasi Kesejahteraan']))
                                    <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                                        <img src="{{ asset('images/'.$struktur->image) }}" alt="{{ $struktur->jabatan }}" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                                        <h3 class="font-bold text-base">{{ $struktur->jabatan }}</h3>
                                        <p class="text-sm mt-1">{{ $struktur->nama }}</p>
                                    </div>
                                @endif
                            @endforeach
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
                    @foreach(App\Models\Struktur::all() as $struktur)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                            <div class="relative h-80">
                                <img src="{{ asset('images/'.$struktur->image) }}" alt="{{ $struktur->jabatan }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-6 left-6 text-white">
                                    <h3 class="text-xl font-bold mb-1">{{ $struktur->nama }}</h3>
                                    <p class="text-sm opacity-90">{{ $struktur->jabatan }}</p>
                                    <div class="flex items-center mt-3 text-sm">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        <span>{{ $struktur->periode }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
