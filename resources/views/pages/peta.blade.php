@extends('layouts.home')

@section('title', 'Peta Administrasi Desa Papanloe')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-blue-50">    
    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-32 text-center">
        <div class="hero-content fade-up">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-white text-emerald-700 rounded-full text-sm font-semibold mb-6 border border-emerald-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                </svg>
                Peta Administrasi Wilayah
            </div>
            
            <!-- Main Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Peta Digital
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-blue-600">
                    Desa Papanloe
                </span>
            </h1>
            
            <!-- Description -->
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Peta administrasi dan wilayah Desa Papanloe, Kecamatan Pa'jukukang, Kabupaten Bantaeng dengan pembagian dusun dan potensi geografis.
            </p>
            
            <!-- Quick Info -->
            <div class="flex items-center justify-center space-x-8 text-sm text-gray-600">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>7 Dusun</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span>Skala 1:36.165</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span>WGS 1984</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Peta Administrasi Wilayah
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Peta lengkap dengan pembagian dusun, fasilitas umum, dan potensi geografis Desa Papanloe
            </p>
        </div>
        
        <!-- Map Container -->
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                <!-- Map Image -->
                <div id="map-container" class="relative overflow-hidden">
                    <img id="map-image" src="{{ asset('img/Peta.jpg') }}" 
                         alt="Peta Administrasi Desa Papanloe" 
                         class="w-full h-auto object-contain transition-transform duration-300"
                         style="max-height: 80vh; transform-origin: center center;"
                         onerror="this.parentElement.innerHTML='<div class=\\'flex items-center justify-center h-96 bg-gray-100\\' ><div class=\\'text-center\\' ><svg class=\\'w-16 h-16 mx-auto text-gray-400 mb-4\\' fill=\\'none\\' stroke=\\'currentColor\\' viewBox=\\'0 0 24 24\\'><path stroke-linecap=\\'round\\' stroke-linejoin=\\'round\\' stroke-width=\\'2\\' d=\\'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7\\'></path></svg><p class=\\'text-gray-600\\'>Peta sedang dimuat...</p></div></div>'">
                    
                    <!-- Zoom Controls -->
                    <div class="absolute top-4 right-4 flex flex-col bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden z-10">
                        <button id="zoom-in" class="p-3 hover:bg-gray-50 transition-colors border-b border-gray-200 group" title="Perbesar">
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                        <button id="zoom-out" class="p-3 hover:bg-gray-50 transition-colors border-b border-gray-200 group" title="Perkecil">
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path>
                            </svg>
                        </button>
                        <button id="zoom-reset" class="p-3 hover:bg-gray-50 transition-colors border-b border-gray-200 group" title="Reset Zoom">
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                        <button id="fullscreen" class="p-3 hover:bg-gray-50 transition-colors group" title="Layar Penuh">
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Zoom Level Indicator -->
                    <div id="zoom-indicator" class="absolute bottom-4 right-4 bg-black bg-opacity-70 text-white px-3 py-1 rounded-lg text-sm">
                        Zoom: <span id="zoom-level">100%</span>
                    </div>
                </div>
                
                <!-- Map Legend/Info -->
                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Koordinat Info -->
                        <div class="text-center">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Sistem Koordinat</h4>
                            <p class="text-sm text-gray-600">GCS WGS 1984</p>
                            <p class="text-xs text-gray-500">Datum: WGS 1984</p>
                        </div>
                        
                        <!-- Scale Info -->
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Skala Peta</h4>
                            <p class="text-sm text-gray-600">1:36.165</p>
                            <p class="text-xs text-gray-500">0 - 2 Kilometers</p>
                        </div>
                        
                        <!-- Source Info -->
                        <div class="text-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Sumber Data</h4>
                            <p class="text-sm text-gray-600">KKNT Gel. 114</p>
                            <p class="text-xs text-gray-500">Universitas Hasanuddin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dusun Information Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Pembagian Wilayah Dusun
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Desa Papanloe terdiri dari 7 dusun dengan karakteristik dan potensi yang berbeda-beda
            </p>
        </div>
        
        <!-- Dusun Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Dusun Kayuloe -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="h-2 bg-gradient-to-r from-orange-400 to-red-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Dusun Kayuloe</h3>
                    <div class="w-8 h-1 bg-orange-500 rounded-full mb-3"></div>
                    <p class="text-sm text-gray-600 leading-relaxed">Wilayah bagian timur dengan akses ke jalan utama</p>
                </div>
            </div>

            <!-- Dusun Balla Tiggia -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="h-2 bg-gradient-to-r from-green-400 to-emerald-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m0 0h1m0 0h3a1 1 0 001-1V10M9 21v-6a1 1 0 011-1h2a1 1 0 011 1v6"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Dusun Balla Tiggia</h3>
                    <div class="w-8 h-1 bg-green-500 rounded-full mb-3"></div>
                    <p class="text-sm text-gray-600 leading-relaxed">Kawasan permukiman dengan fasilitas umum</p>
                </div>
            </div>

            <!-- Dusun Mawang -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="h-2 bg-gradient-to-r from-yellow-400 to-orange-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Dusun Mawang</h3>
                    <div class="w-8 h-1 bg-yellow-500 rounded-full mb-3"></div>
                    <p class="text-sm text-gray-600 leading-relaxed">Area pertanian dan perkebunan</p>
                </div>
            </div>

            <!-- Dusun Bungungrua -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="h-2 bg-gradient-to-r from-blue-400 to-indigo-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Dusun Bungungrua</h3>
                    <div class="w-8 h-1 bg-blue-500 rounded-full mb-3"></div>
                    <p class="text-sm text-gray-600 leading-relaxed">Wilayah industri dan pengolahan</p>
                </div>
            </div>

            <!-- Dusun Sapamayo -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="h-2 bg-gradient-to-r from-purple-400 to-pink-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Dusun Sapamayo</h3>
                    <div class="w-8 h-1 bg-purple-500 rounded-full mb-3"></div>
                    <p class="text-sm text-gray-600 leading-relaxed">Kawasan budidaya dan perikanan</p>
                </div>
            </div>

            <!-- Dusun Bungung Pandang -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="h-2 bg-gradient-to-r from-teal-400 to-cyan-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M16 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Dusun Bungung Pandang</h3>
                    <div class="w-8 h-1 bg-teal-500 rounded-full mb-3"></div>
                    <p class="text-sm text-gray-600 leading-relaxed">Area pantai dan budidaya rumput laut</p>
                </div>
            </div>

            <!-- Dusun Papanloe -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="h-2 bg-gradient-to-r from-emerald-400 to-green-500"></div>
                <div class="p-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Dusun Papanloe</h3>
                    <div class="w-8 h-1 bg-emerald-500 rounded-full mb-3"></div>
                    <p class="text-sm text-gray-600 leading-relaxed">Pusat pemerintahan dan kantor desa</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fullscreen Modal -->
