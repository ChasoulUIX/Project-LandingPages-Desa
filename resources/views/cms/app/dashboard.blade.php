@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <form id="yearForm" class="m-0">
            <select name="year" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @php
                    $years = \App\Models\DanaDesa::distinct()
                        ->orderBy('tahun_anggaran', 'desc')
                        ->pluck('tahun_anggaran');
                    $selectedYear = request('year', date('Y'));
                @endphp
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
    <div class="bg-white rounded-lg shadow-md p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Dana Desa</p>
                <h3 class="text-xl font-bold">
                    Rp {{ number_format(\App\Models\DanaDesa::whereNull('deleted_at')
                        ->where('tahun_anggaran', $selectedYear)
                        ->sum('nominal'), 0, ',', '.') }}
                </h3>
            </div>
            <div class="bg-blue-100 p-2 rounded-full">
                <i class="fas fa-money-bill text-blue-500 text-sm"></i>
            </div>
        </div>
    </div>  

    <div class="bg-white rounded-lg shadow-md p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Program</p>
                <h3 class="text-xl font-bold">{{ App\Models\Kegiatan::count() }}</h3>
            </div>
            <div class="bg-green-100 p-2 rounded-full">
                <i class="fas fa-tasks text-green-500 text-sm"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Penduduk</p>
                <h3 class="text-xl font-bold">{{ App\Models\Kependudukan::count() }}</h3>
            </div>
            <div class="bg-green-100 p-2 rounded-full">
                <i class="fas fa-users text-green-500 text-sm"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Pengaduan</p>
                <h3 class="text-xl font-bold">{{ App\Models\Pengaduan::count() }}</h3>
            </div>
            <div class="bg-red-100 p-2 rounded-full">
                <i class="fas fa-exclamation-circle text-red-500 text-sm"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <!-- Grafik Distribusi Dana per Kategori -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <h3 class="text-base font-semibold text-gray-800 mb-3">Distribusi Dana per Kategori</h3>
        <div class="h-48">
            <canvas id="kategoriChart"></canvas>
        </div>
    </div>

    <!-- Grafik Status Program -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <h3 class="text-base font-semibold text-gray-800 mb-3">Status Program</h3>
        <div class="h-48">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <!-- Grafik Demografi Penduduk -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <h3 class="text-base font-semibold text-gray-800 mb-3">Demografi Penduduk</h3>
        <div class="h-48">
            <canvas id="demografiChart"></canvas>
        </div>
    </div>

    <!-- Grafik Distribusi Usia -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <h3 class="text-base font-semibold text-gray-800 mb-3">Distribusi Usia</h3>
        <div class="h-48">
            <canvas id="usiaChart"></canvas>
        </div>
    </div>
</div>

<!-- Grafik Pendidikan, Pekerjaan, Status Keluarga -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <!-- Grafik Pendidikan -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <h3 class="text-base font-semibold text-gray-800 mb-3">Distribusi Pendidikan</h3>
        <div class="h-48">
            <canvas id="pendidikanChart"></canvas>
        </div>
    </div>

    <!-- Grafik Pekerjaan -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <h3 class="text-base font-semibold text-gray-800 mb-3">Distribusi Pekerjaan</h3>
        <div class="h-48">
            <canvas id="pekerjaanChart"></canvas>
        </div>
    </div>

    <!-- Grafik Status Keluarga -->
    <div class="bg-white rounded-xl shadow-lg p-4">
        <h3 class="text-base font-semibold text-gray-800 mb-3">Status dalam Keluarga</h3>
        <div class="h-48">
            <canvas id="statusKeluargaChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Data untuk Grafik Pendidikan
    const pendidikanData = {
        labels: {!! json_encode(App\Models\Kependudukan::select('pendidikan_terakhir')
            ->groupBy('pendidikan_terakhir')
            ->pluck('pendidikan_terakhir')) !!},
        datasets: [{
            data: {!! json_encode(App\Models\Kependudukan::select('pendidikan_terakhir')
                ->groupBy('pendidikan_terakhir')
                ->selectRaw('count(*) as total')
                ->pluck('total')) !!},
            backgroundColor: ['#1E40AF', '#EAB308', '#059669', '#DC2626', '#7C3AED', '#2563EB'],
            borderWidth: 0
        }]
    };

    // Data untuk Grafik Pekerjaan
    const pekerjaanData = {
        labels: {!! json_encode(App\Models\Kependudukan::select('pekerjaan')
            ->groupBy('pekerjaan')
            ->pluck('pekerjaan')) !!},
        datasets: [{
            data: {!! json_encode(App\Models\Kependudukan::select('pekerjaan')
                ->groupBy('pekerjaan')
                ->selectRaw('count(*) as total')
                ->pluck('total')) !!},
            backgroundColor: ['#1E40AF', '#EAB308', '#059669', '#DC2626', '#7C3AED', '#2563EB'],
            borderWidth: 0
        }]
    };

    // Data untuk Grafik Status Keluarga
    const statusKeluargaData = {
        labels: {!! json_encode(App\Models\Kependudukan::select('status_keluarga')
            ->groupBy('status_keluarga')
            ->pluck('status_keluarga')) !!},
        datasets: [{
            data: {!! json_encode(App\Models\Kependudukan::select('status_keluarga')
                ->groupBy('status_keluarga')
                ->selectRaw('count(*) as total')
                ->pluck('total')) !!},
            backgroundColor: ['#1E40AF', '#EAB308', '#059669', '#DC2626', '#7C3AED', '#2563EB'],
            borderWidth: 0
        }]
    };

    // Konfigurasi chart yang sama untuk ketiga grafik
    const chartConfig = {
        type: 'pie',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 12
                        },
                        padding: 10
                    }
                },
                tooltip: {
                    padding: 12,
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true,
                duration: 2000
            }
        }
    };

    // Inisialisasi ketiga chart
    document.addEventListener('DOMContentLoaded', function() {
        new Chart(document.getElementById('pendidikanChart').getContext('2d'), {
            ...chartConfig,
            data: pendidikanData
        });

        new Chart(document.getElementById('pekerjaanChart').getContext('2d'), {
            ...chartConfig,
            data: pekerjaanData
        });

        new Chart(document.getElementById('statusKeluargaChart').getContext('2d'), {
            ...chartConfig,
            data: statusKeluargaData
        });
    });
