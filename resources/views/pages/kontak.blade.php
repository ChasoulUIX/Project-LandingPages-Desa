@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="pt-20">
        <div class="bg-gradient-to-b from-blue-900 to-blue-800 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">Hubungi Kami</h1>
                    <p class="text-blue-100">Silakan hubungi kami untuk informasi lebih lanjut</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Contact Information -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-semibold text-blue-900 mb-6">Informasi Kontak</h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="text-yellow-500 mt-1">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Alamat</h3>
                                    <p class="text-gray-600">Desa Secang, Kecamatan Sumberasih<br>Kabupaten Probolinggo, Jawa Timur</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="text-yellow-500 mt-1">
                                    <i class="fas fa-phone text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Telepon</h3>
                                    <p class="text-gray-600">(0335) 123456</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="text-yellow-500 mt-1">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Email</h3>
                                    <p class="text-gray-600">desa.secang@probolinggokab.go.id</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="text-yellow-500 mt-1">
                                    <i class="fas fa-clock text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Jam Operasional</h3>
                                    <p class="text-gray-600">Senin - Jumat: 08:00 - 16:00<br>Sabtu: 08:00 - 12:00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-semibold text-blue-900 mb-6">Kirim Pesan</h2>
                        
                        <form class="space-y-6">
                            <div>
                                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                                <input type="text" id="subject" name="subject" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                                <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-blue-900 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition duration-300 font-medium">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Map -->
                <div class="mt-12">
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15817.910271006167!2d113.18016547325416!3d-7.753361621820441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7b3e87caa1be9%3A0x9c403e0eba0bb80!2sSecang%2C%20Sumberasih%2C%20Probolinggo%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1707150547736!5m2!1sen!2sid"
                                class="w-full h-96 rounded-lg" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
