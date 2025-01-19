@extends('user.layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-20">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Back Button and Title -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <a href="{{ url('/layanan') }}" class="inline-flex items-center text-white hover:text-blue-200 transition duration-300 mb-4 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-center">
                        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">APBDES</h1>
                        <p class="text-sm text-blue-100">Transparansi Penggunaan Dana Desa</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <!-- Filter Options -->
                <div class="flex flex-wrap gap-4 mb-8">

                    <div class="flex-1 min-w-[200px]">
                        <select id="categoryFilter" class="w-full bg-white/90 backdrop-blur rounded-lg px-4 py-2.5 text-gray-700 border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                            <option value="">Pilih Kategori</option>
                            @foreach(\App\Models\DanaDesa::all()->unique('kategori') as $category)
                                <option value="{{ $category->kategori }}">{{ $category->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <select id="statusFilter" class="w-full bg-white/90 backdrop-blur rounded-lg px-4 py-2.5 text-gray-700 border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors">
                            <option value="">Status Program</option>
                            @foreach(\App\Models\DanaDesa::all()->unique('status') as $status)
                                <option value="{{ $status->status }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Overview Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white/90 backdrop-blur rounded-lg p-4">
                        <p class="text-sm text-gray-600">Total Dana Desa</p>
                        <h3 class="text-2xl font-bold text-blue-900 overview-total">{{ \App\Models\DanaDesa::all()->sum('anggaran') }}</h3>
                        <p class="text-xs text-green-600">Tahun Anggaran {{ date('Y') }}</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-4">
                        <p class="text-sm text-gray-600">Terserap</p>
                        <h3 class="text-2xl font-bold text-blue-900 overview-terserap">{{ \App\Models\DanaDesa::all()->sum(function($program) {
                            return ($program->anggaran * $program->progress) / 100;
                        }) }}</h3>
                        <p class="text-xs text-blue-600">{{ \App\Models\DanaDesa::all()->sum(function($program) {
                            return ($program->anggaran * $program->progress) / 100;
                        }) }}</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-4">
                        <p class="text-sm text-gray-600">Sisa Anggaran</p>
                        <h3 class="text-2xl font-bold text-blue-900 overview-sisa">{{ \App\Models\DanaDesa::all()->sum('anggaran') - \App\Models\DanaDesa::all()->sum(function($program) {
                            return ($program->anggaran * $program->progress) / 100;
                        }) }}</h3>
                        <p class="text-xs text-orange-600">{{ \App\Models\DanaDesa::all()->sum('anggaran') - \App\Models\DanaDesa::all()->sum(function($program) {
                            return ($program->anggaran * $program->progress) / 100;
                        }) }}</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur rounded-lg p-4">
                        <p class="text-sm text-gray-600">Total Program</p>
                        <h3 class="text-2xl font-bold text-blue-900 overview-total-program">{{ \App\Models\DanaDesa::all()->count() }}</h3>
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
                            @foreach(\App\Models\DanaDesa::where('kategori', 'Infrastruktur')->get() as $program)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-medium">{{ $program->nama_program }}</span>
                                        <span class="text-blue-600">{{ $program->anggaran }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $program->progress }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-1">
                                        <span>Progress: {{ $program->progress }}%</span>
                                        <span>Target: {{ $program->target }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pemberdayaan Masyarakat -->
                    <div class="mb-8">
                        <h4 class="text-md font-medium text-blue-800 mb-4">Pemberdayaan Masyarakat (30%)</h4>
                        <div class="space-y-4">
                            @foreach(\App\Models\DanaDesa::where('kategori', 'Pemberdayaan Masyarakat')->get() as $program)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-medium">{{ $program->nama_program }}</span>
                                        <span class="text-blue-600">{{ $program->anggaran }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $program->progress }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-1">
                                        <span>Progress: {{ $program->progress }}%</span>
                                        <span>Target: {{ $program->target }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Kesehatan -->
                    <div>
                        <h4 class="text-md font-medium text-blue-800 mb-4">Kesehatan (30%)</h4>
                        <div class="space-y-4">
                            @foreach(\App\Models\DanaDesa::where('kategori', 'Kesehatan')->get() as $program)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-medium">{{ $program->nama_program }}</span>
                                        <span class="text-blue-600">{{ $program->anggaran }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $program->progress }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-1">
                                        <span>Progress: {{ $program->progress }}%</span>
                                        <span>Target: {{ $program->target }}</span>
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
        // Data structure untuk menyimpan semua data
        const programData = {
            2024: {
                overview: {
                    totalDana: "Rp 2.5 M",
                    terserap: "65%",
                    terserapNominal: "Rp 1.625 M",
                    sisaAnggaran: "35%",
                    sisaNominal: "Rp 875 Jt",
                    totalProgram: "24"
                },
                chartData: {
                    distribution: [40, 30, 30],
                    progress: [10, 25, 35, 48, 58, 65]
                },
                programs: {
                    infrastruktur: [
                        {
                            name: "Pembangunan Jalan Desa",
                            budget: "Rp 400 Jt",
                            progress: 75,
                            target: "Q2 2024",
                            status: "berjalan"
                        },
                        {
                            name: "Renovasi Balai Desa",
                            budget: "Rp 300 Jt",
                            progress: 60,
                            target: "Q3 2024",
                            status: "berjalan"
                        }
                    ],
                    pemberdayaan: [
                        {
                            name: "Pelatihan UMKM",
                            budget: "Rp 250 Jt",
                            progress: 80,
                            target: "Q2 2024",
                            status: "berjalan"
                        }
                    ],
                    kesehatan: [
                        {
                            name: "Pengadaan Ambulans Desa",
                            budget: "Rp 350 Jt",
                            progress: 90,
                            target: "Q1 2024",
                            status: "berjalan"
                        }
                    ]
                }
            },
            2023: {
                // Similar structure for 2023
                overview: {
                    totalDana: "Rp 2.0 M",
                    terserap: "100%",
                    terserapNominal: "Rp 2.0 M",
                    sisaAnggaran: "0%",
                    sisaNominal: "Rp 0",
                    totalProgram: "20"
                },
                chartData: {
                    distribution: [45, 25, 30],
                    progress: [15, 30, 45, 60, 85, 100]
                },
                programs: {
                    // Add 2023 programs here
                }
            },
            2022: {
                // Similar structure for 2022
            }
        };

        let budgetDistributionChart, monthlyProgressChart;

        // Initialize charts
        function initializeCharts() {
            const budgetCtx = document.getElementById('budgetDistributionChart').getContext('2d');
            budgetDistributionChart = new Chart(budgetCtx, {
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

            const progressCtx = document.getElementById('monthlyProgressChart').getContext('2d');
            monthlyProgressChart = new Chart(progressCtx, {
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
        }

        // Function to update the display based on filters
        function updateDisplay() {
            const selectedYear = document.getElementById('yearFilter').value;
            const selectedCategory = document.getElementById('categoryFilter').value;
            const selectedStatus = document.getElementById('statusFilter').value;

            if (!selectedYear) return;

            const yearData = programData[selectedYear];
            
            // Update overview cards
            updateOverviewCards(yearData.overview);
            
            // Update charts
            updateCharts(yearData, selectedCategory);
            
            // Update program details
            updateProgramDetails(yearData.programs, selectedCategory, selectedStatus);
        }

        // Function to update overview cards
        function updateOverviewCards(overview) {
            document.querySelector('.overview-total').textContent = overview.totalDana;
            document.querySelector('.overview-terserap').textContent = overview.terserap;
            document.querySelector('.overview-sisa').textContent = overview.sisaAnggaran;
            document.querySelector('.overview-total-program').textContent = overview.totalProgram;
        }

        // Function to update program details
        function updateProgramDetails(programs, category, status) {
            const categories = category ? [category] : Object.keys(programs);
            let html = '';

            categories.forEach(cat => {
                const programList = programs[cat];
                const filteredPrograms = status ? 
                    programList.filter(prog => prog.status === status) : 
                    programList;

                if (filteredPrograms.length === 0) return;

                html += `
                    <div class="mb-8">
                        <h4 class="text-md font-medium text-blue-800 mb-4">${cat.charAt(0).toUpperCase() + cat.slice(1)}</h4>
                        <div class="space-y-4">
                            ${filteredPrograms.map(program => `
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-medium">${program.name}</span>
                                        <span class="text-blue-600">${program.budget}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: ${program.progress}%"></div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-1">
                                        <span>Progress: ${program.progress}%</span>
                                        <span>Target: ${program.target}</span>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            });

            document.querySelector('.bg-white\\/95').innerHTML = `
                <h3 class="text-lg font-semibold text-blue-900 mb-6">Detail Program dan Anggaran</h3>
                ${html}
            `;
        }

        // Function to update charts
        function updateCharts(yearData, category) {
            // Update distribution chart
            const distributionData = yearData.chartData.distribution;
            budgetDistributionChart.data.datasets[0].data = category ? 
                distributionData.map((value, index) => {
                    const categories = ['infrastruktur', 'pemberdayaan', 'kesehatan'];
                    return categories[index] === category ? value : value;
                }) : 
                distributionData;
            
            monthlyProgressChart.data.datasets[0].data = yearData.chartData.progress;
            
            budgetDistributionChart.update();
            monthlyProgressChart.update();
        }

        // Add event listeners to filters
        document.getElementById('yearFilter').addEventListener('change', updateDisplay);
        document.getElementById('categoryFilter').addEventListener('change', updateDisplay);
        document.getElementById('statusFilter').addEventListener('change', updateDisplay);

        // Initialize the page
        initializeCharts();
        updateDisplay();
    </script>
@endsection
