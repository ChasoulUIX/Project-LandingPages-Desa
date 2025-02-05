<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CMS Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-blue-900 text-white w-48 py-4 flex flex-col transition-all duration-300">
            <div class="px-4 mb-4">
                <h1 class="text-lg font-bold">CMS Admin</h1>
            </div>
            
            <nav class="flex-1">
                <div class="px-2 space-y-1">
                    <a href="/cms/app/dashboard" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/app/dashboard') ? 'bg-blue-800' : '' }}" data-page="dashboard">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>

                     <!-- Profile Desa Dropdown -->
                     <div class="relative" x-data="{ open: {{ request()->is('cms/sambutan', 'cms/profile-desa') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="nav-link w-full px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors flex items-center justify-between">
                            <span><i class="fas fa-building mr-2"></i>Desa</span>
                            <i class="fas fa-chevron-down ml-2" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" 
                             class="pl-3 mt-2 space-y-2">
                            <a href="/cms/sambutan" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/sambutan') ? 'bg-blue-800' : '' }}" data-page="sambutan">
                                <i class="fas fa-user-tie mr-2"></i>Sambutan Kepala Desa
                            </a>
                            <a href="/cms/profile-desa" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/profile-desa') ? 'bg-blue-800' : '' }}" data-page="profile">
                                <i class="fas fa-info-circle mr-2"></i>Profile Desa
                            </a>
                        </div>
                    </div>

                    <a href="/cms/app/kependudukan" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/app/kependudukan') ? 'bg-blue-800' : '' }}" data-page="kependudukan">
                        <i class="fas fa-home mr-2"></i>Kependudukan
                    </a>

                    <a href="/cms/strukturdesa" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/strukturdesa') ? 'bg-blue-800' : '' }}" data-page="layanan">
                        <i class="fas fa-file-alt mr-2"></i>Struktur Desa
                    </a>

                    <a href="/cms/dana" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/dana') ? 'bg-blue-800' : '' }}" data-page="layanan">
                        <i class="fas fa-file-alt mr-2"></i>Dana Desa
                    </a>
                    
                    <!-- Galeri Dropdown -->
                    <div class="relative" x-data="{ open: {{ request()->is('cms/berita', 'cms/kegiatan', 'cms/produk') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="nav-link w-full px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors flex items-center justify-between">
                            <span><i class="fas fa-images mr-2"></i>Galeri</span>
                            <i class="fas fa-chevron-down ml-2" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" 
                             class="pl-3 mt-2 space-y-2">
                             <a href="/cms/berita" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/berita') ? 'bg-blue-800' : '' }}" data-page="berita">
                                <i class="fas fa-newspaper mr-2"></i>Berita
                            </a>
                            <a href="/cms/kegiatan" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/kegiatan') ? 'bg-blue-800' : '' }}" data-page="kegiatan">
                                <i class="fas fa-newspaper mr-2"></i>Kegiatan
                            </a>
                            <a href="/cms/produk" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/produk') ? 'bg-blue-800' : '' }}" data-page="produk">
                                <i class="fas fa-box mr-2"></i>Produk
                            </a>
                        </div>
                    </div>
                    
                     <!-- Layanan Dropdown -->
                     <div class="relative" x-data="{ open: {{ request()->is('cms/suratketerangan/*', 'cms/pengaduan') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="nav-link w-full px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-colors flex items-center justify-between">
                            <span><i class="fas fa-images mr-2"></i>Layanan</span>
                            <i class="fas fa-chevron-down ml-2" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="pl-3 mt-2 space-y-2">
                             <div class="relative" x-data="{ subOpen: {{ request()->is('cms/suratketerangan/*') ? 'true' : 'false' }} }">
                                <button @click="subOpen = !subOpen" class="nav-link w-full px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-all duration-200 flex items-center justify-between">
                                    <span><i class="fas fa-images mr-2"></i>Keterangan</span>
                                    <i class="fas fa-chevron-down ml-2 transition-transform duration-200" :class="{ 'transform rotate-180': subOpen }"></i>
                                </button>
                                <div x-show="subOpen"
                                     x-transition:enter="transition ease-out duration-200" 
                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform translate-y-0"
                                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                                     class="pl-3 mt-2 space-y-2">
                                     <a href="/cms/suratketerangan/domisili" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/domisili') ? 'bg-blue-800' : '' }}" data-page="domisili">
                                        <i class="fas fa-newspaper mr-2"></i>Domisili
                                    </a>
                                    <a href="/cms/suratketerangan/tidakmampu" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/tidakmampu') ? 'bg-blue-800' : '' }}" data-page="tidakmampu">
                                        <i class="fas fa-newspaper mr-2"></i>Tidak Mampu
                                    </a>
                                    <a href="/cms/suratketerangan/usaha" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/usaha') ? 'bg-blue-800' : '' }}" data-page="usaha">
                                        <i class="fas fa-box mr-2"></i>Usaha
                                    </a>
                                    <a href="/cms/suratketerangan/ktp" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/ktp') ? 'bg-blue-800' : '' }}" data-page="usaha">
                                        <i class="fas fa-box mr-2"></i>KTP
                                    </a>
                                    <a href="/cms/suratketerangan/kelahiran" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/kelahiran') ? 'bg-blue-800' : '' }}" data-page="usaha">
                                        <i class="fas fa-box mr-2"></i>Kelahiran
                                    </a>
                                </div>
                            </div>
                            <a href="/cms/pengaduan" class="nav-link block px-3 py-1.5 text-sm rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/pengaduan') ? 'bg-blue-800' : '' }}" data-page="pengaduan">
                                <i class="fas fa-exclamation-circle mr-2"></i>Pengaduan
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="px-4 py-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-3 py-1.5 text-xs rounded-lg hover:bg-blue-800 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- App Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-4 py-2">
                    <div class="flex items-center">
                        <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-lg"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center space-x-1 text-gray-700 hover:text-gray-900">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile" class="w-6 h-6 rounded-full">
                                <span class="text-sm">{{ auth()->user()->name }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if(sidebar.style.marginLeft === '-12rem') {
                sidebar.style.marginLeft = '0';
            } else {
                sidebar.style.marginLeft = '-12rem';
            }
        }

        // Add active class to current nav link
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('bg-blue-800'));
                    
                    // Add active class to clicked link
                    this.classList.add('bg-blue-800');
                });
            });

            // Set active class based on current URL
            const currentPath = window.location.pathname;
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('bg-blue-800');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
