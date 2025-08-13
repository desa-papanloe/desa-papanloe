@extends('layouts.home')

@section('title', 'Agenda Desa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/agenda.css') }}?v={{ time() }}">
<style>
/* Fix untuk Featured Agenda di List View */
.featured-agenda-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

@media (max-width: 768px) {
    .featured-agenda-grid {
        grid-template-columns: 1fr;
    }
}

/* Smooth transitions */
.agenda-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Loading overlay for section */
.section-loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 20;
}

/* Prevent animation flicker */
.scroll-animate.animate-in {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

/* View toggle highlight */
.view-toggle-active {
    background: rgb(147 51 234 / 0.1) !important;
    color: rgb(147 51 234) !important;
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-purple-600 via-pink-600 to-red-500 py-32 overflow-hidden">
    <div class="container mx-auto px-4 relative">
        <div class="text-center text-white scroll-animate fade-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Agenda <span class="text-yellow-300">Kegiatan</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed opacity-90">
                Ikuti berbagai kegiatan dan acara yang diselenggarakan di Desa Papanloe
            </p>
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto mt-12">
                <div class="text-center scroll-animate fade-up">
                    <div class="text-3xl font-bold text-yellow-300">{{ $stats['total'] ?? 0 }}</div>
                    <div class="text-sm opacity-80">Total Agenda</div>
                </div>
                <div class="text-center scroll-animate fade-up">
                    <div class="text-3xl font-bold text-yellow-300">{{ $stats['upcoming'] ?? 0 }}</div>
                    <div class="text-sm opacity-80">Akan Datang</div>
                </div>
                <div class="text-center scroll-animate fade-up">
                    <div class="text-3xl font-bold text-yellow-300">{{ $stats['this_month'] ?? 0 }}</div>
                    <div class="text-sm opacity-80">Bulan Ini</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Agenda Section (NOT affected by view toggle) -->
@if(isset($featuredAgenda) && $featuredAgenda->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 scroll-animate fade-up">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                Agenda <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Unggulan</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Jangan lewatkan kegiatan penting dan menarik di Desa Papanloe
            </p>
        </div>

        <!-- Featured Agenda Grid - Always responsive, not affected by view toggle -->
        <div class="featured-agenda-grid">
            @foreach($featuredAgenda as $agendaItem)
            <div class="featured-card bg-white border-2 border-gray-100 rounded-2xl overflow-hidden hover:border-purple-200 hover:shadow-2xl transition-all duration-300 group scroll-animate fade-up">
                <!-- Image Header -->
                <div class="relative h-48 overflow-hidden">
                    @if($agendaItem->featured_image_url)
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" 
                         style="background-image: url('{{ $agendaItem->featured_image_url }}');"></div>
                    @else
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-500"></div>
                    @endif
                    
                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-purple-600 text-xs font-bold rounded-full">
                            {{ $agendaItem->kategori_label ?? ucfirst($agendaItem->kategori) }}
                        </span>
                    </div>
                    
                    <!-- Priority Badge -->
                    @if($agendaItem->prioritas === 'urgent' || $agendaItem->prioritas === 'tinggi')
                    <div class="absolute top-4 right-4">
                        <span class="px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-full">
                            {{ $agendaItem->prioritas === 'urgent' ? 'URGENT' : 'PENTING' }}
                        </span>
                    </div>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="p-6">
                    <!-- Date Badge -->
                    <div class="flex items-center mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg">
                            <span class="text-xs font-semibold">{{ $agendaItem->tanggal_mulai->format('M') }}</span>
                            <span class="text-lg font-bold">{{ $agendaItem->tanggal_mulai->format('d') }}</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-purple-600 font-semibold">{{ $agendaItem->tanggal_mulai->format('d M Y') }}</p>
                            @if($agendaItem->waktu_mulai)
                            <p class="text-xs text-gray-500">
                                {{ date('H:i', strtotime($agendaItem->waktu_mulai)) }} 
                                @if($agendaItem->waktu_selesai)
                                - {{ date('H:i', strtotime($agendaItem->waktu_selesai)) }}
                                @endif
                            </p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                        {{ $agendaItem->judul }}
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $agendaItem->deskripsi }}
                    </p>
                    
                    <!-- Location -->
                    @if($agendaItem->tempat)
                    <div class="flex items-center text-gray-500 text-sm mb-4">
                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        {{ $agendaItem->tempat }}
                    </div>
                    @endif
                    
                    <!-- CTA Button -->
                    <a href="{{ route('agenda.show', $agendaItem->slug) }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span>Lihat Detail</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

<!-- Filters & Search Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Search Bar -->
        <div class="max-w-4xl mx-auto mb-8 scroll-animate fade-up">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <!-- AJAX Form - prevent submit -->
                <div class="grid md:grid-cols-3 gap-4" id="ajaxSearchForm">
                    <!-- Search Input -->
                    <div class="md:col-span-2 relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari agenda berdasarkan judul, deskripsi, atau tempat..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                               autocomplete="off">
                    </div>
                    
                    <!-- Category Filter -->
                    <div>
                        <select name="kategori" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Semua Kategori</option>
                            @if(isset($categories))
                                @foreach($categories as $key => $label)
                                <option value="{{ $key }}" {{ request('kategori') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- View Toggle & Sort -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 scroll-animate fade-up">
            <!-- View Toggle -->
            <div class="flex items-center space-x-2 mb-4 sm:mb-0">
                <span class="text-gray-600 text-sm font-medium">Tampilan:</span>
                <div class="bg-white rounded-lg p-1 shadow-sm border border-gray-200">
                    <button type="button" id="gridBtn" class="px-3 py-2 rounded-md text-purple-600 bg-purple-50 transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 11h8V3H3v8zm2-6h4v4H5V5zM13 3v8h8V3h-8zm6 6h-4V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zM18 13h-2v2h2v-2zM18 17h-2v2h2v-2zM16 15h2v2h-2v-2zM18 19h2v2h-2v-2z"/>
                        </svg>
                    </button>
                    <button type="button" id="listBtn" class="px-3 py-2 rounded-md text-gray-400 hover:text-purple-600 transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Sort Options -->
            <div class="flex items-center space-x-2">
                <span class="text-gray-600 text-sm font-medium">Urutkan:</span>
                <!-- AJAX Sort - prevent form submit -->
                <div id="ajaxSortForm">
                    <select name="sort" 
                            class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                        <option value="tanggal_mulai" {{ request('sort') == 'tanggal_mulai' ? 'selected' : '' }}>Tanggal Terdekat</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru Dibuat</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Populer</option>
                        <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Prioritas</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Agenda List Section (This section will be updated via AJAX) -->
<section class="py-20 bg-white" id="agendaSection">
    @include('pages.agenda-section', ['agenda' => $agenda, 'categories' => $categories ?? []])
</section>

<!-- Upcoming Agenda Section (NOT affected by view toggle) -->
@if(isset($upcomingAgenda) && $upcomingAgenda->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 scroll-animate fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Agenda <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Terdekat</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Jangan sampai terlewat kegiatan menarik dalam waktu dekat
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            @foreach($upcomingAgenda as $upcoming)
            <div class="upcoming-card bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 group border border-gray-100 hover:border-purple-200 scroll-animate fade-up">
                <!-- Date Circle -->
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex flex-col items-center justify-center text-white mb-4 shadow-lg group-hover:scale-105 transition-transform">
                    <span class="text-xs font-semibold">{{ $upcoming->tanggal_mulai->format('M') }}</span>
                    <span class="text-lg font-bold">{{ $upcoming->tanggal_mulai->format('d') }}</span>
                </div>
                
                <!-- Content -->
                <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors">
                    {{ $upcoming->judul }}
                </h3>
                
                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                    {{ $upcoming->deskripsi }}
                </p>
                
                <!-- Details -->
                <div class="space-y-1 mb-4">
                    @if($upcoming->waktu_mulai)
                    <p class="text-xs text-gray-500 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ date('H:i', strtotime($upcoming->waktu_mulai)) }}
                    </p>
                    @endif
                    
                    @if($upcoming->tempat)
                    <p class="text-xs text-gray-500 flex items-center line-clamp-1">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        {{ $upcoming->tempat }}
                    </p>
                    @endif
                </div>
                
                <!-- Action -->
                <a href="{{ route('agenda.show', $upcoming->slug) }}" 
                   class="text-purple-600 hover:text-purple-700 font-semibold text-sm transition-colors flex items-center">
                    Lihat Detail
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script src="{{ asset('js/agenda.js') }}?v={{ time() }}"></script>
@endpush