@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-20">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-8 sm:py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button and Title -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 sm:mb-8">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300 mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-center">
                        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-2">APBDES</h1>
                        <p class="text-xs sm:text-sm text-blue-100">Transparansi Penggunaan Dana Desa</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <!-- Overview Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Total Dana Desa</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">Rp {{ number_format(\App\Models\DanaDesa::sum('anggaran'), 0, ',', '.') }}</h3>
                        <p class="text-xs text-green-600">Tahun Anggaran {{ date('Y') }}</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Dana Terserap</p>
                        @php
                            $totalAnggaran = \App\Models\DanaDesa::sum('anggaran');
                            $terserap = \App\Models\DanaDesa::all()->sum(function($program) {
                                return ($program->anggaran * $program->progress) / 100;
                            });
                            $persentase = $totalAnggaran > 0 ? ($terserap / $totalAnggaran) * 100 : 0;
                        @endphp
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">Rp {{ number_format($terserap, 0, ',', '.') }}</h3>
                        <p class="text-xs text-blue-600">{{ number_format($persentase, 1) }}% dari total</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Sisa Anggaran</p>
                        @php
                            $sisa = $totalAnggaran - $terserap;
                            $persentaseSisa = $totalAnggaran > 0 ? ($sisa / $totalAnggaran) * 100 : 0;
                        @endphp
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">Rp {{ number_format($sisa, 0, ',', '.') }}</h3>
                        <p class="text-xs text-orange-600">{{ number_format($persentaseSisa, 1) }}% tersisa</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Total Program</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">{{ \App\Models\DanaDesa::count() }}</h3>
                        <p class="text-xs text-gray-600">Program Aktif</p>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Grafik Distribusi Dana per Kategori -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Distribusi Dana per Kategori</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="kategoriChart"></canvas>
                        </div>
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                            @foreach(\App\Models\DanaDesa::select('kategori')->selectRaw('sum(anggaran) as total')->groupBy('kategori')->get() as $kat)
                                <div>• {{ $kat->kategori }}: {{ round(($kat->total / $totalAnggaran) * 100) }}%</div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Grafik Status Program -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Status Program</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                            @foreach(\App\Models\DanaDesa::select('status')->selectRaw('count(*) as total')->groupBy('status')->get() as $stat)
                                <div>• {{ $stat->status }}: {{ round(($stat->total / \App\Models\DanaDesa::count()) * 100) }}%</div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Program Details -->
                <div class="mt-6 sm:mt-8">
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-blue-900 mb-6">Detail Program dan Anggaran</h3>
                        
                        @foreach(['Infrastruktur', 'Pemberdayaan Masyarakat', 'Kesehatan'] as $category)
                            <div class="mb-8">
                                <h4 class="text-md font-medium text-blue-800 mb-4">{{ $category }}</h4>
                                <div class="space-y-4">
                                    @foreach(\App\Models\DanaDesa::where('kategori', $category)->get() as $program)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="font-medium">{{ $program->nama_program }}</span>
                                                <span class="text-blue-600">Rp {{ number_format($program->anggaran, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $program->progress }}%"></div>
                                            </div>
                                            <div class="flex justify-between text-sm text-gray-600 mt-1">
                                                <span>Progress: {{ $program->progress }}%</span>
                                                <span>Target: {{ $program->target }}</span>
                                            </div>
                                            <div class="mt-2">
                                                <span class="px-2 py-1 text-xs rounded-full {{ $program->status === 'Selesai' ? 'bg-green-100 text-green-800' : ($program->status === 'Berjalan' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ $program->status }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.font.size = window.innerWidth < 640 ? 10 : 12;
        
        // Kategori Chart
        const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
        new Chart(kategoriCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(\App\Models\DanaDesa::select('kategori')->groupBy('kategori')->pluck('kategori')) !!},
                datasets: [{
                    data: {!! json_encode(\App\Models\DanaDesa::select('kategori')->selectRaw('sum(anggaran) as total')->groupBy('kategori')->pluck('total')) !!},
                    backgroundColor: ['#3B82F6', '#EC4899', '#10B981'],
                    borderWidth: 0
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
                cutout: '70%'
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'polarArea',
            data: {
                labels: {!! json_encode(\App\Models\DanaDesa::select('status')->groupBy('status')->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode(\App\Models\DanaDesa::select('status')->selectRaw('count(*) as total')->groupBy('status')->pluck('total')) !!},
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(236, 72, 153, 0.7)',
                        'rgba(16, 185, 129, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection
