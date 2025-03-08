@extends('cms.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-5 mb-8">
            <div class="h-16 w-16 bg-blue-200 rounded-full flex flex-shrink-0 justify-center items-center overflow-hidden">
                @if(Auth::guard('struktur')->check())
                    @if(Auth::guard('struktur')->user()->image)
                        <img src="{{ asset('images/' . Auth::guard('struktur')->user()->image) }}" alt="Profile" class="h-full w-full object-cover">
                    @else
                        <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endif
                @else
                    @if(auth()->user()->photo_profile)
                        <img src="{{ asset('images/' . auth()->user()->photo_profile) }}" alt="Profile" class="h-full w-full object-cover">
                    @else
                        <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endif
                @endif
            </div>
            <div class="block pl-2 font-semibold text-xl text-gray-700">
                <h2 class="leading-relaxed text-3xl font-bold text-blue-600">
                    {{ __('Edit Profile') }}
                </h2>
                <p class="text-sm text-blue-600 mt-1">
                    {{ __('Update your personal information and account settings') }}
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ Auth::guard('struktur')->check() ? route('struktur.profile.update') : route('profile.update') }}" 
              class="bg-white shadow-sm rounded-lg divide-y divide-gray-200" 
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-6 rounded-lg space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Profile Information') }}</h3>

                            @if(Auth::guard('struktur')->check())
                                <div class="form-group">
                                    <label for="image">Profile Photo</label>
                                    <input type="file" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image"
                                           accept="image/*">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Nama') }}
                                    </label>
                                    <input type="text" 
                                           id="nama" 
                                           name="nama" 
                                           value="{{ old('nama', Auth::guard('struktur')->user()->nama) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('NIK') }}
                                    </label>
                                    <input type="text" 
                                           id="nik" 
                                           name="nik" 
                                           value="{{ old('nik', Auth::guard('struktur')->user()->nik) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Jabatan') }}
                                    </label>
                                    <input type="text" 
                                           id="jabatan" 
                                           name="jabatan" 
                                           value="{{ old('jabatan', Auth::guard('struktur')->user()->jabatan) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Nomor WhatsApp') }}
                                    </label>
                                    <input type="text" 
                                           id="no_wa" 
                                           name="no_wa" 
                                           value="{{ old('no_wa', Auth::guard('struktur')->user()->no_wa) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="akses" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Akses') }}
                                    </label>
                                    <input type="text" 
                                           id="akses" 
                                           name="akses" 
                                           value="{{ old('akses', Auth::guard('struktur')->user()->akses) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="periode_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Periode Mulai') }}
                                    </label>
                                    <input type="date" 
                                           id="periode_mulai" 
                                           name="periode_mulai" 
                                           value="{{ old('periode_mulai', Auth::guard('struktur')->user()->periode_mulai) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="periode_akhir" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Periode Akhir') }}
                                    </label>
                                    <input type="date" 
                                           id="periode_akhir" 
                                           name="periode_akhir" 
                                           value="{{ old('periode_akhir', Auth::guard('struktur')->user()->periode_akhir) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Status') }}
                                    </label>
                                    <select id="status" 
                                            name="status" 
                                            required
                                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="1" {{ Auth::guard('struktur')->user()->status == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ Auth::guard('struktur')->user()->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            @else
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Name') }}
                                    </label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', auth()->user()->name) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('Email') }}
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', auth()->user()->email) }}" 
                                           required
                                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <div class="form-group">
                                    <label for="photo_profile" class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                                    <input type="file" 
                                           class="form-control @error('photo_profile') is-invalid @enderror" 
                                           id="photo_profile" 
                                           name="photo_profile"
                                           accept="image/*">
                                    @error('photo_profile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gray-50 p-6 rounded-lg space-y-6">
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Security Settings') }}</h3>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('New Password') }}
                                </label>
                                <input type="password" id="password" name="password"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <p class="mt-2 text-sm text-gray-500">
                                    {{ __('Leave blank if you don\'t want to change password') }}
                                </p>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Confirm New Password') }}
                                </label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 rounded-b-lg">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg 
                    shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Update Profile') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
