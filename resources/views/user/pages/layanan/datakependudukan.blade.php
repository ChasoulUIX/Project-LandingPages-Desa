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
                        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-white mb-2">Data Kependudukan</h1>
                        <p class="text-xs sm:text-sm text-blue-100">Statistik dan informasi kependudukan desa</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <!-- Overview Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Total Penduduk</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">{{ App\Models\Kependudukan::count() }}</h3>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Kepala Keluarga</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">{{ App\Models\Kependudukan::where('status_keluarga', 'Kepala Keluarga')->count() }}</h3>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Penduduk Produktif</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">{{ App\Models\Kependudukan::whereBetween('usia', [15, 64])->count() }}</h3>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Rasio Gender</p>
                        @php
                            $laki = App\Models\Kependudukan::where('jenis_kelamin', 'Laki-laki')->count();
                            $perempuan = App\Models\Kependudukan::where('jenis_kelamin', 'Perempuan')->count();
                            $ratio = $perempuan > 0 ? number_format($laki / $perempuan, 2) : 0;
                        @endphp
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">{{ $ratio }}:1</h3>
                        <p class="text-xs text-gray-600">{{ $laki }} laki-laki per {{ $perempuan }} perempuan</p>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Grafik Penduduk Berdasarkan Jenis Kelamin -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Komposisi Gender</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="genderChart"></canvas>
                        </div>
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-3 sm:gap-4 text-xs sm:text-sm">
                            <div class="text-center">
                                <p class="text-gray-600">Laki-laki</p>
                                <p class="font-semibold">{{ $laki }} ({{ round(($laki / App\Models\Kependudukan::count()) * 100) }}%)</p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-600">Perempuan</p>
                                <p class="font-semibold">{{ $perempuan }} ({{ round(($perempuan / App\Models\Kependudukan::count()) * 100) }}%)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Penduduk Berdasarkan Usia -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Distribusi Usia</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="ageChart"></canvas>
                        </div>
                        @php
                            $anak = App\Models\Kependudukan::where('usia', '<', 15)->count();
                            $remaja = App\Models\Kependudukan::whereBetween('usia', [15, 24])->count();
                            $dewasa = App\Models\Kependudukan::whereBetween('usia', [25, 54])->count();
                            $lansia = App\Models\Kependudukan::where('usia', '>=', 55)->count();
                            $total = App\Models\Kependudukan::count();
                        @endphp
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                            <div>• 0-14 tahun: Anak-anak ({{ round(($anak / App\Models\Kependudukan::count()) * 100) }}%)</div>
                            <div>• 15-24 tahun: Remaja ({{ round(($remaja / App\Models\Kependudukan::count()) * 100) }}%)</div>
                            <div>• 25-54 tahun: Dewasa ({{ round(($dewasa / $total) * 100) }}%)</div>
                            <div>• 55+ tahun: Lansia ({{ round(($lansia / $total) * 100) }}%)</div>
                        </div>
                    </div>

                    <!-- Grafik Penduduk Berdasarkan Pendidikan -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Tingkat Pendidikan</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="educationChart"></canvas>
                        </div>
                        @php
                            $pendidikan = [
                                'SD' => App\Models\Kependudukan::where('pendidikan', 'SD')->count(),
                                'SMP' => App\Models\Kependudukan::where('pendidikan', 'SMP')->count(),
                                'SMA' => App\Models\Kependudukan::where('pendidikan', 'SMA')->count(),
                                'D3' => App\Models\Kependudukan::where('pendidikan', 'D3')->count(),
                                'S1' => App\Models\Kependudukan::where('pendidikan', 'S1')->count(),
                                'S2/S3' => App\Models\Kependudukan::whereIn('pendidikan', ['S2', 'S3'])->count()
                            ];
                        @endphp
                        <div class="mt-3 sm:mt-4 text-xs">
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-gray-600">
                                @foreach($pendidikan as $level => $count)
                                    <div>• {{ $level }}: {{ round(($count / App\Models\Kependudukan::count()) * 100) }}%</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Penduduk Berdasarkan Pekerjaan -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Mata Pencaharian</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="occupationChart"></canvas>
                        </div>
                        @php
                            $pekerjaan = [
                                'Petani' => App\Models\Kependudukan::where('mata_pencaharian', 'Petani')->count(),
                                'Pedagang' => App\Models\Kependudukan::where('mata_pencaharian', 'Pedagang')->count(),
                                'PNS' => App\Models\Kependudukan::where('mata_pencaharian', 'PNS')->count(),
                                'Swasta' => App\Models\Kependudukan::where('mata_pencaharian', 'Swasta')->count(),
                                'Wirausaha' => App\Models\Kependudukan::where('mata_pencaharian', 'Wirausaha')->count(),
                                'Lainnya' => App\Models\Kependudukan::whereNotIn('mata_pencaharian', ['Petani', 'Pedagang', 'PNS', 'Swasta', 'Wirausaha'])->count()
                            ];
                        @endphp
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                            @foreach($pekerjaan as $jenis => $count)
                                <div>• {{ $jenis }}: {{ round(($count / App\Models\Kependudukan::count()) * 100) }}%</div>
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
        
        // Data Jenis Kelamin
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $laki }}, {{ $perempuan }}],
                    backgroundColor: ['#3B82F6', '#EC4899'],
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

        // Data Usia
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ['0-14', '15-24', '25-54', '55+'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{{ $anak }}, {{ $remaja }}, {{ $dewasa }}, {{ $lansia }}],
                    backgroundColor: '#3B82F6',
                    borderRadius: 4
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
                        }
                    }
                }
            }
        });

        // Data Pendidikan
        const educationCtx = document.getElementById('educationChart').getContext('2d');
        new Chart(educationCtx, {
            type: 'polarArea',
            data: {
                labels: {!! json_encode(array_keys($pendidikan)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($pendidikan)) !!},
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(236, 72, 153, 0.7)', 
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(99, 102, 241, 0.7)',
                        'rgba(139, 92, 246, 0.7)'
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

        // Data Pekerjaan
        const occupationCtx = document.getElementById('occupationChart').getContext('2d');
        new Chart(occupationCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($pekerjaan)) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode(array_values($pekerjaan)) !!},
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
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
                        }
                    }
                }
            }
        });
    </script>
@endsection
