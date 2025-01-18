@extends('cms.layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Total Kegiatan</p>
                <h3 class="text-2xl font-bold">{{ App\Models\Kegiatan::count() }}</h3>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-calendar-alt text-blue-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Total Berita</p>
                <h3 class="text-2xl font-bold">{{ App\Models\Berita::count() }}</h3>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-newspaper text-green-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Total Produk</p>
                <h3 class="text-2xl font-bold">{{ App\Models\Produk::count() }}</h3>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-box text-purple-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Total Pengaduan</p>
               
            </div>
            <div class="bg-red-100 p-3 rounded-full">
                <i class="fas fa-exclamation-circle text-red-500"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="bg-white rounded-lg shadow-lg p-6 border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Aktivitas Terbaru</h2>
        <div class="bg-blue-50 text-blue-600 text-sm font-medium px-3 py-1 rounded-full">
            Real-time Updates
        </div>
    </div>

    <div class="divide-y divide-gray-100">
        @foreach(App\Models\Kegiatan::latest()->take(3)->get() as $kegiatan)
        <div class="py-4 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-blue-500 text-lg"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $kegiatan->judul }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $kegiatan->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-blue-600">
                    <span class="px-2 py-1 bg-blue-50 rounded-md">Kegiatan</span>
                </div>
            </div>
        </div>
        @endforeach

        @foreach(App\Models\Berita::latest()->take(3)->get() as $berita)
        <div class="py-4 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-newspaper text-green-500 text-lg"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $berita->judul }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $berita->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-green-600">
                    <span class="px-2 py-1 bg-green-50 rounded-md">Berita</span>
                </div>
            </div>
        </div>
        @endforeach

        @foreach(App\Models\Produk::latest()->take(3)->get() as $produk)
        <div class="py-4 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-box text-yellow-500 text-lg"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $produk->nama }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $produk->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-yellow-600">
                    <span class="px-2 py-1 bg-yellow-50 rounded-md">Produk</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection