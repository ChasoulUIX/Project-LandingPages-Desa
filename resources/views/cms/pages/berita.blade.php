@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Berita Desa</h1>
        <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Berita
        </button>
    </div>

    <!-- Replace Berita Grid with Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm md:text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Konten</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($berita->count() > 0)
                        @foreach($berita as $item)
                            <tr class="text-gray-700" data-id="{{ $item->id }}">
                                <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->tanggal }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">{{ $item->judul }}</td>
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    {!! Str::limit($item->konten, 100) !!}
                                </td>
                                <td class="px-3 py-2 md:px-6 md:py-4">
                                    <button onclick="showPhotosModal(['{{ $item->image }}'])"
                                            class="text-blue-500 hover:text-blue-700 flex items-center">
                                        📷 <span class="ml-1 text-sm">(1)</span>
                                    </button>
                                </td>
                                <td class="px-3 py-2 md:px-6 md:py-3">
                                    <div class="flex items-center justify-start space-x-3">
                                        <button onclick="openEditModal({{ $item->id }})" class="text-blue-600 hover:text-blue-800 mr-3 text-lg">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('berita.destroy', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')" class="text-red-600 hover:text-red-800 text-lg">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <div class="flex flex-col items-center justify-center py-12">
                                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Loudspeaker.png"
                                         alt="No Data"
                                         class="w-64 h-64 mb-6"
                                    >
                                    <h3 class="text-xl font-medium text-gray-600 mb-2">Belum Ada Berita</h3>
                                    <p class="text-gray-500">Silakan tambah berita baru dengan klik tombol di atas</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-full h-full overflow-y-auto">
            <div class="flex justify-between items-center p-6 border-b sticky top-0 bg-white z-10">
                <h3 class="text-xl font-semibold">Tambah Berita Baru</h3>
                <button onclick="closeAddModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addForm" method="POST" action="{{ route('cms.berita.store') }}" enctype="multipart/form-data" class="p-6 max-w-5xl mx-auto" autocomplete="off">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
                        <input type="text" name="judul" required autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                        <textarea name="konten" id="addKonten" class="w-full" autocomplete="off"></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                            <input type="file" name="image" required accept="image/*" class="w-full" autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                            <input type="date" name="tanggal" required autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="sticky bottom-0 bg-white py-4 border-t">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg">
                            Simpan Berita
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-full h-full overflow-y-auto">
            <div class="flex justify-between items-center p-6 border-b sticky top-0 bg-white z-10">
                <h3 class="text-xl font-semibold">Edit Berita</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data" class="p-6 max-w-5xl mx-auto" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
                        <input type="text" name="judul" id="editJudul" required autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                        <textarea name="konten" id="editKonten" required autocomplete="off"></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                            <img id="currentImage" src="" alt="Current Image" class="w-full h-64 object-contain bg-gray-100 rounded-lg mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Baru (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full" autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                            <input type="date" name="tanggal" id="editTanggal" required autocomplete="off" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="sticky bottom-0 bg-white py-4 border-t">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg">
                            Update Berita
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Photos Modal -->
    <div id="photosModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Photos</h3>
                <button onclick="closePhotosModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="photosContainer" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Photos will be inserted here -->
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
<script>
// Add this at the beginning of your script
window.onerror = function(msg, url, lineNo, columnNo, error) {
    console.log('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo + '\nColumn: ' + columnNo + '\nError object: ' + JSON.stringify(error));
    return false;
};

// Inisialisasi TinyMCE dengan konfigurasi sederhana
function initEditor() {
    tinymce.init({
        selector: '#addKonten',
        height: 400,
        menubar: false,
        plugins: [
            'lists', 'link', 'image', 'code'
        ],
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
        browser_spellcheck: true,
        contextmenu: false,
        autocomplete: false
    });
}

// Fungsi untuk membuka modal
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
    document.getElementById('addModal').classList.add('flex');
    initEditor();
}

// Fungsi untuk menutup modal
function closeAddModal() {
    if (tinymce.get('addKonten')) {
        tinymce.get('addKonten').remove();
    }
    document.getElementById('addModal').classList.add('hidden');
    document.getElementById('addModal').classList.remove('flex');
}

// Handle form submission
document.getElementById('addForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Get form data
    const formData = new FormData(this);

    // Get TinyMCE content
    if (tinymce.get('addKonten')) {
        formData.set('konten', tinymce.get('addKonten').getContent());
    }

    // Submit form
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Berita berhasil disimpan!');
            window.location.reload();
        } else {
            throw new Error(data.message || 'Terjadi kesalahan saat menyimpan berita');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan: ' + error.message);
    });
});

