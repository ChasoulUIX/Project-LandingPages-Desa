<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-blue-900 text-white w-64 py-6 flex flex-col transition-all duration-300">
            <div class="px-6 mb-8">
                <h1 class="text-2xl font-bold">CMS Admin</h1>
            </div>
            
            <nav class="flex-1">
                <div class="px-4 space-y-2">
                    <a href="/cms/app/dashboard" class="nav-link block px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/app/dashboard') ? 'bg-blue-800' : '' }}" data-page="dashboard">
                        <i class="fas fa-home mr-3"></i>Dashboard
                    </a>
                    
                    <!-- Galeri Dropdown -->
                    <div class="relative" x-data="{ open: {{ request()->is('cms/berita', 'cms/kegiatan', 'cms/produk') ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="nav-link w-full px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors flex items-center justify-between">
                            <span><i class="fas fa-images mr-3"></i>Galeri</span>
                            <i class="fas fa-chevron-down ml-2" :class="{ 'transform rotate-180': open }"></i>
                        </button>
                        <div x-show="open" 
                             @click.outside="open = false"
                             class="pl-4 mt-2 space-y-2">
                             <a href="/cms/berita" class="nav-link block px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/berita') ? 'bg-blue-800' : '' }}" data-page="berita">
                                <i class="fas fa-newspaper mr-3"></i>Berita
                            </a>
                            <a href="/cms/kegiatan" class="nav-link block px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/kegiatan') ? 'bg-blue-800' : '' }}" data-page="kegiatan">
                                <i class="fas fa-newspaper mr-3"></i>Kegiatan
                            </a>
                            <a href="/cms/produk" class="nav-link block px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/produk') ? 'bg-blue-800' : '' }}" data-page="produk">
                                <i class="fas fa-box mr-3"></i>Produk
                            </a>
                        </div>
                    </div>
                    <a href="#" class="nav-link block px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/layanan') ? 'bg-blue-800' : '' }}" data-page="layanan">
                        <i class="fas fa-file-alt mr-3"></i>Layanan
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/pengguna') ? 'bg-blue-800' : '' }}" data-page="pengguna">
                        <i class="fas fa-users mr-3"></i>Pengguna
                    </a>
                    <a href="#" class="nav-link block px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/pengaturan') ? 'bg-blue-800' : '' }}" data-page="pengaturan">
                        <i class="fas fa-cog mr-3"></i>Pengaturan
                    </a>
                </div>
            </nav>

            <div class="px-6 py-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm rounded-lg hover:bg-blue-800 transition-colors">
                        <i class="fas fa-sign-out-alt mr-3"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- App Bar -->
            <header class="bg-white shadow-md">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile" class="w-8 h-8 rounded-full">
                                <span>{{ auth()->user()->name }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if(sidebar.style.marginLeft === '-16rem') {
                sidebar.style.marginLeft = '0';
            } else {
                sidebar.style.marginLeft = '-16rem';
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
</body>
</html>
