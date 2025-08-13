@extends('layouts.home')

@section('title', $agenda->judul . ' - Agenda Desa')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-purple-600 via-pink-600 to-red-500 py-20 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="container mx-auto px-4 relative">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8 scroll-animate fade-up">
                <ol class="flex items-center space-x-2 text-white/70 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <a href="{{ route('agenda.index') }}" class="hover:text-white transition-colors">Agenda</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-white">{{ Str::limit($agenda->judul, 50) }}</span>
                    </li>
                </ol>
            </nav>

            <!-- Content Header -->
            <div class="text-center text-white scroll-animate fade-up">
                <!-- Category Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    {{ $agenda->kategori_label ?? ucfirst($agenda->kategori) }}
                </div>

                <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                    {{ $agenda->judul }}
                </h1>

                <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto leading-relaxed">
                    {{ $agenda->deskripsi }}
                </p>

                <!-- Key Info -->
                <div class="grid md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                    <!-- Date -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="text-yellow-300 text-2xl font-bold mb-2">
                            {{ $agenda->tanggal_mulai->format('d') }}
                        </div>
                        <div class="text-sm opacity-80">
                            {{ $agenda->tanggal_mulai->format('M Y') }}
                        </div>
                        @if($agenda->waktu_mulai)
                        <div class="text-xs opacity-70 mt-1">
                            {{ date('H:i', strtotime($agenda->waktu_mulai)) }}
                            @if($agenda->waktu_selesai)
                            - {{ date('H:i', strtotime($agenda->waktu_selesai)) }}
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- Location -->
                    @if($agenda->tempat)
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="text-yellow-300 text-lg font-bold mb-2">
                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            Lokasi
                        </div>
                        <div class="text-sm opacity-80">
                            {{ $agenda->tempat }}
                        </div>
                    </div>
                    @endif

                    <!-- Organizer -->
                    @if($agenda->penyelenggara)
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="text-yellow-300 text-lg font-bold mb-2">
                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Penyelenggara
                        </div>
                        <div class="text-sm opacity-80">
                            {{ $agenda->penyelenggara }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Featured Image -->
                @if($agenda->featured_image_url)
                <div class="scroll-animate fade-up">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ $agenda->featured_image_url }}" 
                             alt="{{ $agenda->judul }}" 
                             class="w-full h-64 lg:h-96 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                </div>
                @endif

                <!-- Main Description -->
                <div class="bg-white rounded-2xl p-8 shadow-lg scroll-animate fade-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Tentang Kegiatan
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        <p class="text-lg mb-6">{{ $agenda->deskripsi }}</p>
                        @if($agenda->detail)
                        <div class="mt-6">
                            {!! nl2br(e($agenda->detail)) !!}
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Requirements -->
                @if($agenda->persyaratan)
                <div class="bg-white rounded-2xl p-8 shadow-lg scroll-animate fade-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Persyaratan
                    </h2>
                    <div class="text-gray-600 leading-relaxed">
                        {!! nl2br(e($agenda->persyaratan)) !!}
                    </div>
                </div>
                @endif

                <!-- Facilities -->
                @if($agenda->fasilitas)
                <div class="bg-white rounded-2xl p-8 shadow-lg scroll-animate fade-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        Fasilitas yang Disediakan
                    </h2>
                    <div class="text-gray-600 leading-relaxed">
                        {!! nl2br(e($agenda->fasilitas)) !!}
                    </div>
                </div>
                @endif

                <!-- Additional Info -->
                @if($agenda->catatan)
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 rounded-2xl p-8 shadow-lg scroll-animate fade-up">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Catatan Penting
                    </h2>
                    <div class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($agenda->catatan)) !!}
                    </div>
                </div>
                @endif

                <!-- Share & Actions -->
                <div class="bg-white rounded-2xl p-8 shadow-lg scroll-animate fade-up">
                    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-2">Bagikan Agenda Ini</h3>
                            <div class="flex space-x-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank"
                                   class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($agenda->judul) }}&url={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank"
                                   class="w-10 h-10 bg-sky-500 text-white rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($agenda->judul . ' - ' . request()->fullUrl()) }}" 
                                   target="_blank"
                                   class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <a href="{{ route('agenda.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Agenda
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Quick Info Card -->
                <div class="bg-white rounded-2xl p-8 shadow-lg scroll-animate fade-up">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-6 h-6 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-2">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Informasi Kegiatan
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- Date Info -->
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Tanggal</p>
                                <p class="text-gray-600">{{ $agenda->tanggal_mulai->format('d F Y') }}</p>
                                @if($agenda->tanggal_selesai && $agenda->tanggal_selesai != $agenda->tanggal_mulai)
                                <p class="text-gray-500 text-sm">s/d {{ $agenda->tanggal_selesai->format('d F Y') }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Time Info -->
                        @if($agenda->waktu_mulai)
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Waktu</p>
                                <p class="text-gray-600">
                                    {{ date('H:i', strtotime($agenda->waktu_mulai)) }}
                                    @if($agenda->waktu_selesai)
                                    - {{ date('H:i', strtotime($agenda->waktu_selesai)) }}
                                    @endif
                                    WIB
                                </p>
                            </div>
                        </div>
                        @endif

                        <!-- Location Info -->
                        @if($agenda->tempat)
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Tempat</p>
                                <p class="text-gray-600">{{ $agenda->tempat }}</p>
                                @if($agenda->alamat_lengkap)
                                <p class="text-gray-500 text-sm">{{ $agenda->alamat_lengkap }}</p>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Contact Person -->
                        @if($agenda->contact_person)
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Kontak Person</p>
                                <p class="text-gray-600">{{ $agenda->contact_person }}</p>
                                @if($agenda->contact_phone)
                                <a href="tel:{{ $agenda->contact_phone }}" class="text-purple-600 hover:text-purple-700 text-sm block">
                                    {{ $agenda->contact_phone }}
                                </a>
                                @endif
                                @if($agenda->contact_email)
                                <a href="mailto:{{ $agenda->contact_email }}" class="text-purple-600 hover:text-purple-700 text-sm block">
                                    {{ $agenda->contact_email }}
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Navigation -->
                <div class="bg-white rounded-2xl p-6 shadow-lg scroll-animate fade-up">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Navigasi</h3>
                    <div class="space-y-3">
                        @if($previousAgenda)
                        @php
                            $prevUrl = '#';
                            try {
                                if ($previousAgenda && $previousAgenda->slug) {
                                    $prevUrl = route('agenda.show', ['slug' => $previousAgenda->slug]);
                                }
                            } catch (\Exception $e) {
                                $prevUrl = url('/agenda/' . ($previousAgenda->slug ?? 'error'));
                            }
                        @endphp
                        <a href="{{ $prevUrl }}" 
                           class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all group">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500 group-hover:text-purple-600">Sebelumnya</p>
                                <p class="text-sm font-medium text-gray-900 group-hover:text-purple-900 line-clamp-1">{{ $previousAgenda->judul }}</p>
                            </div>
                        </a>
                        @endif
                        
                        @if($nextAgenda)
                        @php
                            $nextUrl = '#';
                            try {
                                if ($nextAgenda && $nextAgenda->slug) {
                                    $nextUrl = route('agenda.show', ['slug' => $nextAgenda->slug]);
                                }
                            } catch (\Exception $e) {
                                $nextUrl = url('/agenda/' . ($nextAgenda->slug ?? 'error'));
                            }
                        @endphp
                        <a href="{{ $nextUrl }}" 
                           class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all group">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 group-hover:text-purple-600">Selanjutnya</p>
                                <p class="text-sm font-medium text-gray-900 group-hover:text-purple-900 line-clamp-1">{{ $nextAgenda->judul }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-purple-600 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Agenda -->
@if($relatedAgenda && $relatedAgenda->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 scroll-animate fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Agenda <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Serupa</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Agenda lain yang mungkin menarik untuk Anda
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedAgenda as $related)
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group scroll-animate fade-up">
                <!-- Image -->
                <div class="relative h-48 overflow-hidden">
                    @if($related->featured_image_url)
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" 
                         style="background-image: url('{{ $related->featured_image_url }}');"></div>
                    @else
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-500"></div>
                    @endif
                    
                    <!-- Date Badge -->
                    <div class="absolute bottom-4 left-4">
                        <div class="bg-white/95 backdrop-blur-sm rounded-lg p-2 text-center shadow-lg">
                            <div class="text-lg font-bold text-gray-900">{{ $related->tanggal_mulai->format('d') }}</div>
                            <div class="text-xs font-semibold text-gray-600 uppercase">{{ $related->tanggal_mulai->format('M') }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-6">
                    <h3 class="font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                        {{ $related->judul }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $related->deskripsi }}
                    </p>
                    
                    @php
                        $relatedUrl = '#';
                        try {
                            if ($related && $related->slug) {
                                $relatedUrl = route('agenda.show', ['slug' => $related->slug]);
                            }
                        } catch (\Exception $e) {
                            $relatedUrl = url('/agenda/' . ($related->slug ?? 'error'));
                        }
                    @endphp
                    
                    <a href="{{ $relatedUrl }}" 
                       class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold text-sm transition-colors">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/agenda.js') }}"></script>
@endpush