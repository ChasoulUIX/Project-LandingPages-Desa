@extends('layouts.app')

@section('content')
    <!-- Sejarah Desa Section -->
    <div class="bg-white py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Sejarah Desa</h2>
                <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg">Mengenal lebih dekat sejarah dan perkembangan Desa Sumber Secang</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-blue-900">Asal Usul Desa Sumber Secang</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Desa Sumber Secang memiliki sejarah yang panjang dan kaya akan nilai-nilai budaya. Nama "Sumber Secang" berasal dari kata "Sumber" yang berarti mata air, dan "Secang" yang merupakan nama pohon yang banyak tumbuh di daerah ini pada masa lalu.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Pada awal abad ke-19, daerah ini mulai dihuni oleh sekelompok masyarakat yang memanfaatkan kesuburan tanah dan melimpahnya sumber air untuk bercocok tanam. Seiring berjalannya waktu, daerah ini berkembang menjadi pemukiman yang makmur dengan pertanian sebagai tulang punggung perekonomian.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Saat ini, Desa Sumber Secang telah berkembang menjadi desa yang modern namun tetap mempertahankan kearifan lokal dan nilai-nilai budaya yang diwariskan oleh para pendahulu.
                    </p>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/Logo_kab_probolinggo.png') }}" alt="Sejarah Desa" class="rounded-2xl shadow-2xl w-1/3 md:w-1/2 h-1/3 md:h-1/2 mx-auto object-contain">
                    <div class="absolute -bottom-6 -right-6 bg-yellow-500 text-blue-900 px-8 py-4 rounded-xl shadow-lg">
                        <span class="font-bold">Est. 1945</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-20 sm:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Visi & Misi</h2>
                    <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                    <p class="text-gray-600 text-base sm:text-lg">Komitmen kami dalam membangun desa yang maju, mandiri dan sejahtera</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Visi Card -->
                    <div class="bg-gray-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                            <i class="fas fa-eye text-yellow-500 mr-3"></i>
                            Visi
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            "Terwujudnya Desa yang Maju, Mandiri, dan Sejahtera Berbasis Pertanian dan Teknologi Digital dengan Tetap Menjaga Nilai-nilai Budaya dan Kearifan Lokal"
                        </p>
                    </div>

                    <!-- Misi Card -->
                    <div class="bg-gray-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                            <i class="fas fa-bullseye text-yellow-500 mr-3"></i>
                            Misi
                        </h3>
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Meningkatkan kualitas pelayanan publik melalui digitalisasi administrasi desa</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Mengembangkan sektor pertanian dengan teknologi modern dan ramah lingkungan</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Memberdayakan UMKM dan potensi ekonomi lokal untuk kesejahteraan masyarakat</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Melestarikan dan mengembangkan nilai-nilai budaya serta kearifan lokal</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                <span>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    <!-- Profile Desa Section -->
    <div class="bg-white py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Kontak Kami</h2>
                <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg">Hubungi kami untuk informasi lebih lanjut tentang Desa Sumber Secang</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-12">
                <!-- Email Card -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-envelope text-blue-900 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Email</h3>
                    <p class="text-gray-600 text-center">desa.sumbersecang@gmail.com</p>
                </div>

                <!-- Telepon Card -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-phone text-blue-900 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Telepon</h3>
                    <p class="text-gray-600 text-center">(0335) 123456</p>
                </div>

                <!-- Alamat Card -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-map-marker-alt text-blue-900 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 text-center mb-2">Alamat</h3>
                    <p class="text-gray-600 text-center">Jl. Raya Sumber Secang No. 123, Kec. Sumber, Kab. Probolinggo</p>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="w-full rounded-xl overflow-hidden shadow-lg">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1527553655745!2d113.2159863!3d-7.7516499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7b75a9824fab1%3A0x4027a76e35319c0!2sSumber%20Secang%2C%20Sumber%2C%20Probolinggo%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1629789012345!5m2!1sen!2sid"
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"
                    class="w-full">
                </iframe>
            </div>
        </div>
    </div>

    <!-- Visi Misi Section -->
    <div class="bg-white py-20 sm:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-blue-900 mb-6">Visi & Misi</h2>
                <div class="h-1.5 w-24 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-600 text-base sm:text-lg">Komitmen kami dalam membangun desa yang maju, mandiri dan sejahtera</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Visi Card -->
                <div class="bg-gray-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                        <i class="fas fa-eye text-yellow-500 mr-3"></i>
                        Visi
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        "Terwujudnya Desa yang Maju, Mandiri, dan Sejahtera Berbasis Pertanian dan Teknologi Digital dengan Tetap Menjaga Nilai-nilai Budaya dan Kearifan Lokal"
                    </p>
                </div>

                <!-- Misi Card -->
                <div class="bg-gray-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-2xl font-bold text-blue-900 mb-6 flex items-center">
                        <i class="fas fa-bullseye text-yellow-500 mr-3"></i>
                        Misi
                    </h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>Meningkatkan kualitas pelayanan publik melalui digitalisasi administrasi desa</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>Mengembangkan sektor pertanian dengan teknologi modern dan ramah lingkungan</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>Memberdayakan UMKM dan potensi ekonomi lokal untuk kesejahteraan masyarakat</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>Melestarikan dan mengembangkan nilai-nilai budaya serta kearifan lokal</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
