@extends('cms.layouts.app')

@section('title', 'Surat Keterangan Domisili')

@section('content')
<div class="p-6">

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TTL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RT/RW</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokumen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach(App\Models\KeteranganDomisili::all() as $domisili)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $domisili->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $domisili->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $domisili->nik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $domisili->tempat_lahir }}, {{ $domisili->tanggal_lahir }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $domisili->alamat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $domisili->rt }}/{{ $domisili->rw }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $domisili->status === 'Disetujui' ? 'bg-green-100 text-green-800' : 
                               ($domisili->status === 'Ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $domisili->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex space-x-2">
                            @if($domisili->ktp_file)
                            <a href="{{ asset('images/' . $domisili->ktp_file) }}" target="_blank" class="text-blue-500 hover:text-blue-600">
                                <i class="fas fa-id-card"></i>
                            </a>
                            @endif
                            @if($domisili->kk_file)
                            <a href="{{ asset('images/' . $domisili->kk_file) }}" target="_blank" class="text-blue-500 hover:text-blue-600">
                                <i class="fas fa-file-alt"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="openEditModal({{ $domisili->id }}, '{{ $domisili->status }}')" class="text-yellow-500 hover:text-yellow-600">
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
        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <input type="hidden" id="domisili_id" name="domisili_id">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                <select id="status" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="Menunggu">Menunggu</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
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
        
        form.action = `/cms/domisili/${id}/update-status`;
        document.getElementById('domisili_id').value = id;
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
