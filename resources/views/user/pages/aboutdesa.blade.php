@extends('user.layouts.app')

@section('content')
    @php
        $profile = \App\Models\ProfileDesa::first();
    @endphp
    
    <!-- Sejarah Desa Section -->
    <div class="bg-white py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Sejarah Desa</h2>
                <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg">{{ $profile->synopsis ?? 'Mengenal lebih dekat sejarah dan perkembangan Desa Sumber Secang' }}</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-blue-900">Asal Usul {{ $profile->judul ?? 'Desa Sumber Secang' }}</h3>
                    <div class="text-gray-600 leading-relaxed">
                        {!! $profile->deskripsi ?? 'Deskripsi belum tersedia' !!}
                    </div>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/' . ($profile->logo_image ?? 'probolinggo.png')) }}" alt="Sejarah Desa" class="rounded-2xl shadow-2xl w-1/3 md:w-1/2 h-1/3 md:h-1/2 mx-auto object-contain">
                    <div class="absolute -bottom-6 -right-6 bg-yellow-500 text-blue-900 px-8 py-4 rounded-xl shadow-lg">
                        <span class="font-bold">Est. {{ $profile->tahun_berdiri ?? '1945' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visi Misi Section -->
    <div class="bg-blue-900 py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Visi & Misi</h2>
                <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-200 text-base sm:text-lg">Komitmen kami dalam membangun desa yang maju, mandiri dan sejahtera</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Visi Card -->
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-8 shadow-lg hover:shadow-xl hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="p-3 bg-yellow-500 rounded-lg">
                            <i class="fas fa-eye text-blue-900 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Visi</h3>
                    </div>
                    <ul class="space-y-4 text-gray-200">
                        @if($profile && is_array($profile->visi))
                            @foreach($profile->visi as $visiItem)
                                <li class="flex items-start space-x-4">
                                    <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                        <i class="fas fa-check text-green-400"></i>
                                    </div>
                                    <span>{{ $visiItem }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-start space-x-4">
                                <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                    <i class="fas fa-check text-green-400"></i>
                                </div>
                                <span>Visi belum diisi</span>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Misi Card -->
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-8 shadow-lg hover:shadow-xl hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="p-3 bg-yellow-500 rounded-lg">
                            <i class="fas fa-bullseye text-blue-900 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Misi</h3>
                    </div>
                    <ul class="space-y-4 text-gray-200">
                        @if($profile && is_array($profile->misi))
                            @foreach($profile->misi as $misiItem)
                                <li class="flex items-start space-x-4">
                                    <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                        <i class="fas fa-check text-green-400"></i>
                                    </div>
                                    <span>{{ $misiItem }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-start space-x-4">
                                <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                    <i class="fas fa-check text-green-400"></i>
                                </div>
                                <span>Misi belum diisi</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Desa Section -->
    <div class="bg-white py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Kontak Kami</h2>
                <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg">Hubungi kami untuk informasi lebih lanjut</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-12">
                <!-- Email Card -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-envelope text-blue-900 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Email</h3>
                    <p class="text-gray-600 text-center">{{ $profile->email ?? 'Email belum diisi' }}</p>
                </div>

                <!-- Telepon Card -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-phone text-blue-900 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Telepon</h3>
                    <p class="text-gray-600 text-center">{{ $profile->telephone ?? 'Telepon belum diisi' }}</p>
                </div>

                <!-- Alamat Card -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-map-marker-alt text-blue-900 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Alamat</h3>
                    <p class="text-gray-600 text-center">{{ $profile->alamat ?? 'Alamat belum diisi' }}</p>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="w-full rounded-xl overflow-hidden shadow-lg">
                <div id="map" style="width:100%; height:450px;">
                    @php
                        $defaultMap = "https://www.google.com/maps?q=Sumbersecang,+Gading,+Probolinggo+Regency,+East+Java&output=embed";
                        $mapUrl = $profile->lokasi ?? $defaultMap;
                        
                        // Jika URL mengandung '/place/', konversi ke format embed
                        if (strpos($mapUrl, '/place/') !== false) {
                            $parts = explode('/place/', $mapUrl);
                            if (count($parts) > 1) {
                                $location = explode('/', $parts[1])[0];
                                $mapUrl = "https://www.google.com/maps?q=" . $location . "&output=embed";
                            }
                        }
                        
                        // Jika URL tidak mengandung 'output=embed', tambahkan parameter tersebut
                        if (strpos($mapUrl, 'output=embed') === false) {
                            $mapUrl .= (strpos($mapUrl, '?') !== false ? '&' : '?') . 'output=embed';
                        }
                    @endphp
                    <iframe 
                        src="{{ $mapUrl }}"
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full">
                    </iframe>
                </div>
                <div class="bg-white p-4">
                    <p class="text-gray-600 text-sm">
                        <i class="fas fa-map-marked-alt text-red-500 mr-2"></i>
                        {{ $profile->deskripsi ?? 'Luas wilayah Desa Sumber Secang adalah 486,2 hektar' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