document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah form submit default

    // Pastikan konten TinyMCE diambil dan dimasukkan ke textarea
    if (tinymce.get('editKonten')) {
        document.getElementById('editKonten').value = tinymce.get('editKonten').getContent();
    }

    // Buat FormData dari form
    const formData = new FormData(this);

    // Submit form dengan fetch API
    fetch(this.action, {
        method: 'POST', // Tetap gunakan POST karena kita sudah menambahkan _method: PUT
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Berita berhasil diperbarui!');
            window.location.reload();
        } else {
            throw new Error(data.message || 'Terjadi kesalahan saat memperbarui berita');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan: ' + error.message);
    });
});

// Inisialisasi TinyMCE untuk form edit
function initEditEditor() {
    tinymce.init({
        selector: '#editKonten',
        height: 400,
        menubar: false,
        plugins: [
            'lists', 'link', 'image', 'code'
        ],
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
        browser_spellcheck: true,
        contextmenu: false,
        autocomplete: false,
        setup: function (editor) {
            editor.on('init', function () {
                document.getElementById('editKonten').required = false;
            });
        }
    });
}

function openEditModal(id) {
    // Inisialisasi editor terlebih dahulu
    initEditEditor();

    fetch(`/cms/berita/edit/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editJudul').value = data.judul;
            setTimeout(() => {
                if (tinymce.get('editKonten')) {
                    tinymce.get('editKonten').setContent(data.konten);
                }
            }, 500);
            document.getElementById('editTanggal').value = data.tanggal;
            document.getElementById('currentImage').src = `/images/${data.image}`;
            document.getElementById('editForm').action = `/cms/berita/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data berita: ' + error.message);
        });
}

function closeEditModal() {
    // Hapus instance TinyMCE saat modal ditutup
    if (tinymce.get('editKonten')) {
        tinymce.get('editKonten').remove();
    }
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}

function showPhotosModal(photos) {
    const modal = document.getElementById('photosModal');
    const container = document.getElementById('photosContainer');

    container.innerHTML = '';

    photos.forEach(photo => {
        const photoDiv = document.createElement('div');
        photoDiv.className = 'relative pt-[100%]';
        photoDiv.innerHTML = `
            <div class="absolute inset-0 p-1">
                <img src="/images/${photo}"
                     class="w-full h-full rounded-lg cursor-pointer hover:opacity-75 transition-opacity object-contain bg-gray-100"
                     onclick="window.open('/images/${photo}', '_blank')"
                     alt="Berita Photo">
            </div>
        `;
        container.appendChild(photoDiv);
    });

    modal.classList.remove('hidden');
}

function closePhotosModal() {
    document.getElementById('photosModal').classList.add('hidden');
}

document.getElementById('photosModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePhotosModal();
    }
});

function initializeTinyMCE(selector) {
    return tinymce.init({
        selector: selector,
        height: 400,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
        formats: {
            bold: { inline: 'strong' },
            italic: { inline: 'em' },
            underline: { inline: 'u' },
            strikethrough: { inline: 'strike' }
        },
        cleanup: false,
        verify_html: false,
        valid_elements: '*[*]', // Izinkan semua elemen HTML
        extended_valid_elements: '*[*]', // Izinkan semua atribut
        promotion: false,
        branding: false
    });
}

// Tambahkan event listener untuk debugging
window.addEventListener('load', function() {
    console.log('Form action:', document.getElementById('addForm').action);
    console.log('CSRF token:', document.querySelector('meta[name="csrf-token"]')?.content);
});
</script>
@endsection
