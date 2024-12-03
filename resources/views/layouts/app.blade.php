<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Desa - Sistem Informasi Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        @media (max-width: 640px) {
            .text-4xl {
                font-size: 1.75rem;
            }
            .text-3xl {
                font-size: 1.5rem; 
            }
            .text-xl {
                font-size: 1.1rem;
            }
            .text-lg {
                font-size: 1rem;
            }
            .py-24 {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }
            .px-8 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .space-y-8 > :not([hidden]) ~ :not([hidden]) {
                margin-top: 1.5rem;
            }
            .h-20 {
                height: 4rem;
            }
            .w-16 {
                width: 3rem;
            }
            .h-16 {
                height: 3rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50 text-sm sm:text-base">
    <!-- Header/Navigation -->
    <nav class="bg-gradient-to-r from-blue-900 to-blue-800 shadow-xl fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-3 sm:px-4">
            <div class="flex justify-between h-16 sm:h-20">
                <div class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/Logo_kab_probolinggo.png') }}" alt="Logo" class="h-8 w-8 sm:h-10 sm:w-10 rounded-lg shadow-lg object-contain">
                        <div class="flex flex-col">
                            <div class="text-white text-base sm:text-xl font-bold tracking-wider">Desa Sumber Secang</div>
                            <div class="text-blue-200 text-xs">Sistem Informasi Desa Digital</div>
                        </div>
                    </div>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-6">
                    <a href="/" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-1 text-sm">
                        <i class="fas fa-home"></i><span>Beranda</span>
                    </a>
                    <a href="{{ url('/layanan') }}" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-1 text-sm">
                        <i class="fas fa-hands-helping"></i><span>Layanan</span>
                    </a>
                    <a href="{{ url('/berita') }}" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-1 text-sm">
                        <i class="fas fa-newspaper"></i><span>Berita</span>
                    </a>
                    <a href="{{ url('/galery') }}" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-1 text-sm">
                        <i class="fas fa-images"></i><span>Galeri</span>
                    </a>
                    <a href="{{ url('/kontak') }}" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-1 text-sm">
                        <i class="fas fa-phone"></i><span>Kontak</span>
                    </a>
                    <div class="flex items-center">
                        <a href="{{ url('/login') }}" class="bg-yellow-500 text-blue-900 px-4 py-2 rounded-lg hover:bg-yellow-400 transition duration-300 font-medium flex items-center space-x-2 text-sm">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Masuk</span>
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center">
                    <button type="button" class="text-white hover:text-yellow-300 transition duration-300" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden lg:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="/" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-2 text-sm">
                        <i class="fas fa-home w-5"></i><span>Beranda</span>
                    </a>
                    <a href="{{ url('/layanan') }}" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-2 text-sm">
                        <i class="fas fa-hands-helping w-5"></i><span>Layanan</span>
                    </a>
                    <a href="{{ url('/berita') }}" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-2 text-sm">
                        <i class="fas fa-newspaper w-5"></i><span>Berita</span>
                    </a>
                    <a href="{{ url('/galery') }}" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-2 text-sm">
                        <i class="fas fa-images w-5"></i><span>Galeri</span>
                    </a>
                    <a href="{{ url('/kontak') }}" class="text-white hover:text-yellow-300 transition duration-300 flex items-center space-x-2 text-sm">
                        <i class="fas fa-phone w-5"></i><span>Kontak</span>
                    </a>
                    <a href="{{ url('/login') }}" class="bg-yellow-500 text-blue-900 px-4 py-2 rounded-lg hover:bg-yellow-400 transition duration-300 font-medium flex items-center justify-center space-x-2 text-sm">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Masuk</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

     <!-- Footer -->
     <footer class="bg-blue-900 text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/Logo_kab_probolinggo.png') }}" alt="Logo" class="h-14 w-12 rounded-lg">
                        <div class="text-lg font-bold">Desa Sumber Secang</div>
                    </div>
                    <p class="text-blue-200 text-sm leading-relaxed">
                        Desa Sumber Secang adalah desa yang terletak di Kecamatan Krejengan, Kabupaten Probolinggo, Provinsi Jawa Timur. Website ini merupakan portal informasi dan layanan digital untuk masyarakat Desa Sumber Secang.
                    </p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-blue-200 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-yellow-400 transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-base font-semibold mb-4 flex items-center space-x-2">
                        <i class="fas fa-phone text-yellow-400"></i>
                        <span>Kontak Kami</span>
                    </h3>
                    <ul class="space-y-3 text-blue-200 text-sm">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope"></i>
                            <span>desasecang@gmail.com</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone-alt"></i>
                            <span>(021) 1234567</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fab fa-whatsapp"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Jl. Desa Sumber Secang, Kec. Krejengan, Kab. Probolinggo</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-base font-semibold mb-4 flex items-center space-x-2">
                        <i class="fas fa-clock text-yellow-400"></i>
                        <span>Jam Operasional</span>
                    </h3>
                    <ul class="space-y-3 text-blue-200 text-sm">
                        <li class="flex justify-between">
                            <span>Senin - Jumat</span>
                            <span>08:00 - 16:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sabtu</span>
                            <span>08:00 - 12:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Minggu</span>
                            <span>Tutup</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Layanan Online</span>
                            <span>24/7</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-base font-semibold mb-4 flex items-center space-x-2">
                        <i class="fas fa-link text-yellow-400"></i>
                        <span>Tautan Penting</span>
                    </h3>
                    <ul class="space-y-3 text-blue-200 text-sm">
                        <li>
                            <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs"></i>
                                <span>Panduan Pengguna</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs"></i>
                                <span>FAQ</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs"></i>
                                <span>Kebijakan Privasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-yellow-400 transition duration-300 flex items-center space-x-2">
                                <i class="fas fa-chevron-right text-xs"></i>
                                <span>Syarat & Ketentuan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-blue-800 text-center text-blue-200 text-xs">
                <p>&copy; 2024 Portal Desa. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>


     <!-- Mobile Menu Toggle Script -->
     <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>