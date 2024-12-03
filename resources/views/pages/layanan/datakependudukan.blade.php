@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-8 sm:py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">2,500</h3>
                        <p class="text-xs text-green-600">↑ 2.1% dari bulan lalu</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Kepala Keluarga</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">650</h3>
                        <p class="text-xs text-green-600">↑ 1.5% dari bulan lalu</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Penduduk Produktif</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">1,600</h3>
                        <p class="text-xs text-blue-600">64% dari total penduduk</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-gray-600">Rasio Gender</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900">1.02</h3>
                        <p class="text-xs text-gray-600">Laki-laki : Perempuan</p>
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
                                <p class="font-semibold">1,200 (48%)</p>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-600">Perempuan</p>
                                <p class="font-semibold">1,300 (52%)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Penduduk Berdasarkan Usia -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Distribusi Usia</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="ageChart"></canvas>
                        </div>
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                            <div>• 0-14 tahun: Anak-anak (20%)</div>
                            <div>• 15-24 tahun: Remaja (24%)</div>
                            <div>• 25-54 tahun: Dewasa (40%)</div>
                            <div>• 55+ tahun: Lansia (16%)</div>
                        </div>
                    </div>

                    <!-- Grafik Penduduk Berdasarkan Pendidikan -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Tingkat Pendidikan</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="educationChart"></canvas>
                        </div>
                        <div class="mt-3 sm:mt-4 text-xs">
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-gray-600">
                                <div>• SD: 16%</div>
                                <div>• SMP: 20%</div>
                                <div>• SMA: 32%</div>
                                <div>• D3: 12%</div>
                                <div>• S1: 16%</div>
                                <div>• S2/S3: 4%</div>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Penduduk Berdasarkan Pekerjaan -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-blue-900 mb-3 sm:mb-4">Mata Pencaharian</h3>
                        <div class="h-40 sm:h-48">
                            <canvas id="occupationChart"></canvas>
                        </div>
                        <div class="mt-3 sm:mt-4 grid grid-cols-2 gap-2 text-xs text-gray-600">
                            <div>• Petani: 24%</div>
                            <div>• Pedagang: 16%</div>
                            <div>• PNS: 8%</div>
                            <div>• Swasta: 20%</div>
                            <div>• Wirausaha: 12%</div>
                            <div>• Lainnya: 20%</div>
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
                    data: [1200, 1300],
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
                    data: [500, 600, 1000, 400],
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
                labels: ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2/S3'],
                datasets: [{
                    data: [400, 500, 800, 300, 400, 100],
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
                labels: ['Petani', 'Pedagang', 'PNS', 'Swasta', 'Wirausaha', 'Lainnya'],
                datasets: [{
                    label: 'Jumlah',
                    data: [600, 400, 200, 500, 300, 500],
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
