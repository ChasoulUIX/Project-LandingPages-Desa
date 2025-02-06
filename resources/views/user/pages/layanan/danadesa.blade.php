@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-0">
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
                    <div class="w-24">
                        <select id="tahun" class="w-full rounded-lg text-sm bg-white/90 border-0 focus:ring-2 focus:ring-blue-400">
                            @foreach(\App\Models\DanaDesa::select('tahun_anggaran')->distinct()->orderBy('tahun_anggaran', 'desc')->get() as $tahun)
                                <option value="{{ $tahun->tahun_anggaran }}" {{ request('tahun', date('Y')) == $tahun->tahun_anggaran ? 'selected' : '' }}>
                                    {{ $tahun->tahun_anggaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Overview Cards -->
                @php
                    $selectedYear = request('tahun', date('Y'));
                    $query = \App\Models\DanaDesa::where('tahun_anggaran', $selectedYear);
                    $totalDana = $query->sum('nominal');
                    $terpakai = $query->sum('dana_terpakai');
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Total Dana Desa</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">Rp {{ number_format($totalDana, 0, ',', '.') }}</h3>
                        <p class="text-xs text-green-600">Tahun Anggaran {{ $selectedYear }}</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Dana Terpakai</p>
                        @php
                            $persentase = $totalDana > 0 ? ($terpakai / $totalDana) * 100 : 0;
                        @endphp
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">Rp {{ number_format($terpakai, 0, ',', '.') }}</h3>
                        <p class="text-xs text-blue-600">{{ number_format($persentase, 1) }}% dari total</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Sisa Anggaran</p>
                        @php
                            $sisa = $totalDana - $terpakai;
                            $persentaseSisa = $totalDana > 0 ? ($sisa / $totalDana) * 100 : 0;
                        @endphp
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">Rp {{ number_format($sisa, 0, ',', '.') }}</h3>
                        <p class="text-xs text-orange-600">{{ number_format($persentaseSisa, 1) }}% tersisa</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Total Program</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">{{ \App\Models\DanaDesa::where('tahun_anggaran', $selectedYear)->count() }}</h3>
                        <p class="text-xs text-gray-600">Program Aktif</p>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Grafik Distribusi Dana per Sumber -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Distribusi Dana per Sumber</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="sumberChart"></canvas>
                        </div>
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                            @foreach(\App\Models\DanaDesa::where('tahun_anggaran', $selectedYear)->select('sumber_anggaran')->selectRaw('sum(nominal) as total')->groupBy('sumber_anggaran')->get() as $sumber)
                                <div>• {{ $sumber->sumber_anggaran }}: {{ round(($sumber->total / $totalDana) * 100) }}%</div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Grafik Status Pencairan -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Status Pencairan</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                            @php
                                $totalDanaPencairan = $totalDana;
                                $persentasePencairan = $totalDana > 0 ? ($terpakai / $totalDana) * 100 : 0;
                                
                                if ($persentasePencairan == 100) {
                                    $statusPencairan = 'Sudah Cair 100%';
                                    $statusClass = 'bg-green-100 text-green-800';
                                } elseif ($persentasePencairan > 0) {
                                    $statusPencairan = 'Pencairan Sebagian (' . number_format($persentasePencairan, 1) . '%)';
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                } else {
                                    $statusPencairan = 'Belum Cair (0%)';
                                    $statusClass = 'bg-red-100 text-red-800';
                                }
                            @endphp
                            <div class="col-span-2 text-center mb-2">
                                <span class="px-3 py-1 rounded-full {{ $statusClass }}">
                                    {{ $statusPencairan }}
                                </span>
                            </div>
                            <div>• Total Dana: Rp {{ number_format($totalDanaPencairan, 0, ',', '.') }}</div>
                            <div>• Dana Terpakai: Rp {{ number_format($terpakai, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Program Details -->
                <div class="mt-6 sm:mt-8">
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-blue-900 mb-6">Detail Program dan Anggaran</h3>
                        
                        <div class="space-y-4">
                            @foreach(\App\Models\DanaDesa::where('tahun_anggaran', $selectedYear)->get() as $program)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-medium">{{ $program->nama_program }}</span>
                                        <span class="text-blue-600">Rp {{ number_format($program->nominal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        @php
                                            $progress = $program->nominal > 0 ? ($program->dana_terpakai / $program->nominal) * 100 : 0;
                                        @endphp
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-1">
                                        <span>Progress: {{ number_format($progress, 1) }}%</span>
                                        <span>Dana Terpakai: Rp {{ number_format($program->dana_terpakai, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $program->status_pencairan ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $program->status_pencairan ? 'Sudah Cair' : 'Belum Cair' }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
        
        // Update chart configurations
        const sumberChart = new Chart(document.getElementById('sumberChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(\App\Models\DanaDesa::where('tahun_anggaran', $selectedYear)->select('sumber_anggaran')->groupBy('sumber_anggaran')->pluck('sumber_anggaran')) !!},
                datasets: [{
                    data: {!! json_encode(\App\Models\DanaDesa::where('tahun_anggaran', $selectedYear)->select('sumber_anggaran')->selectRaw('sum(nominal) as total')->groupBy('sumber_anggaran')->pluck('total')) !!},
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

        const statusChart = new Chart(document.getElementById('statusChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Dana Desa'],
                datasets: [{
                    label: 'Dana Terpakai',
                    data: [{{ $terpakai }}],
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 1
                },
                {
                    label: 'Total Dana',
                    data: [{{ $totalDanaPencairan }}],
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                }
            }
        });

        // Add year filter handler
        document.getElementById('tahun').addEventListener('change', function() {
            window.location.href = '{{ url()->current() }}?tahun=' + this.value;
        });
    </script>
@endsection
