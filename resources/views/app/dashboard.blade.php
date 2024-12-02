@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-b from-blue-900 to-blue-800 min-h-screen" style="background-image: url('{{ asset('images/background_sawah.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="absolute inset-0 hero-pattern opacity-10"></div>
            <div class="relative h-screen flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="grid md:grid-cols-2 gap-4 md:gap-16 items-center">
                        <div class="block md:block">
                            <img src="{{ asset('images/Logo_kab_probolinggo.png') }}" alt="Logo Kabupaten Probolinggo" class="w-1/3 md:w-1/2 h-1/3 md:h-1/2 mx-auto object-contain rounded-3xl shadow-2xl transform hover:scale-105 transition duration-500 backdrop-blur-sm bg-white/10 p-3">
                        </div>
                        <div class="text-center md:text-left space-y-4 md:space-y-8">
                            <h1 class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                                Selamat Datang di<br>
                                <span class="text-xl sm:text-2xl md:text-4xl lg:text-5xl text-blue-400">Desa Sumber Secang</span>
                            </h1>
                            <p class="text-sm sm:text-base md:text-xl text-white max-w-2xl leading-relaxed">
                               Bangga dengan Desa tercinta kita
                               <br>
                               Desa Cerdas, Desa Kuat, Desa Maju!
                            </p>
                            <div class="flex flex-row justify-center md:justify-start space-x-3 md:space-x-4">
                                <a href="#" class="bg-blue-500 text-white px-4 sm:px-8 py-2 sm:py-4 rounded-lg hover:bg-blue-400 transition duration-300 font-bold text-xs sm:text-base flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <span>Mulai Sekarang</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="{{ url('/kontak') }}" class="bg-white/10 backdrop-blur-sm border-2 border-white text-white px-4 sm:px-8 py-2 sm:py-4 rounded-lg hover:bg-white hover:text-blue-900 transition duration-300 font-semibold text-xs sm:text-base flex items-center justify-center space-x-2">
                                    <i class="fas fa-phone text-lg md:text-xl"></i>
                                    <span>Hubungi Kami</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Desa Section -->
        <div class="bg-white py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Profil Desa</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Mengenal lebih dekat Desa Sumber Secang dengan segala potensi, budaya, dan keunikannya</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                            <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                                <i class="fas fa-map-marker-alt text-yellow-500 mr-3"></i>
                                Letak Geografis
                            </h3>
                            <p class="text-gray-600">Desa Sumber Secang terletak di Kecamatan Sumber, Kabupaten Probolinggo, Jawa Timur pada ketinggian 100-500 mdpl. Berbatasan dengan Desa Mentor di utara, Desa Sumberanyar di selatan, Desa Sumberwuluh di timur, dan Desa Sumberarum di barat. Memiliki luas wilayah 425 hektar dengan kontur tanah yang subur.</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                            <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                                <i class="fas fa-users text-yellow-500 mr-3"></i>
                                Masyarakat & Budaya
                            </h3>
                            <p class="text-gray-600">Mayoritas penduduk adalah Suku Madura dan Jawa dengan adat istiadat yang kental. Tradisi seperti selamatan, bersih desa, dan sedekah bumi masih terjaga. Kesenian tradisional seperti ludruk, tayuban, dan hadrah aktif dilestarikan melalui sanggar-sanggar budaya desa.</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                            <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                                <i class="fas fa-seedling text-yellow-500 mr-3"></i>
                                Potensi Ekonomi
                            </h3>
                            <p class="text-gray-600">Memiliki potensi besar di bidang pertanian dengan hasil unggulan padi, jagung, dan sayuran organik. Sektor peternakan didominasi oleh sapi, kambing, dan unggas. UMKM berkembang pesat terutama di bidang pengolahan hasil pertanian, kerajinan bambu, dan kuliner tradisional.</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                            <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
                                <i class="fas fa-graduation-cap text-yellow-500 mr-3"></i>
                                Pendidikan & Fasilitas
                            </h3>
                            <p class="text-gray-600">Tersedia fasilitas pendidikan mulai PAUD hingga SMP, termasuk TPQ dan Madrasah Diniyah. Dilengkapi fasilitas kesehatan berupa Puskesmas Pembantu dan Posyandu. Infrastruktur meliputi jalan beraspal, listrik, air bersih, dan jaringan internet 4G.</p>
                        </div>
                    </div>

                    <div class="relative">
                        <img src="{{ asset('images/background_sawah.jpg') }}" alt="Pemandangan Desa" class="rounded-2xl shadow-2xl w-full h-[500px] object-cover">
                        <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-sm p-6 rounded-xl">
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <div class="text-3xl font-bold text-blue-900">5+</div>
                                    <div class="text-sm text-gray-600">Dusun</div>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold text-blue-900">1000+</div>
                                    <div class="text-sm text-gray-600">Keluarga</div>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold text-blue-900">10+</div>
                                    <div class="text-sm text-gray-600">Sanggar Budaya</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visi Misi Section -->
        <div class="bg-white py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Visi & Misi</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Komitmen kami dalam membangun desa yang maju, mandiri dan sejahtera</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Visi Card -->
                    <div class="bg-gray-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                            <i class="fas fa-eye text-yellow-500 mr-3"></i>
                            Visi
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            "Terwujudnya Desa yang Maju, Mandiri, dan Sejahtera Berbasis Pertanian dan Teknologi Digital dengan Tetap Menjaga Nilai-nilai Budaya dan Kearifan Lokal"
                        </p>
                    </div>

                    <!-- Misi Card -->
                    <div class="bg-gray-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                            <i class="fas fa-bullseye text-yellow-500 mr-3"></i>
                            Misi
                        </h3>
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Meningkatkan kualitas pelayanan publik melalui digitalisasi administrasi desa</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Mengembangkan sektor pertanian dengan teknologi modern dan ramah lingkungan</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Memberdayakan UMKM dan potensi ekonomi lokal untuk kesejahteraan masyarakat</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Melestarikan dan mengembangkan nilai-nilai budaya serta kearifan lokal</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gray-50 pt-20 sm:pt-32 pb-16 sm:pb-20">
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
                            <a href="#" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
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
                            <a href="#" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
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
                            <a href="#" class="text-blue-900 hover:text-yellow-500 font-semibold flex items-center space-x-2 group-hover:translate-x-2 transition duration-300">
                                <span>Pelajari Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
