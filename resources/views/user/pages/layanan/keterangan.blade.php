@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-8 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8 sm:mb-12">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300 mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-center">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2 sm:mb-4">Surat Keterangan</h1>
                        <p class="text-sm sm:text-base text-blue-100">Layanan pembuatan surat keterangan untuk keperluan administratif warga desa</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <!-- Category Filters -->
                <div class="flex justify-center space-x-4 mb-6">
                    <button onclick="filterCategory('all')" class="filter-btn active px-6 py-2 bg-white text-blue-900 rounded-full font-medium hover:bg-blue-100 transition duration-300">
                        Semua
                    </button>
                    <button onclick="filterCategory('umum')" class="filter-btn px-6 py-2 bg-white text-blue-900 rounded-full font-medium hover:bg-blue-100 transition duration-300">
                        Umum
                    </button>
                    <button onclick="filterCategory('kependudukan')" class="filter-btn px-6 py-2 bg-white text-blue-900 rounded-full font-medium hover:bg-blue-100 transition duration-300">
                        Kependudukan
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    <!-- Surat Keterangan Domisili -->
                    <div data-category="kependudukan" class="card bg-white rounded-xl shadow-lg p-4 sm:p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-2xl sm:text-3xl mb-3 sm:mb-4">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-blue-900 mb-2 sm:mb-3">Surat Keterangan Domisili</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">Surat yang menerangkan tempat tinggal/domisili seseorang</p>
                        <a href="{{ url('suratketerangan/domisili') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2 text-sm sm:text-base">
                            <span>Ajukan Surat</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Surat Keterangan Tidak Mampu -->
                    <div data-category="umum" class="card bg-white rounded-xl shadow-lg p-4 sm:p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-2xl sm:text-3xl mb-3 sm:mb-4">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-blue-900 mb-2 sm:mb-3">Surat Keterangan Tidak Mampu</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">Surat keterangan untuk keluarga dengan ekonomi kurang mampu</p>
                        <a href="{{ url('suratketerangan/tidakmampu') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2 text-sm sm:text-base">
                            <span>Ajukan Surat</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Surat Keterangan Usaha -->
                    <div data-category="umum" class="card bg-white rounded-xl shadow-lg p-4 sm:p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-2xl sm:text-3xl mb-3 sm:mb-4">
                            <i class="fas fa-store"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-blue-900 mb-2 sm:mb-3">Surat Keterangan Usaha</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">Surat keterangan untuk kepemilikan usaha di wilayah desa</p>
                        <a href="{{ url('suratketerangan/usaha') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2 text-sm sm:text-base">
                            <span>Ajukan Surat</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Surat Pengantar KTP -->
                    <div data-category="umum" class="card bg-white rounded-xl shadow-lg p-4 sm:p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-2xl sm:text-3xl mb-3 sm:mb-4">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-blue-900 mb-2 sm:mb-3">Surat Pengantar KTP</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">Surat pengantar untuk pembuatan atau perpanjangan KTP</p>
                        <a href="{{ url('suratketerangan/ktp') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2 text-sm sm:text-base">
                            <span>Ajukan Surat</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Surat Keterangan Kelahiran -->
                    <div data-category="kependudukan" class="card bg-white rounded-xl shadow-lg p-4 sm:p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-2xl sm:text-3xl mb-3 sm:mb-4">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-blue-900 mb-2 sm:mb-3">Surat Keterangan Kelahiran</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">Surat keterangan untuk pencatatan kelahiran</p>
                        <a href="{{ url('suratketerangan/kelahiran') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2 text-sm sm:text-base">
                            <span>Ajukan Surat</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <!-- Surat Keterangan Kematian -->
                    <div data-category="kependudukan" class="card bg-white rounded-xl shadow-lg p-4 sm:p-6 transform hover:-translate-y-2 transition duration-300">
                        <div class="text-yellow-500 text-2xl sm:text-3xl mb-3 sm:mb-4">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-blue-900 mb-2 sm:mb-3">Surat Keterangan Kematian</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">Surat keterangan untuk pencatatan kematian</p>
                        <a href="{{ url('suratketerangan/kematian') }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2 text-sm sm:text-base">
                            <span>Ajukan Surat</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="mt-8 sm:mt-12 bg-white rounded-xl shadow-lg p-4 sm:p-8">
                    <h2 class="text-xl sm:text-2xl font-semibold text-blue-900 mb-3 sm:mb-4">Persyaratan Umum</h2>
                    <ul class="list-disc list-inside text-sm sm:text-base text-gray-600 space-y-1 sm:space-y-2">
                        <li>Fotokopi KTP yang masih berlaku</li>
                        <li>Fotokopi Kartu Keluarga</li>
                        <li>Surat Pengantar RT/RW</li>
                        <li>Dokumen pendukung lainnya sesuai jenis surat</li>
                    </ul>
                </div>

                <!-- Add this script before the closing main tag -->
                <script>
                    function filterCategory(category) {
                        // Update active button state
                        document.querySelectorAll('.filter-btn').forEach(btn => {
                            btn.classList.remove('active', 'bg-blue-100');
                        });
                        event.target.classList.add('active', 'bg-blue-100');

                        // Filter cards
                        const cards = document.querySelectorAll('.card');
                        cards.forEach(card => {
                            if (category === 'all' || card.dataset.category === category) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    }
                </script>

                <style>
                    .filter-btn.active {
                        background-color: rgb(219 234 254);
                    }
                </style>
            </div>
        </div>
    </main>
@endsection
