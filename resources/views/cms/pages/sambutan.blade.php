@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Sambutan Kepala Desa</h1>
        <button onclick="openEditModal({{ $sambutan->id }})" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg flex items-center transition duration-300 ease-in-out transform hover:scale-105">
            <i class="fas fa-edit mr-2"></i> Edit Sambutan
        </button>
    </div>

    <!-- Sambutan Display -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="relative">
            @if($sambutan->image)
                <img src="{{ asset('images/' . $sambutan->image) }}" alt="{{ $sambutan->nama }}" class="w-64 h-64 object-contain float-left mr-6">
            @else
                <img src="{{ asset('images/default.jpg') }}" alt="Default Image" class="w-64 h-64 object-contain float-left mr-6">
            @endif
            <div class="absolute top-0 right-0 p-3 flex space-x-2">
                <button onclick="openEditModal({{ $sambutan->id }})" class="bg-white p-2 rounded-full shadow-md text-blue-600 hover:text-blue-800 transition duration-300">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $sambutan->nama }}</h3>
            <p class="text-blue-600 font-semibold text-md mb-2">{{ $sambutan->jabatan }}</p>
            <p class="text-gray-600">{{ $sambutan->sambutan }}</p>
            <p class="text-gray-600 mt-4">Periode: {{ $sambutan->periode }}</p>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-md mx-4 shadow-2xl transform transition-all">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-2xl font-bold text-gray-900">Edit Sambutan</h3>
                <button onclick="closeEditModal()" class="text-gray-600 hover:text-gray-800 transition duration-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="editForm" method="POST" action="{{ route('sambutan.update', $sambutan->id) }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                        <input type="text" name="nama" id="edit_nama" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                        <input type="text" name="jabatan" id="edit_jabatan" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Sambutan</label>
                        <textarea name="sambutan" id="edit_sambutan" rows="6" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                        <input type="text" name="periode" id="edit_periode" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Baru (Opsional)</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @if($sambutan->image)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Current image: {{ $sambutan->image }}</p>
                                <input type="hidden" name="old_image" value="{{ $sambutan->image }}">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-8">
                    <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-3 px-4 hover:bg-blue-700 transition duration-300 font-semibold">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(id) {
    fetch(`/cms/sambutan/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_nama').value = data.nama;
            document.getElementById('edit_jabatan').value = data.jabatan;
            document.getElementById('edit_sambutan').value = data.sambutan;
            document.getElementById('edit_periode').value = data.periode;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}
</script>
@endsection
