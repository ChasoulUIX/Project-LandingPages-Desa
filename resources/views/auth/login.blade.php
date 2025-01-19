@extends('user.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 flex items-center justify-center py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full flex flex-col lg:flex-row shadow-2xl rounded-2xl overflow-hidden">
        <!-- Left Panel - Decorative -->
        <div class="hidden lg:block lg:w-1/2 bg-gradient-to-br from-blue-800 to-blue-900 p-8 sm:p-12 relative">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="relative z-10">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4 sm:mb-6">Selamat Datang Kembali</h2>
                <p class="text-blue-100 mb-6 sm:mb-8">Akses layanan digital desa dengan mudah dan cepat untuk memenuhi kebutuhan administratif Anda.</p>
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-center text-white">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        <span>Layanan administrasi digital</span>
                    </div>
                    <div class="flex items-center text-white">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        <span>Informasi desa terupdate</span>
                    </div>
                    <div class="flex items-center text-white">
                        <i class="fas fa-check-circle text-green-400 mr-3"></i>
                        <span>Pengajuan surat online</span>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                <div class="flex items-center justify-center space-x-4">
                    <span class="text-white text-opacity-60 text-sm sm:text-base">Terhubung dengan</span>
                    <i class="fab fa-facebook text-white hover:text-blue-300 cursor-pointer transition-colors text-lg sm:text-xl"></i>
                    <i class="fab fa-twitter text-white hover:text-blue-300 cursor-pointer transition-colors text-lg sm:text-xl"></i>
                    <i class="fab fa-instagram text-white hover:text-blue-300 cursor-pointer transition-colors text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="w-full lg:w-1/2 bg-white p-6 sm:p-8 lg:p-12">
            <div class="text-center mb-6 sm:mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-blue-900 mb-2">Login</h2>
                <p class="text-gray-600 text-sm sm:text-base">Masuk ke akun Anda untuk mengakses layanan</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6">
                @csrf

                <div class="space-y-3 sm:space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" required 
                                class="pl-10 appearance-none block w-full px-3 py-2.5 sm:py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}" placeholder="Masukkan email Anda">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" required 
                                class="pl-10 appearance-none block w-full px-3 py-2.5 sm:py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base @error('password') border-red-500 @enderror"
                                placeholder="Masukkan password Anda">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 sm:mt-6 space-y-3 sm:space-y-0">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition-colors">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <div class="mt-4 sm:mt-6">
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-2.5 sm:py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm sm:text-base font-medium 
                        text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 
                        focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-blue-300 group-hover:text-blue-200"></i>
                        </span>
                        Login
                    </button>
                </div>

                <!-- <div class="mt-4 sm:mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Atau login dengan</span>
                        </div>
                    </div>

                    <div class="mt-4 sm:mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <button type="button" class="flex justify-center items-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm 
                            text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            Google
                        </button>
                        <button type="button" class="flex justify-center items-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm 
                            text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            Facebook
                        </button>
                    </div>
                </div> -->

                <!-- <div class="text-center mt-6 sm:mt-8">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ url('/register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                            Daftar disini
                        </a>
                    </p>
                </div> -->
            </form>
        </div>
    </div>
</div>
@endsection
