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
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2 sm:mb-4">Pengaduan Masyarakat</h1>
                        <p class="text-sm sm:text-base text-blue-100">Sampaikan keluhan dan aspirasi Anda untuk Desa yang lebih baik</p>
                    </div>
                    <div class="hidden sm:block w-24"></div>
                </div>

                <!-- Pengaduan Form -->
                <div class="max-w-3xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <form class="space-y-6">
                            <div>
                                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label for="nik" class="block text-gray-700 font-medium mb-2">NIK</label>
                                <input type="text" id="nik" name="nik" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label for="phone" class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label for="category" class="block text-gray-700 font-medium mb-2">Kategori Pengaduan</label>
                                <select id="category" name="category" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="infrastruktur">Infrastruktur</option>
                                    <option value="pelayanan">Pelayanan Publik</option>
                                    <option value="kesehatan">Kesehatan</option>
                                    <option value="pendidikan">Pendidikan</option>
                                    <option value="keamanan">Keamanan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label for="description" class="block text-gray-700 font-medium mb-2">Isi Pengaduan</label>
                                <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required></textarea>
                            </div>

                            <div>
                                <label for="attachment" class="block text-gray-700 font-medium mb-2">Lampiran (Opsional)</label>
                                <input type="file" id="attachment" name="attachment" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <p class="text-sm text-gray-500 mt-1">Format yang didukung: JPG, PNG, PDF (Max. 2MB)</p>
                            </div>

                            <button type="submit" class="w-full bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition duration-300 font-medium">
                                Kirim Pengaduan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