<div id="fullscreen-modal" class="fixed inset-0 bg-black bg-opacity-95 z-50 flex items-center justify-center" style="display: none;">
    <div class="relative w-full h-full p-4">
        <button id="close-fullscreen" class="absolute top-4 right-4 w-12 h-12 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full flex items-center justify-center text-white z-10 transition-all duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <img id="fullscreen-image" src="{{ asset('img/Peta.jpg') }}" 
             alt="Peta Administrasi Desa Papanloe" 
             class="w-full h-full object-contain">
    </div>
</div>

@endsection

@push('styles')
<style>
#map-container {
    position: relative;
    overflow: hidden;
    cursor: default;
}

#map-image {
    transition: transform 0.3s ease;
    transform-origin: center center;
    max-width: none;
    height: auto;
}

#map-image.zoomed {
    cursor: move;
}

.zoom-controls button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.zoom-controls button:disabled:hover {
    background-color: transparent;
}

/* Smooth transitions */
.fade-up {
    animation: fadeUp 0.6s ease-out;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading animation */
.loading {
    opacity: 0.5;
    pointer-events: none;
}

/* Fullscreen modal */
#fullscreen-modal {
    transition: opacity 0.3s ease;
    opacity: 0;
}

#fullscreen-modal[style*="flex"] {
    opacity: 1;
}

/* Zoom indicator */
#zoom-indicator {
    font-family: 'Courier New', monospace;
    user-select: none;
    pointer-events: none;
}

