@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-10">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button and Title -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300 mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-center">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Dana Desa</h1>
                        <p class="text-sm text-blue-100">Transparansi Penggunaan Dana Desa</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <!-- Overview Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white/90 backdrop-blur rounded-lg p-4">
                        <p class="text-sm text-gray-600">Total Dana Desa</p>
                        <h3 class="text-2xl font-bold text-blue-900">Rp 2.5 M</h3>
                        <p class="text-xs text-green-600">Tahun Anggaran 2024</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-4">
                        <p class="text-sm text-gray-600">Terserap</p>
                        <h3 class="text-2xl font-bold text-blue-900">65%</h3>
                        <p class="text-xs text-blue-600">Rp 1.625 M</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-4">
                        <p class="text-sm text-gray-600">Sisa Anggaran</p>
                        <h3 class="text-2xl font-bold text-blue-900">35%</h3>
                        <p class="text-xs text-orange-600">Rp 875 Jt</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-4">
                        <p class="text-sm text-gray-600">Total Program</p>
                        <h3 class="text-2xl font-bold text-blue-900">24</h3>
                        <p class="text-xs text-gray-600">Program Aktif</p>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Grafik Penggunaan Dana -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4">Distribusi Penggunaan Dana</h3>
                        <div class="h-64">
                            <canvas id="budgetDistributionChart"></canvas>
                        </div>
                    </div>

                    <!-- Grafik Progress Bulanan -->
                    <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4">Progress Penyerapan Dana</h3>
                        <div class="h-64">
                            <canvas id="monthlyProgressChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Detail Program -->
                <div class="bg-white/95 backdrop-blur rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-6">Detail Program dan Anggaran</h3>
                    
                    <!-- Infrastruktur -->
                    <div class="mb-8">
                        <h4 class="text-md font-medium text-blue-800 mb-4">Infrastruktur (40%)</h4>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">Pembangunan Jalan Desa</span>
                                    <span class="text-blue-600">Rp 400 Jt</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600 mt-1">
                                    <span>Progress: 75%</span>
                                    <span>Target: Q2 2024</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">Renovasi Balai Desa</span>
                                    <span class="text-blue-600">Rp 300 Jt</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 60%"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600 mt-1">
                                    <span>Progress: 60%</span>
                                    <span>Target: Q3 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pemberdayaan Masyarakat -->
                    <div class="mb-8">
                        <h4 class="text-md font-medium text-blue-800 mb-4">Pemberdayaan Masyarakat (30%)</h4>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">Pelatihan UMKM</span>
                                    <span class="text-blue-600">Rp 250 Jt</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 80%"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600 mt-1">
                                    <span>Progress: 80%</span>
                                    <span>Target: Q2 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kesehatan -->
                    <div>
                        <h4 class="text-md font-medium text-blue-800 mb-4">Kesehatan (30%)</h4>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">Pengadaan Ambulans Desa</span>
                                    <span class="text-blue-600">Rp 350 Jt</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 90%"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600 mt-1">
                                    <span>Progress: 90%</span>
                                    <span>Target: Q1 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Konfigurasi grafik distribusi anggaran
        const budgetCtx = document.getElementById('budgetDistributionChart').getContext('2d');
        new Chart(budgetCtx, {
            type: 'doughnut',
            data: {
                labels: ['Infrastruktur', 'Pemberdayaan Masyarakat', 'Kesehatan'],
                datasets: [{
                    data: [40, 30, 30],
                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Konfigurasi grafik progress bulanan
        const progressCtx = document.getElementById('monthlyProgressChart').getContext('2d');
        new Chart(progressCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Penyerapan Dana',
                    data: [10, 25, 35, 48, 58, 65],
                    borderColor: '#3B82F6',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(59, 130, 246, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
