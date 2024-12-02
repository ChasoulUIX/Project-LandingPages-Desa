@extends('layouts.app')

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
                            <div class="border-b pb-4">
                                <h3 class="font-medium text-lg text-gray-900 mb-2">Gotong Royong Pembangunan Jalan Desa</h3>
                                <p class="text-gray-600 mb-2">Kegiatan gotong royong pembangunan jalan desa yang melibatkan seluruh warga akan dilaksanakan pada hari Minggu...</p>
                                <span class="text-sm text-gray-500">15 Februari 2024</span>
                            </div>
                            <div class="border-b pb-4">
                                <h3 class="font-medium text-lg text-gray-900 mb-2">Vaksinasi Covid-19 Tahap 2</h3>
                                <p class="text-gray-600 mb-2">Program vaksinasi Covid-19 tahap kedua akan dilaksanakan di Balai Desa mulai tanggal 20 Februari 2024...</p>
                                <span class="text-sm text-gray-500">12 Februari 2024</span>
                            </div>
                            <div class="pb-4">
                                <h3 class="font-medium text-lg text-gray-900 mb-2">Pembagian BLT Dana Desa</h3>
                                <p class="text-gray-600 mb-2">Pembagian Bantuan Langsung Tunai Dana Desa periode Februari 2024 akan dilaksanakan mulai tanggal...</p>
                                <span class="text-sm text-gray-500">10 Februari 2024</span>
                            </div>
                        </div>
                    </div>

                    <!-- Program Desa -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-semibold text-blue-900 mb-6">Program Desa</h2>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="text-yellow-500 mt-1">
                                    <i class="fas fa-seedling text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Program Pertanian</h3>
                                    <p class="text-gray-600">Pengembangan pertanian organik dan pelatihan petani untuk meningkatkan hasil panen</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="text-yellow-500 mt-1">
                                    <i class="fas fa-graduation-cap text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Program Pendidikan</h3>
                                    <p class="text-gray-600">Beasiswa untuk siswa berprestasi dan bantuan pendidikan untuk keluarga tidak mampu</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="text-yellow-500 mt-1">
                                    <i class="fas fa-heartbeat text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Program Kesehatan</h3>
                                    <p class="text-gray-600">Posyandu rutin dan pemeriksaan kesehatan gratis untuk lansia</p>
                                </div>
                            </div>
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

                            <!-- Chart RT/RW -->
                            <div class="bg-white p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Pembagian Wilayah</h3>
                                <div class="h-64">
                                    <canvas id="areaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Konfigurasi chart penduduk
                    const populationCtx = document.getElementById('populationChart').getContext('2d');
                    new Chart(populationCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Total Penduduk', 'Kepala Keluarga'],
                            datasets: [{
                                data: [2500, 650],
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

                    // Konfigurasi chart wilayah
                    const areaCtx = document.getElementById('areaChart').getContext('2d');
                    new Chart(areaCtx, {
                        type: 'bar',
                        data: {
                            labels: ['RT', 'RW'],
                            datasets: [{
                                label: 'Jumlah',
                                data: [15, 4],
                                backgroundColor: ['#FCD34D', '#FBBF24'],
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
