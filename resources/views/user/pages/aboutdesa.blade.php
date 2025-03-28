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

      <!-- Dusun Section -->
      <div class="bg-blue-900 py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Wilayah Dusun</h2>
                <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-200 text-base sm:text-lg">Mengenal pembagian wilayah dusun di {{ $profile->judul ?? 'Desa Sumber Secang' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($profile && is_array($profile->dusun) && count($profile->dusun) > 0)
                    @foreach($profile->dusun as $index => $dusun)
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-white/20">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="p-3 bg-yellow-500 rounded-lg">
                                    <i class="fas fa-home text-blue-900 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Dusun {{ $dusun }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full">
                        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-8 shadow-lg text-center border border-white/20">
                            <div class="p-4 bg-yellow-500 rounded-lg inline-block mb-4">
                                <i class="fas fa-info-circle text-blue-900 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Informasi Dusun</h3>
                            <p class="text-gray-200">Data dusun belum tersedia</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistik Penduduk Section -->
    <div class="bg-white py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Statistik Penduduk</h2>
                <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg">Data statistik kependudukan {{ $profile->judul ?? 'Desa Sumber Secang' }}</p>
            </div>

            @php
                $totalPenduduk = \App\Models\Kependudukan::count();
                $totalLaki = \App\Models\Kependudukan::where('jenis_kelamin', 'Laki-Laki')->count();
                $totalPerempuan = \App\Models\Kependudukan::where('jenis_kelamin', 'Perempuan')->count();
                $totalKK = \App\Models\Kependudukan::distinct('no_kk')->count('no_kk');
                
                // Hitung berdasarkan status perkawinan
                $kawin = \App\Models\Kependudukan::where('status_perkawinan', 'Kawin')->count();
                $belumKawin = \App\Models\Kependudukan::where('status_perkawinan', 'Belum Kawin')->count();
                
                // Hitung berdasarkan agama
                $agamaStats = \App\Models\Kependudukan::select('agama', \DB::raw('count(*) as total'))
                    ->groupBy('agama')
                    ->get();
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Total Penduduk -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm">Total Penduduk</p>
                            <h3 class="text-3xl font-bold mt-1">{{ number_format($totalPenduduk) }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total KK -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm">Total KK</p>
                            <h3 class="text-3xl font-bold mt-1">{{ number_format($totalKK) }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-home text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Laki-laki -->
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm">Laki-laki</p>
                            <h3 class="text-3xl font-bold mt-1">{{ number_format($totalLaki) }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-male text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Perempuan -->
                <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm">Perempuan</p>
                            <h3 class="text-3xl font-bold mt-1">{{ number_format($totalPerempuan) }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-female text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Status Perkawinan -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Status Perkawinan</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Kawin</span>
                            <div class="flex items-center">
                                <span class="font-semibold">{{ number_format($kawin) }}</span>
                                <div class="w-24 h-2 bg-gray-200 rounded-full ml-4">
                                    <div class="h-2 bg-blue-500 rounded-full" style="width: {{ ($kawin / $totalPenduduk) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Belum Kawin</span>
                            <div class="flex items-center">
                                <span class="font-semibold">{{ number_format($belumKawin) }}</span>
                                <div class="w-24 h-2 bg-gray-200 rounded-full ml-4">
                                    <div class="h-2 bg-green-500 rounded-full" style="width: {{ ($belumKawin / $totalPenduduk) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Agama -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Agama</h3>
                    <div class="space-y-4">
                        @foreach($agamaStats as $agama)
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">{{ $agama->agama }}</span>
                                <div class="flex items-center">
                                    <span class="font-semibold">{{ number_format($agama->total) }}</span>
                                    <div class="w-24 h-2 bg-gray-200 rounded-full ml-4">
                                        <div class="h-2 bg-blue-500 rounded-full" style="width: {{ ($agama->total / $totalPenduduk) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