</script>


<!-- Struktur Desa -->
<div class="bg-white rounded-lg shadow-lg p-6 border border-gray-100">
    <div class="text-center mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Struktur Organisasi Desa</h2>
        <div class="h-1 w-24 bg-blue-500 mx-auto"></div>
    </div>

    <div class="flex flex-col items-center">
        @foreach(App\Models\Struktur::all() as $struktur)
            @if($struktur->jabatan == 'Kepala Desa')
                <!-- Kepala Desa -->
                <div class="bg-blue-900 text-white p-4 rounded-lg shadow-lg mb-8 w-64 text-center">
                    <img src="{{ asset('images/'.$struktur->image) }}" alt="Kepala Desa" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="font-bold text-base">{{ $struktur->jabatan }}</h3>
                    <p class="text-sm mt-1">{{ $struktur->nama }}</p>
                </div>
            @endif
        @endforeach
        
        <!-- Vertical Line -->
        <div class="h-12 w-0.5 bg-gray-300"></div>

        <!-- Second Level -->
        <div class="flex justify-center gap-8 mb-8">
            @foreach(App\Models\Struktur::all() as $struktur)
                @if($struktur->jabatan == 'Sekretaris Desa' || $struktur->jabatan == 'Bendahara Desa')
                    <div class="bg-blue-800 text-white p-4 rounded-lg shadow-lg w-48 text-center">
                        <img src="{{ asset('images/'.$struktur->image) }}" alt="{{ $struktur->jabatan }}" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="font-bold text-base">{{ $struktur->jabatan }}</h3>
                        <p class="text-sm mt-1">{{ $struktur->nama }}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Vertical Line -->
        <div class="h-12 w-0.5 bg-gray-300"></div>

        <!-- Third Level -->
        <div class="flex justify-center gap-8 flex-wrap">
            @foreach(App\Models\Struktur::all() as $struktur)
                @if(in_array($struktur->jabatan, ['Kaur Umum', 'Kaur Keuangan', 'Kasi Pemerintahan', 'Kasi Kesejahteraan']))
                    <div class="bg-blue-700 text-white p-4 rounded-lg shadow-lg w-40 text-center">
                        <img src="{{ asset('images/'.$struktur->image) }}" alt="{{ $struktur->jabatan }}" class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="font-bold text-base">{{ $struktur->jabatan }}</h3>
                        <p class="text-sm mt-1">{{ $struktur->nama }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>


<!-- Recent Activities -->
<div class="bg-white rounded-lg shadow-lg p-4 border border-gray-100">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h2>
        <div class="bg-blue-50 text-blue-600 text-xs font-medium px-2 py-1 rounded-full">
            Real-time Updates
        </div>
    </div>



    <div class="divide-y divide-gray-100">
        @foreach(App\Models\Kegiatan::latest()->take(3)->get() as $kegiatan)
        <div class="py-3 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-blue-500 text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $kegiatan->judul }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $kegiatan->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-blue-600">
                    <span class="px-2 py-1 bg-blue-50 rounded-md">Kegiatan</span>
                </div>
            </div>
        </div>
        @endforeach

        @foreach(App\Models\Berita::latest()->take(3)->get() as $berita)
        <div class="py-3 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-newspaper text-green-500 text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $berita->judul }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $berita->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-green-600">
                    <span class="px-2 py-1 bg-green-50 rounded-md">Berita</span>
                </div>
            </div>
        </div>
        @endforeach

        @foreach(App\Models\Produk::latest()->take(3)->get() as $produk)
        <div class="py-3 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-box text-yellow-500 text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $produk->nama }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $produk->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-yellow-600">
                    <span class="px-2 py-1 bg-yellow-50 rounded-md">Produk</span>
                </div>
            </div>
        </div>
        @endforeach

        @foreach(App\Models\DanaDesa::latest()->take(3)->get() as $dana)
        <div class="py-3 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-money-bill text-purple-500 text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $dana->sumber_anggaran }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $dana->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-purple-600">
                    <span class="px-2 py-1 bg-purple-50 rounded-md">Dana Desa</span>
                </div>
            </div>
        </div>
        @endforeach

        @foreach(App\Models\Kependudukan::latest()->take(3)->get() as $penduduk)
        <div class="py-3 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-pink-500 text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $penduduk->nama }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $penduduk->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-pink-600">
                    <span class="px-2 py-1 bg-pink-50 rounded-md">Kependudukan</span>
                </div>
            </div>
        </div>
        @endforeach

        @foreach(App\Models\Pengaduan::latest()->take(3)->get() as $pengaduan)
        <div class="py-3 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $pengaduan->judul }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $pengaduan->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-red-600">
                    <span class="px-2 py-1 bg-red-50 rounded-md">Pengaduan</span>
                </div>
            </div>
        </div>
        @endforeach

        @foreach(App\Models\Sambutan::latest()->take(3)->get() as $sambutan)
        <div class="py-3 transition duration-300 hover:bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-comment text-indigo-500 text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $sambutan->nama }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        {{ $sambutan->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-semibold text-indigo-600">
                    <span class="px-2 py-1 bg-indigo-50 rounded-md">Sambutan</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.font.size = window.innerWidth < 640 ? 8 : 10;
    
    // Kategori Chart
    const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
    new Chart(kategoriCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(\App\Models\DanaDesa::whereNull('deleted_at')
                ->where('tahun_anggaran', $selectedYear)
                ->pluck('sumber_anggaran')) !!},
            datasets: [{
                data: {!! json_encode(\App\Models\DanaDesa::whereNull('deleted_at')
                    ->where('tahun_anggaran', $selectedYear)
                    ->groupBy('sumber_anggaran')
                    ->selectRaw('sum(nominal) as total')
                    ->pluck('total')) !!},
                backgroundColor: ['#3B82F6', '#EC4899', '#10B981'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20
                    }
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
            labels: ['Belum Dimulai', 'Sedang Berjalan', 'Selesai'],
            datasets: [{
                data: [
                    {{ App\Models\Kegiatan::whereNull('deleted_at')
                        ->whereYear('tgl_mulai', $selectedYear)
                        ->where('progress', 0)
                        ->count() }},
                    {{ App\Models\Kegiatan::whereNull('deleted_at')
                        ->whereYear('tgl_mulai', $selectedYear)
                        ->whereBetween('progress', [1, 99])
                        ->count() }},
                    {{ App\Models\Kegiatan::whereNull('deleted_at')
                        ->whereYear('tgl_mulai', $selectedYear)
                        ->where('progress', 100)
                        ->count() }}
                ],
                backgroundColor: [
                    'rgba(239, 68, 68, 0.7)',   // red
                    'rgba(59, 130, 246, 0.7)',   // blue
                    'rgba(16, 185, 129, 0.7)'    // green
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20
                    }
                }
            }
        }
    });

    // Demografi Chart
    const demografiCtx = document.getElementById('demografiChart').getContext('2d');
    new Chart(demografiCtx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [
                    {{ App\Models\Kependudukan::where('jenis_kelamin', 'Laki-laki')->count() }},
                    {{ App\Models\Kependudukan::where('jenis_kelamin', 'Perempuan')->count() }}
                ],
                backgroundColor: ['#3B82F6', '#EC4899'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Usia Chart
    const usiaCtx = document.getElementById('usiaChart').getContext('2d');
    new Chart(usiaCtx, {
        type: 'bar',
        data: {
            labels: ['0-14 tahun', '15-24 tahun', '25-54 tahun', '55+ tahun'],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [
                    {{ App\Models\Kependudukan::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 15')->count() }},
                    {{ App\Models\Kependudukan::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 24')->count() }},
                    {{ App\Models\Kependudukan::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 25 AND 54')->count() }},
                    {{ App\Models\Kependudukan::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 55')->count() }}
                ],
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
</script>

@endsection