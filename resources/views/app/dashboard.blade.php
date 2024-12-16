@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10 overflow-x-hidden">
        <!-- Hero Section -->
        <div class="relative min-h-screen">
            <!-- Slideshow container -->
            <div class="relative h-screen">
                <!-- Slide 1 -->
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
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

                <!-- Slide 2 -->
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                    <div class="relative h-full" style="background-image: url('{{ asset('images/gunungsawah.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70"></div>
                        <div class="relative h-full flex items-center">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                                <div class="text-center space-y-8">
                                    <div class="animate-fade-in-down">
                                        <h2 class="text-5xl sm:text-7xl font-extrabold text-white tracking-tight">
                                            Kabupaten Probolinggo
                                        </h2>
                                        <p class="mt-6 text-xl sm:text-2xl text-gray-300 max-w-2xl mx-auto font-light">
                                            Desa Cerdas, Desa Kuat, Desa Maju!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide indicators -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    <span class="dot w-16 h-1 bg-white/30 backdrop-blur-sm cursor-pointer hover:bg-white/70 transition-all duration-300"></span>
                    <span class="dot w-16 h-1 bg-white/30 backdrop-blur-sm cursor-pointer hover:bg-white/70 transition-all duration-300"></span>
                </div>
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
            showSlides(slideIndex);

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                let i;
                let slides = document.getElementsByClassName("slide");
                let dots = document.getElementsByClassName("dot");
                
                if (n > slides.length) {slideIndex = 1}
                if (n < 1) {slideIndex = slides.length}
                
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.opacity = "0";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].classList.remove("bg-white");
                    dots[i].classList.add("bg-white/30");
                }
                
                slides[slideIndex-1].style.opacity = "1";
                dots[slideIndex-1].classList.remove("bg-white/30");
                dots[slideIndex-1].classList.add("bg-white");
            }

            // Auto slide with fade effect
            setInterval(() => {
                currentSlide(slideIndex + 1);
            }, 5000);
        </script>

        <!-- Sambutan Kepala Desa Section -->
        <div class="bg-gray-50 py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Kepala Desa Sumber Secang</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="relative">
                        <img src="{{ asset('images/prabowo.jpg') }}" alt="Foto Kepala Desa" class="rounded-2xl shadow-2xl w-full h-[500px] object-cover">
                        <div class="absolute -bottom-6 -right-6 bg-yellow-500 text-blue-900 px-8 py-4 rounded-xl shadow-lg">
                            <p class="font-bold">Kepala Desa</p>
                            <p class="text-sm">Periode 2024-2029</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-blue-900">H. Muhammad Sholeh</h3>
                        <div class="h-1 w-20 bg-yellow-500"></div>
                        <p class="text-gray-600 leading-relaxed">
                            Assalamualaikum Wr. Wb.
                            <br><br>
                            Puji syukur kita panjatkan kepada Allah SWT yang telah memberikan rahmat dan karunia-Nya kepada kita semua. Selamat datang di website resmi Desa Sumber Secang, Kecamatan Sumber, Kabupaten Probolinggo.
                            <br><br>
                            Website ini merupakan salah satu media informasi dan komunikasi antara pemerintah desa dengan masyarakat. Melalui website ini, kami berharap dapat memberikan pelayanan informasi yang lebih baik dan terciptanya good governance dalam pemerintahan desa.
                            <br><br>
                            Mari bersama-sama kita bangun Desa Sumber Secang menjadi desa yang maju, mandiri, dan sejahtera.
                            <br><br>
                            Wassalamualaikum Wr. Wb.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-1 bg-yellow-500"></div>
                                <div>
                                    <p class="font-bold text-blue-900">H. Muhammad Sholeh</p>
                                    <p class="text-gray-600">Kepala Desa Sumber Secang</p>
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

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Visi Card -->
                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-8 shadow-lg hover:shadow-xl hover:bg-white/20 transition-all duration-300 border border-white/20">
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="p-3 bg-yellow-500 rounded-lg">
                                <i class="fas fa-eye text-blue-900 text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Visi</h3>
                        </div>
                        <p class="text-gray-200 leading-relaxed">
                            "Terwujudnya Desa yang Maju, Mandiri, dan Sejahtera Berbasis Pertanian dan Teknologi Digital dengan Tetap Menjaga Nilai-nilai Budaya dan Kearifan Lokal"
                        </p>
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
                            <li class="flex items-start space-x-4">
                                <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                    <i class="fas fa-check text-green-400"></i>
                                </div>
                                <span>Meningkatkan kualitas pelayanan publik melalui digitalisasi administrasi desa</span>
                            </li>
                            <li class="flex items-start space-x-4">
                                <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                    <i class="fas fa-check text-green-400"></i>
                                </div>
                                <span>Mengembangkan sektor pertanian dengan teknologi modern dan ramah lingkungan</span>
                            </li>
                            <li class="flex items-start space-x-4">
                                <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                    <i class="fas fa-check text-green-400"></i>
                                </div>
                                <span>Memberdayakan UMKM dan potensi ekonomi lokal untuk kesejahteraan masyarakat</span>
                            </li>
                            <li class="flex items-start space-x-4">
                                <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                    <i class="fas fa-check text-green-400"></i>
                                </div>
                                <span>Melestarikan dan mengembangkan nilai-nilai budaya serta kearifan lokal</span>
                            </li>
                            <li class="flex items-start space-x-4">
                                <div class="bg-green-500/20 p-2 rounded-lg mt-1">
                                    <i class="fas fa-check text-green-400"></i>
                                </div>
                                <span>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan</span>
                            </li>
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
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-64">
                            <img src="{{ asset('images/galery1.jpg') }}" alt="Kegiatan Desa" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">Kegiatan Desa</h3>
                                <p class="text-sm opacity-90">Dokumentasi kegiatan terkini</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-calendar-alt text-yellow-500"></i>
                                    <p class="text-gray-600">Gotong Royong Mingguan</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-users text-yellow-500"></i>
                                    <p class="text-gray-600">Pertemuan PKK</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-mosque text-yellow-500"></i>
                                    <p class="text-gray-600">Pengajian Rutin</p>
                                </div>
                            </div>
                            <a href="{{ url('/galery') }}" class="mt-6 inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold group-hover:translate-x-2 transition duration-300">
                                <span>Lihat Semua Kegiatan</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Berita Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-64">
                            <img src="{{ asset('images/perbaikan_jalan.jpg') }}" alt="Berita Desa" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">Berita Desa</h3>
                                <p class="text-sm opacity-90">Informasi terkini</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-newspaper text-yellow-500"></i>
                                    <p class="text-gray-600">Pembangunan Infrastruktur</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-bullhorn text-yellow-500"></i>
                                    <p class="text-gray-600">Pengumuman Desa</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-award text-yellow-500"></i>
                                    <p class="text-gray-600">Prestasi Warga</p>
                                </div>
                            </div>
                            <a href="{{ url('/berita') }}" class="mt-6 inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold group-hover:translate-x-2 transition duration-300">
                                <span>Lihat Semua Berita</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Produk Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="relative h-64">
                            <img src="{{ asset('images/madu.jpg') }}" alt="Produk Desa" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">Produk UMKM</h3>
                                <p class="text-sm opacity-90">Produk unggulan desa</p>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-store text-yellow-500"></i>
                                    <p class="text-gray-600">Kerajinan Tangan</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-utensils text-yellow-500"></i>
                                    <p class="text-gray-600">Kuliner Tradisional</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-seedling text-yellow-500"></i>
                                    <p class="text-gray-600">Hasil Pertanian</p>
                                </div>
                            </div>
                            <a href="{{ url('/produk') }}" class="mt-6 inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold group-hover:translate-x-2 transition duration-300">
                                <span>Lihat Semua Produk</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Infografis Section -->
        <div class="bg-gray-50 py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Infografis Desa</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Visualisasi data penting tentang keuangan, demografi, dan bantuan sosial desa</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- APBDES Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500 flex flex-col">
                        <div class="p-6 sm:p-8 flex-grow">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-chart-pie text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">APBDES / Dana Desa</h3>
                            <div class="aspect-square relative">
                                <canvas id="apbdesChart" width="400" height="400"></canvas>
                            </div>
                            <div class="mt-6 space-y-3" id="apbdesLegend"></div>
                        </div>
                        <div class="p-6 sm:p-8">
                            <a href="{{ url('/apbdes') }}" class="inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold transition duration-300">
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
                            <div class="aspect-square relative">
                                <canvas id="demografiChart" width="400" height="400"></canvas>
                            </div>
                            <div class="mt-6 space-y-3" id="demografiLegend"></div>
                        </div>
                        <div class="p-6 sm:p-8">
                            <a href="{{ url('/demografi') }}" class="inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold transition duration-300">
                                <span>Lihat Detail Demografi</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Bantuan Sosial Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500 flex flex-col">
                        <div class="p-6 sm:p-8 flex-grow">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-900 rounded-xl flex items-center justify-center mb-6 group-hover:bg-yellow-500 transition duration-300">
                                <i class="fas fa-hands-helping text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">Bantuan Sosial</h3>
                            <div class="aspect-square relative">
                                <canvas id="bantuanChart" width="400" height="400"></canvas>
                            </div>
                            <div class="mt-6 space-y-3" id="bantuanLegend"></div>
                        </div>
                        <div class="p-6 sm:p-8">
                            <a href="{{ url('/bantuan-sosial') }}" class="inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold transition duration-300">
                                <span>Lihat Detail Bantuan</span>
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
                        'Pembangunan Infrastruktur',
                        'Pemberdayaan Masyarakat',
                        'Operasional Desa',
                        'Pendidikan',
                        'Kesehatan',
                        'Lainnya'
                    ],
                    datasets: [{
                        data: [35, 25, 15, 10, 10, 5],
                        backgroundColor: [
                            '#1E3A8A', // Blue
                            '#EAB308', // Yellow
                            '#64748B', // Slate
                            '#059669', // Green
                            '#DC2626', // Red
                            '#7C3AED'  // Purple
                        ],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                };

                // Data untuk Demografi Chart
                const demografiData = {
                    labels: [
                        'Laki-laki Dewasa',
                        'Perempuan Dewasa',
                        'Remaja',
                        'Anak-anak',
                        'Lansia'
                    ],
                    datasets: [{
                        data: [30, 28, 20, 15, 7],
                        backgroundColor: [
                            '#1E3A8A',
                            '#EAB308',
                            '#059669',
                            '#DC2626',
                            '#7C3AED'
                        ],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                };

                // Data untuk Bantuan Chart
                const bantuanData = {
                    labels: [
                        'PKH',
                        'BPNT',
                        'BLT DD',
                        'PIP',
                        'KIS',
                        'BPUM'
                    ],
                    datasets: [{
                        data: [25, 20, 15, 15, 15, 10],
                        backgroundColor: [
                            '#1E3A8A',
                            '#EAB308',
                            '#64748B',
                            '#059669',
                            '#DC2626',
                            '#7C3AED'
                        ],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                };

                const chartConfig = {
                    type: 'doughnut',
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

                // Fungsi untuk membuat legend custom dengan animasi hover
                function createCustomLegend(data, elementId) {
                    const legendContainer = document.getElementById(elementId);
                    legendContainer.innerHTML = '';
                    
                    data.labels.forEach((label, index) => {
                        const div = document.createElement('div');
                        div.className = 'flex items-center justify-between text-sm p-2 rounded-lg transition-all duration-300 hover:bg-gray-100 cursor-pointer';
                        div.innerHTML = `
                            <div class="flex items-center">
                                <span class="w-4 h-4 rounded-full mr-3 transition-transform duration-300 hover:scale-110" 
                                      style="background-color: ${data.datasets[0].backgroundColor[index]}"></span>
                                <span class="text-gray-700 font-medium">${label}</span>
                            </div>
                            <span class="font-bold text-blue-900">${data.datasets[0].data[index]}%</span>
                        `;
                        
                        // Hover effect untuk highlight chart segment
                        div.addEventListener('mouseenter', () => {
                            const chart = Chart.getChart(elementId.replace('Legend', 'Chart'));
                            chart.setActiveElements([{datasetIndex: 0, index: index}]);
                            chart.update();
                        });
                        
                        div.addEventListener('mouseleave', () => {
                            const chart = Chart.getChart(elementId.replace('Legend', 'Chart'));
                            chart.setActiveElements([]);
                            chart.update();
                        });
                        
                        legendContainer.appendChild(div);
                    });
                }

                // Inisialisasi Charts dengan animasi
                const apbdesChart = new Chart(document.getElementById('apbdesChart'), {
                    ...chartConfig,
                    data: apbdesData
                });
                createCustomLegend(apbdesData, 'apbdesLegend');

                const demografiChart = new Chart(document.getElementById('demografiChart'), {
                    ...chartConfig,
                    data: demografiData
                });
                createCustomLegend(demografiData, 'demografiLegend');

                const bantuanChart = new Chart(document.getElementById('bantuanChart'), {
                    ...chartConfig,
                    data: bantuanData
                });
                createCustomLegend(bantuanData, 'bantuanLegend');
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
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="p-6 sm:p-8">
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
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8">
                            <a href="{{ url('/layanan') }}" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="p-6 sm:p-8">
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
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8">
                            <a href="{{ url('/informasidesa') }}" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition duration-500">
                        <div class="p-6 sm:p-8">
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
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8">
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
                    <!-- Sekretaris Desa -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/obama.jpg') }}" alt="Sekretaris Desa" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-lg font-bold">Ahmad Fauzi</h3>
                                <p class="text-sm opacity-90">Sekretaris Desa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kaur Keuangan -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/joebiden.jpg') }}" alt="Kaur Keuangan" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-lg font-bold">Siti Aminah</h3>
                                <p class="text-sm opacity-90">Kaur Keuangan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kaur Umum -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/ronald.jpg') }}" alt="Kaur Umum" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-lg font-bold">Abdul Rahman</h3>
                                <p class="text-sm opacity-90">Kaur Umum</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Pemerintahan -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/trump.jpg') }}" alt="Kasi Pemerintahan" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-lg font-bold">Muhammad Rizki</h3>
                                <p class="text-sm opacity-90">Kasi Pemerintahan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Kesejahteraan -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/prabowo.jpg') }}" alt="Kasi Kesejahteraan" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-lg font-bold">Dewi Safitri</h3>
                                <p class="text-sm opacity-90">Kasi Kesejahteraan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Pelayanan -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/jokowi.jpg') }}" alt="Kasi Pelayanan" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-lg font-bold">Hendra Wijaya</h3>
                                <p class="text-sm opacity-90">Kasi Pelayanan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Pelayanan -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/jokowi.jpg') }}" alt="Kasi Pelayanan" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-lg font-bold">Hendra Wijaya</h3>
                                <p class="text-sm opacity-90">Kasi Pelayanan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kasi Pelayanan -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition duration-500">
                        <div class="relative h-80">
                            <img src="{{ asset('images/jokowi.jpg') }}" alt="Kasi Pelayanan" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-lg font-bold">Hendra Wijaya</h3>
                                <p class="text-sm opacity-90">Kasi Pelayanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center items-center mt-8 w-full">
                        <a href="{{ url('/pamongdesa') }}" class="inline-flex items-center text-blue-900 hover:text-yellow-500 font-semibold transition duration-300">
                            <span>Lihat Semua Aparatur Desa</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Desa Section -->
        <div class="bg-white py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Tentang Kami</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Hubungi kami untuk informasi lebih lanjut tentang Desa Sumber Secang</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <!-- Email Card -->
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-envelope text-blue-900 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Email</h3>
                        <p class="text-gray-600 text-center">desa.sumbersecang@gmail.com</p>
                    </div>

                    <!-- Telepon Card -->
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-phone text-blue-900 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Telepon</h3>
                        <p class="text-gray-600 text-center">(0335) 123456</p>
                    </div>

                    <!-- Alamat Card -->
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <i class="fas fa-map-marker-alt text-blue-900 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Alamat</h3>
                        <p class="text-gray-600 text-center">Jl. Raya Sumber Secang No. 123, Kec. Sumber, Kab. Probolinggo</p>
                    </div>
                </div>

                <!-- Google Maps -->
                <div class="w-full rounded-xl overflow-hidden shadow-lg">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15810.927876840095!2d113.37544673476563!3d-7.837782099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6ff7e322d8fe3%3A0x761642564682d2ab!2sSumbersecang%2C%20Kec.%20Gading%2C%20Kabupaten%20Probolinggo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1709799051099!5m2!1sid!2sid"
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        class="w-full">
                    </iframe>
                    <div class="bg-white p-4">
                        <p class="text-gray-600 text-sm">
                            <i class="fas fa-map-marked-alt text-red-500 mr-2"></i>
                            Luas wilayah Desa Sumber Secang adalah 486,2 hektar
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
