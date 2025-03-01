@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-0 overflow-x-hidden">
        <!-- Hero Section -->
        <div class="relative min-h-screen">
            <!-- Slideshow container -->
            <div class="relative h-screen">
                @php
                    $profile = App\Models\ProfileDesa::first();
                    $defaultImages = ['background_sawah.jpg', 'gunungsawah.jpg'];
                    $images = $profile && $profile->gallery_images ? 
                             (is_array($profile->gallery_images) ? $profile->gallery_images : json_decode($profile->gallery_images, true)) : 
                             $defaultImages;
                    $texts = $profile && $profile->gallery_texts ? 
                             (is_array($profile->gallery_texts) ? $profile->gallery_texts : json_decode($profile->gallery_texts, true)) : 
                             [];
                @endphp

                @if(is_array($images) && count($images) > 0)
                    @foreach($images as $index => $image)
                        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                            <div class="relative h-full" style="background-image: url('{{ asset('images/' . $image) }}'); background-size: cover; background-position: center;">
                                <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70"></div>
                                <div class="relative h-full flex items-center">
                                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                                        <div class="text-center space-y-8">
                                            <div class="animate-fade-in-down">
                                                @if(isset($texts[$index]) && !empty($texts[$index]))
                                                    <h1 class="text-5xl sm:text-7xl font-extrabold text-white leading-tight tracking-tight">
                                                        {{ $texts[$index] }}
                                                    </h1>
                                                @else
                                                    <h1 class="text-5xl sm:text-7xl font-extrabold text-white leading-tight tracking-tight">
                                                        Selamat Datang di
                                                        <span class="block mt-2 text-4xl sm:text-6xl bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-300">
                                                            Desa Sumber Secang
                                                        </span>
                                                    </h1>
                                                    <p class="mt-6 text-xl sm:text-2xl text-gray-300 max-w-2xl mx-auto leading-relaxed font-light">
                                                        Bangga dengan Desa tercinta kita
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Slide indicators -->
                    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        @foreach($images as $index => $image)
                            <span class="dot w-16 h-1 bg-white/30 backdrop-blur-sm cursor-pointer hover:bg-white/70 transition-all duration-300" onclick="currentSlide({{$index + 1}})"></span>
                        @endforeach
                    </div>
                @else
                    <!-- Default slide if no images -->
                    <div class="slide absolute inset-0 opacity-1">
                        <div class="relative h-full" style="background-image: url('{{ asset('images/background_sawah.jpg') }}'); background-size: cover; background-position: center;">
                            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70"></div>
                            <div class="relative h-full flex items-center">
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                                    <div class="text-center space-y-8">
                                        <div class="animate-fade-in-down">
                                            <h1 class="text-5xl sm:text-7xl font-extrabold text-white leading-tight tracking-tight">
                                                Selamat Datang di
                                                <span class="block mt-2 text-4xl sm:text-6xl bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-cyan-300">
                                                    Desa Sumber Secang
                                                </span>
                                            </h1>
                                            <p class="mt-6 text-xl sm:text-2xl text-gray-300 max-w-2xl mx-auto leading-relaxed font-light">
                                                Bangga dengan Desa tercinta kita
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Action buttons -->
            <div class="absolute bottom-24 left-1/2 transform -translate-x-1/2 flex flex-col sm:flex-row gap-4 sm:gap-6 w-full max-w-lg px-4">
                <a href="{{ url('/layanan') }}" class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-500 text-white px-8 py-4 rounded-xl hover:from-blue-500 hover:to-blue-400 transition duration-300 font-bold flex items-center justify-center space-x-3 shadow-lg hover:shadow-blue-500/30">
                    <span>Mulai Sekarang</span>
                    <i class="fas fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                </a>
                <a href="{{ url('/kontak') }}" class="w-full sm:w-auto bg-white/10 backdrop-blur-md border-2 border-white/30 text-white px-8 py-4 rounded-xl hover:bg-white hover:text-blue-900 transition duration-300 font-semibold flex items-center justify-center space-x-3">
                    <i class="fas fa-phone text-xl"></i>
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>

        <script>
            let slideIndex = 1;
            let autoSlideInterval;
            showSlides(slideIndex);

            function currentSlide(n) {
                showSlides(slideIndex = n);
                // Reset interval when manually changing slides
                clearInterval(autoSlideInterval);
                startAutoSlide();
            }

            function showSlides(n) {
                let slides = document.getElementsByClassName("slide");
                let dots = document.getElementsByClassName("dot");
                
                if (n > slides.length) {slideIndex = 1}
                if (n < 1) {slideIndex = slides.length}
                
                // Use requestAnimationFrame for smoother transitions
                requestAnimationFrame(() => {
                    for (let i = 0; i < slides.length; i++) {
                        slides[i].style.opacity = "0";
                        if (dots[i]) {
                            dots[i].classList.remove("bg-white");
                            dots[i].classList.add("bg-white/30");
                        }
                    }
                    
                    slides[slideIndex-1].style.opacity = "1";
                    if (dots[slideIndex-1]) {
                        dots[slideIndex-1].classList.remove("bg-white/30");
                        dots[slideIndex-1].classList.add("bg-white");
                    }
                });
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    slideIndex++;
                    if (slideIndex > document.getElementsByClassName("slide").length) {
                        slideIndex = 1;
                    }
                    showSlides(slideIndex);
                }, 5000);
            }

            // Start auto-sliding when the page loads
            document.addEventListener('DOMContentLoaded', startAutoSlide);

            // Pause auto-sliding when the user interacts with the slider
            document.querySelector('.slideshow-container').addEventListener('mouseover', () => {
                clearInterval(autoSlideInterval);
            });

            // Resume auto-sliding when the user stops interacting
            document.querySelector('.slideshow-container').addEventListener('mouseout', startAutoSlide);
        </script>

        <style>
            .animate-fade-in-down {
                animation: fadeInDown 1s ease-out;
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .slide {
                transition: opacity 1s ease-in-out;
            }
        </style>

        <!-- Sambutan Kepala Desa Section -->
        <div class="bg-gray-50 py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Kepala Desa Sumber Secang</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="relative">
                        @php
                            $sambutan = App\Models\Sambutan::first();
                        @endphp
                        @if($sambutan && $sambutan->image)
                            <img src="{{ asset('images/' . $sambutan->image) }}" alt="{{ $sambutan->nama }}" class="rounded-2xl shadow-2xl w-full h-[500px] object-cover">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image" class="rounded-2xl shadow-2xl w-full h-[500px] object-cover">
                        @endif
                        <div class="absolute -bottom-6 -right-6 bg-yellow-500 text-blue-900 px-8 py-4 rounded-xl shadow-lg">
                            <p class="font-bold">{{ $sambutan ? $sambutan->jabatan : 'Jabatan Belum Diisi' }}</p>
                            <p class="text-sm">Periode {{ $sambutan ? $sambutan->periode : 'Belum Diisi' }}</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-blue-900">{{ $sambutan ? $sambutan->nama : 'Nama Belum Diisi' }}</h3>
                        <div class="h-1 w-20 bg-yellow-500"></div>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $sambutan ? $sambutan->sambutan : 'Sambutan Belum Diisi' }}
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-1 bg-yellow-500"></div>
                                <div>
                                    <p class="font-bold text-blue-900">{{ $sambutan ? $sambutan->nama : 'Nama Belum Diisi' }}</p>
                                    <p class="text-gray-600">{{ $sambutan ? $sambutan->jabatan : 'Jabatan Belum Diisi' }}</p>
                                </div>
                            </div>
                            <a href="{{ url('/pamongdesa') }}" class="inline-flex items-center px-6 py-3 bg-blue-900 text-white rounded-xl hover:bg-blue-800 transition duration-300">
                                <span>Profil Desa</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
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

                @php
                    $profile = App\Models\ProfileDesa::first();
                @endphp

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


        <!-- Gallery Section -->
        <div class="bg-white py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Galeri Desa</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Jelajahi berbagai kegiatan, berita, dan produk unggulan Desa Sumber Secang</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Kegiatan Card -->
                    @foreach(App\Models\Kegiatan::latest()->take(1)->get() as $kegiatan)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-64">
                            <img src="{{ asset('images/' . $kegiatan->image) }}" alt="{{ $kegiatan->judul }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">{{ $kegiatan->judul }}</h3>
                                <p class="text-sm opacity-90">{{ $kegiatan->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-calendar-alt text-yellow-500"></i>
                                    <p class="text-gray-600">{{ $kegiatan->created_at->format('F j, Y') }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-users text-yellow-500"></i>
                                    <p class="text-gray-600">{{ $kegiatan->kategori }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-mosque text-yellow-500"></i>
                                    <p class="text-gray-600">{{ $kegiatan->lokasi }}</p>
                                </div>
                            </div>
                            <a href="{{ url('/galery') }}" class="mt-6 inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold group-hover:translate-x-2 transition duration-300">
                                <span>Lihat Semua Kegiatan</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                   
                  <!-- Aktivitas Card -->
                    @foreach(App\Models\Aktifitas::latest()->take(1)->get() as $aktivitas)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-64">
                            <img src="{{ asset('images/' . $aktivitas->image) }}" alt="{{ $aktivitas->judul }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">{{ $aktivitas->judul }}</h3>
                                <p class="text-sm opacity-90">{{ $aktivitas->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-calendar-alt text-yellow-500"></i>
                                    <p class="text-gray-600">{{ \Carbon\Carbon::parse($aktivitas->tgl_mulai)->format('F j, Y') }}</p>
                                </div>
                            </div>
                            <a href="{{ url('/aktivitas') }}" class="mt-6 inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold group-hover:translate-x-2 transition duration-300">
                                <span>Lihat Semua Aktivitas</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach

                        <!-- Berita Card -->
                        @foreach(App\Models\Berita::latest()->take(1)->get() as $berita)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                            <div class="relative h-64">
                                <img src="{{ asset('images/' . $berita->image) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <h3 class="text-xl font-bold">{{ $berita->judul }}</h3>
                                    <p class="text-sm opacity-90">{{ $berita->konten }}</p>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-4">
                                        <i class="fas fa-newspaper text-yellow-500"></i>
                                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($berita->tanggal)->format('F j, Y') }}</p>
                                    </div>
                                </div>
                                <a href="{{ url('/berita') }}" class="mt-6 inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold group-hover:translate-x-2 transition duration-300">
                                    <span>Lihat Semua Berita</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach

                        <!-- Produk Card -->
                        @foreach(App\Models\Produk::latest()->take(1)->get() as $produk)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                            <div class="relative h-64">
                                <img src="{{ asset('images/' . $produk->image) }}" alt="{{ $produk->nama }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <h3 class="text-xl font-bold">{{ $produk->nama }}</h3>
                                    <p class="text-sm opacity-90">{{ $produk->deskripsi }}</p>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-4">
                                        <i class="fas fa-store text-yellow-500"></i>
                                        <p class="text-gray-600">Kategori: {{ $produk->kategori }}</p>
                                    </div>
                                    <!-- <div class="flex items-center space-x-4">
                                        <i class="fas fa-calculator text-yellow-500"></i>
                                        <p class="text-gray-600">Harga: {{ $produk->harga }}</p>
                                    </div> -->
                                </div>
                                <a href="{{ url('/produk') }}" class="mt-6 inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold group-hover:translate-x-2 transition duration-300">
                                    <span>Lihat Semua Produk</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>

        <!-- Infografis Section -->
        <div class="bg-gray-50 py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Infografis Desa</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Visualisasi data penting tentang keuangan dan demografi desa</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6 sm:gap-8">
                    <!-- APBDES Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500 flex flex-col">
                        <div class="p-6 sm:p-8 flex-grow">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-calculator text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">APBDES / Dana Desa</h3>
                            <div class="aspect-square relative">
                                <canvas id="kategoriChart"></canvas>
                            </div>
                            <div class="mt-6 space-y-3">
                                @php
                                    $totalDana = \App\Models\DanaDesa::sum('nominal');
                                @endphp
                                @foreach(\App\Models\DanaDesa::select('sumber_anggaran')
                                    ->selectRaw('sum(nominal) as total')
                                    ->groupBy('sumber_anggaran')
                                    ->get() as $dana)
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">{{ $dana->sumber_anggaran }}</span>
                                        <span class="font-medium">{{ $totalDana > 0 ? round(($dana->total / $totalDana) * 100) : 0 }}%</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-6 sm:p-8">
                            <a href="{{ url('/layanan/danadesa') }}" class="inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold transition duration-300">
                                <span>Lihat Detail APBDES</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Demografi Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500 flex flex-col">
                        <div class="p-6 sm:p-8 flex-grow">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-users text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">Demografi Penduduk</h3>
                            @php
                                $laki = App\Models\Kependudukan::where('jenis_kelamin', 'Laki-laki')->count();
                                $perempuan = App\Models\Kependudukan::where('jenis_kelamin', 'Perempuan')->count();
                                $total = App\Models\Kependudukan::count();
                            @endphp
                            <div class="aspect-square relative">
                                <canvas id="genderChart"></canvas>
                            </div>
                            <div class="mt-6 space-y-3">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Laki-laki</span>
                                    <span class="font-medium">{{ $total > 0 ? round(($laki / $total) * 100) : 0 }}%</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Perempuan</span>
                                    <span class="font-medium">{{ $total > 0 ? round(($perempuan / $total) * 100) : 0 }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 sm:p-8">
                            <a href="{{ url('/datakependudukan') }}" class="inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold transition duration-300">
                                <span>Lihat Detail Demografi</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Data untuk APBDES Chart
                const apbdesData = {
                    labels: [
                        @foreach(\App\Models\DanaDesa::select('sumber_anggaran')
                            ->selectRaw('sum(nominal) as total')
                            ->groupBy('sumber_anggaran')
                            ->get() as $dana)
                            '{{ $dana->sumber_anggaran }}',
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach(\App\Models\DanaDesa::select('sumber_anggaran')
                                ->selectRaw('sum(nominal) as total')
                                ->groupBy('sumber_anggaran')
                                ->get() as $dana)
                                {{ $totalDana > 0 ? round(($dana->total / $totalDana) * 100) : 0 }},
                            @endforeach
                        ],
                        backgroundColor: [
                            '#1E40AF', // Blue-800
                            '#EAB308', // Yellow-500
                            '#059669', // Green-600
                            '#DC2626', // Red-600
                            '#7C3AED', // Purple-600
                            '#2563EB'  // Blue-600
                        ],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                };

                // Konfigurasi chart
                const chartConfig = {
                    type: 'doughnut',
                    data: apbdesData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.raw}%`;
                                    }
                                },
                                padding: 12,
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                titleFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                bodyFont: {
                                    size: 13
                                }
                            }
                        },
                        cutout: '75%',
                        animation: {
                            animateScale: true,
                            animateRotate: true,
                            duration: 2000
                        }
                    }
                };

                // Inisialisasi chart
                const ctx = document.getElementById('kategoriChart').getContext('2d');
                const apbdesChart = new Chart(ctx, chartConfig);

                // Fungsi untuk membuat custom legend dengan interaksi hover
                function createCustomLegend() {
                    const legendContainer = document.querySelector('.mt-6.space-y-3');
                    const legendItems = legendContainer.querySelectorAll('div');

                    legendItems.forEach((item, index) => {
                        // Tambahkan warna background sesuai dengan chart
                        const colorBox = document.createElement('span');
                        colorBox.className = 'inline-block w-3 h-3 rounded-full mr-2';
                        colorBox.style.backgroundColor = apbdesData.datasets[0].backgroundColor[index];
                        item.insertBefore(colorBox, item.firstChild);

                        // Tambahkan event listener untuk hover
                        item.addEventListener('mouseenter', () => {
                            apbdesChart.setActiveElements([{datasetIndex: 0, index: index}]);
                            apbdesChart.update();
                        });

                        item.addEventListener('mouseleave', () => {
                            apbdesChart.setActiveElements([]);
                            apbdesChart.update();
                        });

                        // Tambahkan style untuk interaktivitas
                        item.classList.add('cursor-pointer', 'hover:bg-gray-50', 'p-2', 'rounded-lg', 'transition-colors', 'duration-300');
                    });
                }

                // Panggil fungsi untuk membuat legend
                createCustomLegend();

                // Responsive update saat resize window
                window.addEventListener('resize', () => {
                    apbdesChart.resize();
                });

                // Data untuk Gender Chart
                const genderData = {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $laki }}, {{ $perempuan }}],
                        backgroundColor: [
                            '#1E40AF', // Blue-800 untuk laki-laki
                            '#EC4899'  // Pink-500 untuk perempuan
                        ],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                };

                // Konfigurasi Gender Chart
                const genderConfig = {
                    type: 'doughnut',
                    data: genderData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.raw;
                                        const total = {{ App\Models\Kependudukan::count() }};
                                        const percentage = Math.round((value / total) * 100);
                                        return `${context.label}: ${value} (${percentage}%)`;
                                    }
                                },
                                padding: 12,
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                titleFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                bodyFont: {
                                    size: 13
                                }
                            }
                        },
                        cutout: '75%',
                        animation: {
                            animateScale: true,
                            animateRotate: true,
                            duration: 2000
                        }
                    }
                };

                // Inisialisasi Gender Chart
                const genderCtx = document.getElementById('genderChart').getContext('2d');
                const genderChart = new Chart(genderCtx, genderConfig);

                // Fungsi untuk membuat custom legend dengan interaksi hover untuk Gender Chart
                function createGenderLegend() {
                    const legendContainer = document.querySelector('.gender-legend');
                    if (!legendContainer) return;

                    const legendItems = legendContainer.querySelectorAll('div');

                    legendItems.forEach((item, index) => {
                        // Tambahkan warna background sesuai dengan chart
                        const colorBox = document.createElement('span');
                        colorBox.className = 'inline-block w-3 h-3 rounded-full mr-2';
                        colorBox.style.backgroundColor = genderData.datasets[0].backgroundColor[index];
                        item.insertBefore(colorBox, item.firstChild);

                        // Tambahkan event listener untuk hover
                        item.addEventListener('mouseenter', () => {
                            genderChart.setActiveElements([{datasetIndex: 0, index: index}]);
                            genderChart.update();
                        });

                        item.addEventListener('mouseleave', () => {
                            genderChart.setActiveElements([]);
                            genderChart.update();
                        });

                        // Tambahkan style untuk interaktivitas
                        item.classList.add('cursor-pointer', 'hover:bg-gray-50', 'p-2', 'rounded-lg', 'transition-colors', 'duration-300');
                    });
                }

                // Panggil fungsi untuk membuat legend
                createGenderLegend();

                // Responsive update saat resize window
                window.addEventListener('resize', () => {
                    genderChart.resize();
                });
            });
        </script>

         <!-- Features Section -->
         <div class="bg-white pt-20 sm:pt-32 pb-16 sm:pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Layanan Unggulan</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Nikmati berbagai layanan digital yang kami sediakan untuk memudahkan urusan administrasi dan pelayanan publik di desa Anda</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- Feature Card 1 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500 flex flex-col">
                        <div class="p-6 sm:p-8 flex-grow">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-file-alt text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">Administrasi Digital</h3>
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
                        <div class="p-6 sm:p-8 mt-auto border-t">
                            <a href="{{ url('/layanan') }}" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500 flex flex-col">
                        <div class="p-6 sm:p-8 flex-grow">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-bullhorn text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">Informasi & Pengumuman</h3>
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
                        <div class="p-6 sm:p-8 mt-auto border-t">
                            <a href="{{ url('/informasidesa') }}" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500 flex flex-col">
                        <div class="p-6 sm:p-8 flex-grow">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-comments text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">Aspirasi Masyarakat</h3>
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
                        <div class="p-6 sm:p-8 mt-auto border-t">
                            <a href="{{ url('/pengaduan') }}" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aparatur Desa Section -->
        <div class="bg-gray-50 py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Aparatur Desa</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Kenali lebih dekat para aparatur yang melayani Desa Sumber Secang</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    @foreach(App\Models\Struktur::all() as $struktur)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                            <div class="relative h-80">
                                <img src="{{ asset('images/' . $struktur->image) }}" alt="{{ $struktur->jabatan }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <h3 class="text-lg font-bold">{{ $struktur->nama }}</h3>
                                    <p class="text-sm opacity-90">{{ $struktur->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-center items-center mt-8 w-full">
                    <a href="{{ url('/pamongdesa') }}" class="inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold transition duration-300">
                        <span>Lihat Semua Aparatur Desa</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Desa Section -->
        <div class="bg-white py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Tentang Kami</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">{{ $profile->synopsis ?? 'Hubungi kami untuk informasi lebih lanjut tentang Desa Sumber Secang' }}</p>
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
                        @if($profile && $profile->lokasi)
                            <iframe 
                                src="https://www.google.com/maps?q=Wangkal,+Gading,+Probolinggo+Regency,+East+Java&output=embed"
                                width="100%" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="w-full">
                            </iframe>
                        @else
                            <iframe 
                                src="https://www.google.com/maps?q=Wangkal,+Gading,+Probolinggo+Regency,+East+Java&output=embed"
                                width="100%" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="w-full">
                            </iframe>
                        @endif
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

        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js').then(function(registration) {
                        console.log('ServiceWorker registration successful');
                    }, function(err) {
                        console.log('ServiceWorker registration failed: ', err);
                    });
                });
            }
        </script>

    </main>
@endsection
