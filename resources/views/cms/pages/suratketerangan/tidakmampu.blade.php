@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Daftar Pengajuan Surat Keterangan Tidak Mampu</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">No</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">Nama</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">NIK</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">Pekerjaan</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">Penghasilan</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">Jumlah Tanggungan</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">Status Rumah</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">Keperluan</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-100 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Models\SuratTidakMampu::all() as $index => $surat)
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $surat->nama }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $surat->nik }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $surat->pekerjaan }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">Rp {{ number_format($surat->penghasilan, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $surat->jumlah_tanggungan }} orang</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ ucwords(str_replace('_', ' ', $surat->status_rumah)) }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">{{ $surat->keperluan }}</td>
                        <td class="px-6 py-4 border-b border-gray-300">
                            <span class="px-2 py-1 rounded text-sm 
                                @if($surat->status == 'pending') bg-yellow-200 text-yellow-800
                                @elseif($surat->status == 'approved') bg-green-200 text-green-800
                                @else bg-red-200 text-red-800
                                @endif">
                                {{ ucfirst($surat->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 border-b border-gray-300">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm"
                                    onclick="updateStatus({{ $surat->id }}, 'approved')">
                                Setujui
                            </button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                    onclick="updateStatus({{ $surat->id }}, 'rejected')">
                                Tolak
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function updateStatus(id, status) {
    if (confirm('Apakah Anda yakin ingin ' + (status === 'approved' ? 'menyetujui' : 'menolak') + ' pengajuan ini?')) {
        fetch(`/cms/tidak-mampu/${id}/update-status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Terjadi kesalahan saat memperbarui status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memperbarui status');
        });
    }
}
</script>
@endsection
