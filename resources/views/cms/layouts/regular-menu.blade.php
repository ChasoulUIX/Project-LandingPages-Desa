<a href="/cms/app/dashboard" class="nav-link block px-4 py-2.5 text-base rounded-lg hover:bg-blue-800 transition-colors {{ request()->is('cms/app/dashboard') ? 'bg-blue-800' : '' }}">
    <i class="fas fa-home mr-3"></i>Dashboard
</a>

<!-- Profile Desa Dropdown -->
<div class="relative" x-data="{ open: {{ request()->is('cms/sambutan', 'cms/profile-desa') ? 'true' : 'false' }} }">
    <!-- ... rest of your existing menu items ... -->
</div>

<!-- ... rest of your existing menu items ... --> 