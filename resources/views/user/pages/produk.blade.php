@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-0">
        <!-- Hero Section -->
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Produk UMKM Desa Sumber Secang</h1>
                    <p class="text-blue-100">Temukan berbagai produk unggulan dari UMKM Desa Sumber Secang</p>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="products-container">
            @foreach(App\Models\Produk::latest()->get() as $item)
                <div class="product-item bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative h-64">
                        <img src="{{ asset('images/'.$item->image) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">{{ $item->nama }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item->deskripsi }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-yellow-500 font-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            <a href="https://wa.me/{{ $item->no_wa }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-8 gap-2" id="pagination">
                <!-- Pagination buttons will be inserted here by JavaScript -->
            </div>
        </div>

        <script>
            // Configuration
            const itemsPerPage = 6;
            let currentPage = 1;

            // Show specific page
            function showPage(page) {
                currentPage = page;
                const items = document.querySelectorAll('.product-item');
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;

                items.forEach((item, index) => {
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
                const items = document.querySelectorAll('.product-item');
                const pageCount = Math.ceil(items.length / itemsPerPage);
                
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

            // Initialize pagination
            document.addEventListener('DOMContentLoaded', () => {
                updatePagination();
                showPage(1);
            });
        </script>
    </main>
@endsection
