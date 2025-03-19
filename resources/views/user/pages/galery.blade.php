@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Galeri Desa</h1>
                    <p class="text-gray-600">Dokumentasi kegiatan dan momen penting di desa kami</p>
                </div>

                <!-- Filter Categories -->
                <!-- <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <button onclick="filterGallery('all')" class="filter-btn active bg-yellow-500 text-gray-900 px-4 py-2 rounded-full hover:bg-yellow-400 transition duration-300" data-category="all">
                        Semua
                    </button>
                    <button onclick="filterGallery('Kegiatan')" class="filter-btn bg-gray-100 text-gray-900 px-4 py-2 rounded-full hover:bg-gray-200 transition duration-300" data-category="Kegiatan">
                        Kegiatan
                    </button>
                    <button onclick="filterGallery('Pembangunan')" class="filter-btn bg-gray-100 text-gray-900 px-4 py-2 rounded-full hover:bg-gray-200 transition duration-300" data-category="Pembangunan">
                        Pembangunan
                    </button>
                    <button onclick="filterGallery('Budaya')" class="filter-btn bg-gray-100 text-gray-900 px-4 py-2 rounded-full hover:bg-gray-200 transition duration-300" data-category="Budaya">
                        Budaya
                    </button>
                </div> -->

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-container">
                    @foreach(App\Models\Aktifitas::latest()->get() as $item)
                    <div class="gallery-item bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300 flex flex-col h-full" data-category="Kegiatan">
                        <img src="{{ asset('images/'.$item->image) }}" alt="{{ $item->judul }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center text-gray-500 text-sm mb-2">
                                <i class="far fa-calendar-alt mr-2"></i>
                                <span>{{ $item->tgl_mulai->format('d F Y') }}</span>
                            </div>
                            <h3 class="text-xl font-semibold text-blue-900 mb-3 truncate">{{ $item->judul }}</h3>
                            <p class="text-gray-600 mb-4 flex-grow line-clamp-3">{{ $item->deskripsi }}</p>
                            <a href="#" onclick="openModal('{{ $item->image }}', '{{ $item->judul }}', '{{ $item->tgl_mulai->format('d F Y') }}', `{{ $item->deskripsi }}`)" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2 mt-auto">
                                <span>Lihat detail</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8 gap-2" id="pagination">
                    <!-- Pagination buttons will be inserted here by JavaScript -->
                </div>
            </div>
        </div>
    </main>

    <!-- Full Screen Modal -->
    <div id="galleryModal" class="fixed inset-0 bg-white hidden z-50 overflow-y-auto">
        <div class="min-h-screen">
            <!-- Header with close button -->
            <div class="fixed top-0 left-0 right-0 bg-white z-10 shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                    <h1 class="text-xl font-bold text-blue-900">Detail Kegiatan</h1>
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
        // Configuration
        const itemsPerPage = 6;
        let currentPage = 1;
        let currentCategory = 'all';

        // Filter gallery items
        function filterGallery(category) {
            currentCategory = category;
            currentPage = 1;
            
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-yellow-500', 'active');
                btn.classList.add('bg-gray-100');
                if(btn.dataset.category === category) {
                    btn.classList.remove('bg-gray-100');
                    btn.classList.add('bg-yellow-500', 'active');
                }
            });

            // Filter items
            const items = document.querySelectorAll('.gallery-item');
            items.forEach(item => {
                if(category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });

            updatePagination();
            showPage(1);
        }

        // Show specific page
        function showPage(page) {
            currentPage = page;
            const items = document.querySelectorAll('.gallery-item');
            const visibleItems = Array.from(items).filter(item => 
                currentCategory === 'all' || item.dataset.category === currentCategory
            );

            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            visibleItems.forEach((item, index) => {
                if(index >= startIndex && index < endIndex) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });

            updatePaginationButtons();
        }

        // Update pagination
        function updatePagination() {
            const items = document.querySelectorAll('.gallery-item');
            const visibleItems = Array.from(items).filter(item => 
                currentCategory === 'all' || item.dataset.category === currentCategory
            );
            const pageCount = Math.ceil(visibleItems.length / itemsPerPage);
            
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = '';

            // Previous button
            const prevButton = createPaginationButton('Prev', () => {
                if(currentPage > 1) showPage(currentPage - 1);
            });
            paginationContainer.appendChild(prevButton);

            // Page buttons
            for(let i = 1; i <= pageCount; i++) {
                const pageButton = createPaginationButton(i, () => showPage(i));
                paginationContainer.appendChild(pageButton);
            }

            // Next button
            const nextButton = createPaginationButton('Next', () => {
                if(currentPage < pageCount) showPage(currentPage + 1);
            });
            paginationContainer.appendChild(nextButton);

            updatePaginationButtons();
        }

        // Create pagination button
        function createPaginationButton(text, onClick) {
            const button = document.createElement('button');
            button.textContent = text;
            button.className = 'px-4 py-2 rounded-lg transition duration-300';
            button.onclick = onClick;
            return button;
        }

        // Update pagination buttons state
        function updatePaginationButtons() {
            const buttons = document.querySelectorAll('#pagination button');
            buttons.forEach(button => {
                if(button.textContent == currentPage) {
                    button.classList.add('bg-yellow-500', 'text-white');
                } else {
                    button.classList.remove('bg-yellow-500', 'text-white');
                    button.classList.add('bg-gray-100', 'hover:bg-gray-200');
                }
            });
        }

        // Initialize gallery
        document.addEventListener('DOMContentLoaded', () => {
            filterGallery('all');
        });

        function openModal(image, judul, tanggal, deskripsi) {
            document.getElementById('modalImage').src = `/images/${image}`;
            document.getElementById('modalImage').alt = judul;
            document.getElementById('modalTitle').textContent = judul;
            document.getElementById('modalDate').textContent = tanggal;
            document.getElementById('modalContent').textContent = deskripsi;
            document.getElementById('galleryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('galleryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
@endsection
