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
    <style>
        /* Custom Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            background-color: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: rgba(156, 163, 175, 0.5);
        }

        /* For Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.3) transparent;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-blue-900 text-white w-80 py-6 flex flex-col fixed h-screen overflow-y-auto" style="min-width: 320px;">
            <div class="px-6 mb-6 flex items-center space-x-3">
                <img src="{{ asset('images/probolinggo.png') }}" alt="Logo Desa" class="w-10 h-10 object-contain">
                <h1 class="text-1xl font-bold">Desa Sumber Secang</h1>
            </div>
            
            <nav class="flex-1">
                <div class="px-4 space-y-2">
                    <a href="/cms/app/dashboard" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/app/dashboard') ? 'bg-blue-800' : '' }}" data-page="dashboard">
                        <i class="fas fa-home mr-3"></i>Dashboard
                    </a>

                     <!-- Profile Desa Dropdown -->
                     <div class="relative" x-data="{ open: {{ request()->is('cms/sambutan', 'cms/profile-desa') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="nav-link w-full px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors flex items-center justify-between">
                            <span><i class="fas fa-building mr-3"></i>Desa</span>
                            <i class="fas fa-chevron-down ml-3" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" 
                             class="pl-4 mt-2 space-y-2">
                            <a href="/cms/sambutan" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/sambutan') ? 'bg-blue-800' : '' }}" data-page="sambutan">
                                <i class="fas fa-user-tie mr-3"></i>Sambutan Kepala Desa
                            </a>
                            <a href="/cms/profile-desa" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/profile-desa') ? 'bg-blue-800' : '' }}" data-page="profile">
                                <i class="fas fa-info-circle mr-3"></i>Profile Desa
                            </a>
                        </div>
                    </div>

                    <a href="/cms/app/kependudukan" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/app/kependudukan') ? 'bg-blue-800' : '' }}" data-page="kependudukan">
                        <i class="fas fa-home mr-3"></i>Kependudukan
                    </a>

                    <a href="/cms/strukturdesa" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/strukturdesa') ? 'bg-blue-800' : '' }}" data-page="layanan">
                        <i class="fas fa-file-alt mr-3"></i>Struktur Desa
                    </a>

                    <!-- Keuangan Desa Dropdown -->
                    <div class="relative" x-data="{ open: {{ request()->is('cms/dana', 'cms/kegiatan') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="nav-link w-full px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors flex items-center justify-between">
                            <span><i class="fas fa-money-bill mr-3"></i>Keuangan Desa</span>
                            <i class="fas fa-chevron-down ml-3" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" 
                             class="pl-4 mt-2 space-y-2">
                            <a href="/cms/dana" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/dana') ? 'bg-blue-800' : '' }}" data-page="dana">
                                <i class="fas fa-file-alt mr-3"></i>Dana Desa
                            </a>
                            <a href="/cms/kegiatan" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/kegiatan') ? 'bg-blue-800' : '' }}" data-page="kegiatan">
                                <i class="fas fa-newspaper mr-3"></i>Pendanaan Desa
                            </a>
                        </div>
                    </div>
                    
                    <!-- Galeri Dropdown -->
                    <div class="relative" x-data="{ open: {{ request()->is('cms/berita', 'cms/produk', 'cms/aktifitas') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="nav-link w-full px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors flex items-center justify-between">
                            <span><i class="fas fa-images mr-3"></i>Galeri</span>
                            <i class="fas fa-chevron-down ml-3" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" 
                             class="pl-4 mt-2 space-y-2">
                             <a href="/cms/berita" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/berita') ? 'bg-blue-800' : '' }}" data-page="berita">
                                <i class="fas fa-newspaper mr-3"></i>Berita
                            </a>
                            <a href="/cms/aktifitas" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/aktifitas') ? 'bg-blue-800' : '' }}" data-page="aktifitas">
                                <i class="fas fa-newspaper mr-3"></i>Aktifitas Desa
                            </a>
                            <a href="/cms/produk" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/produk') ? 'bg-blue-800' : '' }}" data-page="produk">
                                <i class="fas fa-box mr-3"></i>Produk
                            </a>
                        </div>
                    </div>
                    
                     <!-- Layanan Dropdown -->
                     <div class="relative" x-data="{ open: {{ request()->is('cms/suratketerangan/*', 'cms/pengaduan') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="nav-link w-full px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors flex items-center justify-between">
                            <span><i class="fas fa-images mr-3"></i>Layanan</span>
                            <i class="fas fa-chevron-down ml-3" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="pl-4 mt-2 space-y-2">
                             <div class="relative" x-data="{ subOpen: {{ request()->is('cms/suratketerangan/*') ? 'true' : 'false' }} }">
                                <button @click="subOpen = !subOpen" class="nav-link w-full px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-all duration-200 flex items-center justify-between">
                                    <span><i class="fas fa-images mr-3"></i>Keterangan</span>
                                    <i class="fas fa-chevron-down ml-3 transition-transform duration-200" :class="{ 'transform rotate-180': subOpen }"></i>
                                </button>
                                <div x-show="subOpen"
                                     x-transition:enter="transition ease-out duration-200" 
                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform translate-y-0"
                                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                                     class="pl-4 mt-2 space-y-2">
                                     <a href="/cms/suratketerangan/domisili" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/domisili') ? 'bg-blue-800' : '' }}" data-page="domisili">
                                        <i class="fas fa-newspaper mr-3"></i>Domisili
                                    </a>
                                    <a href="/cms/suratketerangan/tidakmampu" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/tidakmampu') ? 'bg-blue-800' : '' }}" data-page="tidakmampu">
                                        <i class="fas fa-newspaper mr-3"></i>Tidak Mampu
                                    </a>
                                    <a href="/cms/suratketerangan/usaha" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/usaha') ? 'bg-blue-800' : '' }}" data-page="usaha">
                                        <i class="fas fa-box mr-3"></i>Usaha
                                    </a>
                                    <a href="/cms/suratketerangan/ktp" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/ktp') ? 'bg-blue-800' : '' }}" data-page="usaha">
                                        <i class="fas fa-box mr-3"></i>KTP
                                    </a>
                                    <a href="/cms/suratketerangan/kelahiran" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/suratketerangan/kelahiran') ? 'bg-blue-800' : '' }}" data-page="usaha">
                                        <i class="fas fa-box mr-3"></i>Kelahiran
                                    </a>
                                </div>
                            </div>
                            <a href="/cms/pengaduan" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-all duration-200 {{ request()->is('cms/pengaduan') ? 'bg-blue-800' : '' }}" data-page="pengaduan">
                                <i class="fas fa-exclamation-circle mr-3"></i>Pengaduan
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="px-6 py-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm rounded-lg hover:bg-blue-800 transition-colors">
                        <i class="fas fa-sign-out-alt mr-3"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-80 relative">
            <!-- App Bar -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <a href="/cms/editprofile" class="flex items-center space-x-3 hover:opacity-80 transition-opacity">
                            <span class="text-base text-gray-700">{{ auth()->user()->name }}</span>
                            @if(auth()->user()->photo_profile)
                                <img src="{{ asset('images/' . auth()->user()->photo_profile) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&size=40" alt="Profile" class="w-10 h-10 rounded-full">
                            @endif
                        </a>
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
            const mainContent = sidebar.nextElementSibling;
            
            if(sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
                mainContent.classList.add('ml-80');
            } else {
                sidebar.classList.add('hidden');
                mainContent.classList.remove('ml-80');
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