/* Hover effects for controls */
.zoom-controls button:hover:not(:disabled) {
    transform: scale(1.05);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .zoom-controls {
        right: 8px;
        top: 8px;
    }
    
    #zoom-indicator {
        bottom: 8px;
        right: 8px;
        font-size: 12px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Map zoom functionality
let currentZoom = 1;
const maxZoom = 4;
const minZoom = 0.5;
const zoomStep = 0.5;

// DOM elements
const mapImage = document.getElementById('map-image');
const mapContainer = document.getElementById('map-container');
const zoomInBtn = document.getElementById('zoom-in');
const zoomOutBtn = document.getElementById('zoom-out');
const zoomResetBtn = document.getElementById('zoom-reset');
const fullscreenBtn = document.getElementById('fullscreen');
const zoomLevelDisplay = document.getElementById('zoom-level');
const fullscreenModal = document.getElementById('fullscreen-modal');
const closeFullscreenBtn = document.getElementById('close-fullscreen');
const fullscreenImage = document.getElementById('fullscreen-image');

// Pan variables
let isPanning = false;
let startX = 0;
let startY = 0;
let translateX = 0;
let translateY = 0;

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeMapControls();
    updateZoomDisplay();
    updateButtonStates();
});

// Initialize map controls
function initializeMapControls() {
    // Zoom In
    zoomInBtn.addEventListener('click', function() {
        if (currentZoom < maxZoom) {
            currentZoom += zoomStep;
            applyZoom();
        }
    });

    // Zoom Out
    zoomOutBtn.addEventListener('click', function() {
        if (currentZoom > minZoom) {
            currentZoom -= zoomStep;
            applyZoom();
        }
    });

    // Reset Zoom
    zoomResetBtn.addEventListener('click', function() {
        currentZoom = 1;
        translateX = 0;
        translateY = 0;
        applyZoom();
    });

    // Fullscreen
    fullscreenBtn.addEventListener('click', openFullscreen);
    closeFullscreenBtn.addEventListener('click', closeFullscreen);

    // Close fullscreen on escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && fullscreenModal.style.display === 'flex') {
            closeFullscreen();
        }
    });

    // Close fullscreen on background click
    fullscreenModal.addEventListener('click', function(e) {
        if (e.target === fullscreenModal) {
            closeFullscreen();
        }
    });

    // Mouse wheel zoom
    mapContainer.addEventListener('wheel', function(e) {
        e.preventDefault();
        
        const delta = e.deltaY > 0 ? -zoomStep : zoomStep;
        const newZoom = Math.max(minZoom, Math.min(maxZoom, currentZoom + delta));
        
        if (newZoom !== currentZoom) {
            currentZoom = newZoom;
            applyZoom();
        }
    });

    // Pan functionality
    mapImage.addEventListener('mousedown', startPan);
    document.addEventListener('mousemove', doPan);
    document.addEventListener('mouseup', endPan);

    // Touch events for mobile
    mapImage.addEventListener('touchstart', handleTouchStart, { passive: false });
    mapImage.addEventListener('touchmove', handleTouchMove, { passive: false });
    mapImage.addEventListener('touchend', endPan);

    // Prevent context menu on right click
    mapImage.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
}

// Apply zoom transformation
function applyZoom() {
    const transform = `translate(${translateX}px, ${translateY}px) scale(${currentZoom})`;
    mapImage.style.transform = transform;
    
    // Update cursor
    if (currentZoom > 1) {
        mapImage.classList.add('zoomed');
    } else {
        mapImage.classList.remove('zoomed');
    }
    
    updateZoomDisplay();
    updateButtonStates();
}

// Update zoom level display
function updateZoomDisplay() {
    const percentage = Math.round(currentZoom * 100);
    zoomLevelDisplay.textContent = `${percentage}%`;
}

// Update button states
function updateButtonStates() {
    // Zoom in button
    if (currentZoom >= maxZoom) {
        zoomInBtn.disabled = true;
        zoomInBtn.style.opacity = '0.5';
        zoomInBtn.style.cursor = 'not-allowed';
    } else {
        zoomInBtn.disabled = false;
        zoomInBtn.style.opacity = '1';
        zoomInBtn.style.cursor = 'pointer';
    }

    // Zoom out button
    if (currentZoom <= minZoom) {
        zoomOutBtn.disabled = true;
        zoomOutBtn.style.opacity = '0.5';
        zoomOutBtn.style.cursor = 'not-allowed';
    } else {
        zoomOutBtn.disabled = false;
        zoomOutBtn.style.opacity = '1';
        zoomOutBtn.style.cursor = 'pointer';
    }

    // Reset button
    if (currentZoom === 1 && translateX === 0 && translateY === 0) {
        zoomResetBtn.style.opacity = '0.5';
    } else {
        zoomResetBtn.style.opacity = '1';
    }
}

