@extends('cms.layouts.app')

@section('title', 'Surat Keterangan Kelahiran')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Anak</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat Lahir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ayah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ibu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach(App\Models\SuratKelahiran::all() as $surat)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->nama_anak }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->tempat_lahir }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->tanggal_lahir }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->jenis_kelamin }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->nama_ayah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $surat->nama_ibu }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $surat->status === 'completed' ? 'bg-green-100 text-green-800' : 
                               ($surat->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $surat->status_indonesia }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="openEditModal({{ $surat->id }}, '{{ $surat->status }}')" class="text-yellow-500 hover:text-yellow-600">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 max-w-md w-full m-4">
        <h2 class="text-xl font-bold mb-4">Ubah Status Surat</h2>
        <form id="editForm" method="POST" data-base-url="{{ route('cms.kelahiran.update-status', ['id' => ':id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                <select id="status" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="pending">Menunggu</option>
                    <option value="approved">Disetujui</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                    Batal
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openEditModal(id, currentStatus) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const statusSelect = document.getElementById('status');
        
        // Update form action URL menggunakan data-base-url
        const baseUrl = form.dataset.baseUrl;
        form.action = baseUrl.replace(':id', id);
        
        statusSelect.value = currentStatus;
        
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.getElementById('editForm').reset();
    }

    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>
@endpush
