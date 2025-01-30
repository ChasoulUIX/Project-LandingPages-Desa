@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Manajemen Dana Desa</h1>
        <a href="{{ route('dana.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Data
        </a>
    </div>

    <!-- Overview Cards -->
    <div class="grid gap-4 mb-6 grid-cols-2 md:grid-cols-4 md:gap-6 md:mb-8">
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Total Dana Desa</h4>
            <p class="text-gray-800 text-xl md:text-2xl font-bold">Rp {{ number_format(\App\Models\DanaDesa::sum('anggaran'), 0, ',', '.') }}</p>
            <p class="text-xs md:text-sm text-gray-600">Tahun Anggaran 2024</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Dana Terserap</h4>
            @php
                $totalAnggaran = \App\Models\DanaDesa::sum('anggaran');
                $terserap = \App\Models\DanaDesa::all()->sum(function($program) {
                    return ($program->anggaran * $program->progress) / 100;
                });
                $persentase = $totalAnggaran > 0 ? ($terserap / $totalAnggaran) * 100 : 0;
            @endphp
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ number_format($persentase, 1) }}%</p>
            <p class="text-xs md:text-sm text-gray-600">Rp {{ number_format($terserap, 0, ',', '.') }}</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Sisa Anggaran</h4>
            @php
                $sisa = $totalAnggaran - $terserap;
                $persentaseSisa = $totalAnggaran > 0 ? ($sisa / $totalAnggaran) * 100 : 0;
            @endphp
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ number_format($persentaseSisa, 1) }}%</p>
            <p class="text-xs md:text-sm text-gray-600">Rp {{ number_format($sisa, 0, ',', '.') }}</p>
        </div>
        <div class="min-w-0 p-3 md:p-4 bg-white rounded-lg shadow-sm">
            <h4 class="mb-2 md:mb-4 font-semibold text-gray-600 text-sm md:text-base">Total Program</h4>
            <p class="text-gray-800 text-xl md:text-2xl font-bold">{{ $totalPrograms }}</p>
            <p class="text-xs md:text-sm text-gray-600">Program Aktif</p>
        </div>
    </div>

    <!-- Data Grid -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm md:text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggaran</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                        <th class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\DanaDesa::all() as $program)
                    <tr class="text-gray-700">
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $program->nama_program }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $program->kategori }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">Rp {{ number_format($program->anggaran, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <div class="relative pt-1">
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                    <div style="width: {{ $program->progress }}%" 
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center {{ $program->progress < 50 ? 'bg-red-500' : ($program->progress < 75 ? 'bg-yellow-500' : 'bg-green-500') }}">
                                    </div>
                                </div>
                                <div class="text-xs mt-1">{{ $program->progress }}%</div>
                            </div>
                        </td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $program->status === 'Selesai' ? 'text-green-700 bg-green-100' : ($program->status === 'Berjalan' ? 'text-yellow-700 bg-yellow-100' : 'text-gray-700 bg-gray-100') }}">
                                {{ $program->status }}
                            </span>
                        </td>
                        <td class="px-3 py-2 md:px-6 md:py-4">{{ $program->target }}</td>
                        <td class="px-3 py-2 md:px-6 md:py-4">
                            <a href="{{ route('dana.tambahdana', ['id' => $program->id, 'program' => $program]) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="deleteData({{ $program->id }})" class="text-red-500 hover:text-red-700 ml-2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data program dana desa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
function deleteData(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        // Menggunakan jQuery untuk AJAX request (pastikan jQuery sudah dimuat)
        $.ajax({
            url: `/cms/dana/${id}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.reload();
                } else {
                    alert(response.message || 'Gagal menghapus data');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                alert('Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
            }
        });
    }
}
</script>
@endpush

@endsection