// Pan functionality
function startPan(e) {
    if (currentZoom <= 1) return;
    
    isPanning = true;
    startX = e.clientX - translateX;
    startY = e.clientY - translateY;
    mapImage.style.cursor = 'grabbing';
    e.preventDefault();
}

function doPan(e) {
    if (!isPanning || currentZoom <= 1) return;
    
    e.preventDefault();
    translateX = e.clientX - startX;
    translateY = e.clientY - startY;
    
    // Apply constraints to prevent panning too far
    const rect = mapContainer.getBoundingClientRect();
    const imageRect = mapImage.getBoundingClientRect();
    
    const maxTranslateX = Math.max(0, (imageRect.width * currentZoom - rect.width) / 2);
    const maxTranslateY = Math.max(0, (imageRect.height * currentZoom - rect.height) / 2);
    
    translateX = Math.max(-maxTranslateX, Math.min(maxTranslateX, translateX));
    translateY = Math.max(-maxTranslateY, Math.min(maxTranslateY, translateY));
    
    applyZoom();
}

function endPan() {
    if (isPanning) {
        isPanning = false;
        if (currentZoom > 1) {
            mapImage.style.cursor = 'move';
        } else {
            mapImage.style.cursor = 'default';
        }
    }
}

// Touch events for mobile
function handleTouchStart(e) {
    if (e.touches.length === 1 && currentZoom > 1) {
        const touch = e.touches[0];
        startPan({ clientX: touch.clientX, clientY: touch.clientY, preventDefault: () => e.preventDefault() });
    }
}

function handleTouchMove(e) {
    if (e.touches.length === 1 && isPanning) {
        const touch = e.touches[0];
        doPan({ clientX: touch.clientX, clientY: touch.clientY, preventDefault: () => e.preventDefault() });
    }
}

// Fullscreen functionality
function openFullscreen() {
    fullscreenModal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    // Set the fullscreen image source
    fullscreenImage.src = mapImage.src;
    
    // Add fade in animation
    setTimeout(() => {
        fullscreenModal.style.opacity = '1';
    }, 10);
}

function closeFullscreen() {
    fullscreenModal.style.opacity = '0';
    setTimeout(() => {
        fullscreenModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 200);
}

// Image loading handler
mapImage.addEventListener('load', function() {
    this.style.opacity = '1';
    // Remove loading class if exists
    this.classList.remove('loading');
});

// Error handling
mapImage.addEventListener('error', function() {
    console.error('Failed to load map image');
    // You could show an error message here
});

// Smooth scroll to sections
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Add loading state
mapImage.addEventListener('loadstart', function() {
    this.classList.add('loading');
});

// Initialize image if already loaded (cached)
if (mapImage && mapImage.complete) {
    mapImage.style.opacity = '1';
}

// Add some helpful tooltips
const tooltips = {
    'zoom-in': 'Perbesar peta (Mouse wheel up)',
    'zoom-out': 'Perkecil peta (Mouse wheel down)', 
    'zoom-reset': 'Reset ke ukuran asli',
    'fullscreen': 'Lihat dalam layar penuh (Klik untuk membuka)'
};

Object.keys(tooltips).forEach(id => {
    const element = document.getElementById(id);
    if (element) {
        element.setAttribute('title', tooltips[id]);
    }
});

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Only if not in an input field
    if (e.target.tagName.toLowerCase() === 'input' || e.target.tagName.toLowerCase() === 'textarea') {
        return;
    }
    
    switch(e.key) {
        case '+':
        case '=':
            e.preventDefault();
            if (currentZoom < maxZoom) {
                currentZoom += zoomStep;
                applyZoom();
            }
            break;
        case '-':
            e.preventDefault();
            if (currentZoom > minZoom) {
                currentZoom -= zoomStep;
                applyZoom();
            }
            break;
        case '0':
            e.preventDefault();
            currentZoom = 1;
            translateX = 0;
            translateY = 0;
            applyZoom();
            break;
        case 'f':
        case 'F':
            if (e.ctrlKey || e.metaKey) {
                e.preventDefault();
                openFullscreen();
            }
            break;
    }
});

console.log('Peta Digital Desa Papanloe - Map controls initialized');
</script>
@endpush