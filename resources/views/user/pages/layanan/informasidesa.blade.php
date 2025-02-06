@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button and Title -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8 sm:mb-12">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300 mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-center">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2 sm:mb-4">Informasi Desa</h1>
                        <p class="text-sm sm:text-base text-blue-100">Informasi terkini seputar kegiatan dan program desa</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Berita & Pengumuman -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-semibold text-blue-900 mb-6">Berita & Pengumuman</h2>
                        <div class="space-y-6">
                            @foreach(\App\Models\Berita::orderBy('tanggal', 'desc')->take(3)->get() as $berita)
                                <div class="{{ !$loop->last ? 'border-b' : '' }} pb-4">
                                    <h3 class="font-medium text-lg text-gray-900 mb-2">{{ $berita->judul }}</h3>
                                    <p class="text-gray-600 mb-2">{{ Str::limit($berita->konten, 120) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Program & Kegiatan Desa -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-semibold text-blue-900 mb-6">Program & Kegiatan Desa</h2>
                        <div class="space-y-6">
                            @foreach(\App\Models\Kegiatan::orderBy('tgl_mulai', 'desc')->take(3)->get() as $kegiatan)
                                <div class="flex items-start space-x-4">
                                    <div class="text-yellow-500 mt-1">
                                        @if($kegiatan->kategori == 'pertanian')
                                            <i class="fas fa-seedling text-xl"></i>
                                        @elseif($kegiatan->kategori == 'pendidikan')
                                            <i class="fas fa-graduation-cap text-xl"></i>
                                        @elseif($kegiatan->kategori == 'kesehatan')
                                            <i class="fas fa-heartbeat text-xl"></i>
                                        @else
                                            <i class="fas fa-calendar-alt text-xl"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $kegiatan->judul }}</h3>
                                        <p class="text-gray-600">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                                        <div class="mt-2 text-sm text-gray-500">
                                            <span class="mr-4">Anggaran: Rp {{ number_format($kegiatan->anggaran, 0, ',', '.') }}</span>
                                            <span>Progress: {{ $kegiatan->progress }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                            <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ $kegiatan->progress }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Statistik Desa -->
                <div class="mt-8">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-semibold text-blue-900 mb-6">Statistik Desa</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Chart Penduduk -->
                            <div class="bg-white p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Demografi Penduduk</h3>
                                <div class="h-64">
                                    <canvas id="populationChart"></canvas>
                                </div>
                            </div>

                            <!-- Chart Pekerjaan -->
                            <div class="bg-white p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Pekerjaan</h3>
                                <div class="h-64">
                                    <canvas id="occupationChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Konfigurasi chart penduduk berdasarkan jenis kelamin
                    const populationData = @json(\App\Models\Kependudukan::query()
                        ->selectRaw('jenis_kelamin, COUNT(*) as total')
                        ->groupBy('jenis_kelamin')
                        ->pluck('total', 'jenis_kelamin')
                        ->toArray());

                    const populationCtx = document.getElementById('populationChart').getContext('2d');
                    new Chart(populationCtx, {
                        type: 'doughnut',
                        data: {
                            labels: Object.keys(populationData),
                            datasets: [{
                                data: Object.values(populationData),
                                backgroundColor: ['#3B82F6', '#60A5FA'],
                                borderWidth: 0,
                                borderRadius: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            },
                            cutout: '70%'
                        }
                    });

                    // Konfigurasi chart pekerjaan
                    const occupationData = @json(\App\Models\Kependudukan::query()
                        ->selectRaw('pekerjaan, COUNT(*) as total')
                        ->groupBy('pekerjaan')
                        ->pluck('total', 'pekerjaan')
                        ->toArray());

                    const occupationCtx = document.getElementById('occupationChart').getContext('2d');
                    new Chart(occupationCtx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(occupationData),
                            datasets: [{
                                label: 'Jumlah',
                                data: Object.values(occupationData),
                                backgroundColor: [
                                    '#FCD34D', '#FBBF24', '#F59E0B', 
                                    '#D97706', '#B45309', '#92400E'
                                ],
                                borderRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: false
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        autoSkip: false,
                                        maxRotation: 45,
                                        minRotation: 45
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </main>
@endsection
