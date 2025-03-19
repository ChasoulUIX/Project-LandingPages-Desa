@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Berita & Informasi Terkini</h1>
                    <p class="text-blue-100">Temukan informasi dan berita terbaru seputar kegiatan di desa kami</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(App\Models\Berita::latest()->get() as $item)
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-2 transition duration-300 flex flex-col h-full">
                        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        <div class="flex items-center text-gray-500 text-sm mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</span>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-3 truncate">{{ $item->judul }}</h3>
                        <div class="text-gray-600 mb-4 flex-grow line-clamp-3 prose">
                            {!! Str::limit($item->konten, 200) !!}
                        </div>
                        <a href="#" onclick="openModal('{{ $item->image }}', '{{ $item->judul }}', '{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}', `{!! $item->konten !!}`)" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2 mt-auto">
                            <span>Baca selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="px-4 py-2 border border-blue-600 bg-blue-600 text-white rounded-lg">1</a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2</a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3</a>
                        <a href="#" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <!-- Full Screen Modal -->
    <div id="newsModal" class="fixed inset-0 bg-white hidden z-50 overflow-y-auto">
        <div class="min-h-screen">
            <!-- Header with close button -->
            <div class="fixed top-0 left-0 right-0 bg-white z-10 shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <h1 class="text-xl font-bold text-blue-900">Detail Berita</h1>
                    <button onclick="closeModal()" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-12">
                <img id="modalImage" src="" alt="" class="w-full h-[500px] object-cover rounded-lg mb-6">
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span id="modalDate"></span>
                </div>
                <h2 id="modalTitle" class="text-4xl font-bold text-blue-900 mb-6"></h2>
                <div id="modalContent" class="prose max-w-none text-gray-700 text-lg"></div>
            </div>
        </div>
    </div>

    <script>
        function openModal(image, judul, tanggal, konten) {
            document.getElementById('modalImage').src = `/images/${image}`;
            document.getElementById('modalImage').alt = judul;
            document.getElementById('modalTitle').textContent = judul;
            document.getElementById('modalDate').textContent = tanggal;
            document.getElementById('modalContent').innerHTML = konten;
            document.getElementById('newsModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('newsModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
@endsection
