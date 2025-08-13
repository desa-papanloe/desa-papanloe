@extends('layouts.home')

@section('content')
    <!-- Profile Desa Section -->
<section id="profile" class="py-20 bg-white transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-20 mt-[3rem] scroll-animate fade-scale">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl mb-6 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                Profil <span class="bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-800 dark:from-blue-400 dark:via-cyan-300 dark:to-blue-600 bg-clip-text text-transparent">Desa</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-8 leading-relaxed">
                Mengenal lebih dekat sejarah, visi misi, dan struktur organisasi Desa Papanloe dalam membangun masa depan yang berkelanjutan
            </p>
            <div class="flex items-center justify-center space-x-2 mb-6">
                <div class="w-8 h-1 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full"></div>
                <div class="w-4 h-1 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full"></div>
                <div class="w-2 h-1 bg-blue-600 rounded-full"></div>
            </div>
        </div>
        
        <!-- Profile Cards -->
        <div class="grid lg:grid-cols-3 gap-8 mb-16">
            <!-- Sejarah Card -->
            <div class="group relative h-full scroll-animate fade-left">
                <!-- Background Effects -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white dark:bg-slate-800 rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-200 dark:border-slate-600/50 overflow-hidden h-full flex flex-col shadow-lg">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-600/5 to-cyan-500/5 dark:from-blue-600/20 dark:to-cyan-500/20 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-gradient-to-br from-cyan-500/5 to-blue-600/5 dark:from-cyan-500/20 dark:to-blue-600/20 rounded-full blur-xl"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-blue-500/25">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        
                        <!-- Content -->
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">
                            Sejarah Desa
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed flex-grow">
                            Pada masa lalu, wilayah ini memang memiliki banyak kubangan air yang digunakan warga untuk memberikan minum ternak mereka seperti kerbau, sapi, dan kuda. Kubangan-kubangan inilah yang menjadi ciri khas wilayah ini dan akhirnya diabadikan sebagai nama desa.
                        </p>
                        
                        <!-- Key Points -->
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-300">Didirikan tahun 1965</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-300">7 Dusun</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-300">Kawasan Industri Bantaeng</span>
                            </div>
                        </div>
                        
                        <!-- Action Button - at bottom -->
                        <div class="mt-auto">
                            <a href="{{ route('sejarah') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-300 group/btn">
                                <span>Baca Selengkapnya</span>
                                <svg class="ml-2 w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Visi Misi Card -->
            <div class="group relative h-full scroll-animate fade-up">
                <!-- Background Effects -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-600 to-green-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white dark:bg-slate-800 rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-200 dark:border-slate-600/50 overflow-hidden h-full flex flex-col shadow-lg">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-600/5 to-green-500/5 dark:from-emerald-600/20 dark:to-green-500/20 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-gradient-to-br from-green-500/5 to-emerald-600/5 dark:from-green-500/20 dark:to-emerald-600/20 rounded-full blur-xl"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-600 to-green-500 rounded-xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-emerald-500/25">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        
                        <!-- Content -->
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300">
                            Visi & Misi
                        </h3>
                        
                        <!-- Content Area - with flex-grow to push button to bottom -->
                        <div class="flex-grow space-y-4">
                            <!-- Visi -->
                            <div class="bg-gray-100 dark:bg-slate-700 rounded-xl p-5 border border-gray-200 dark:border-slate-600/50 hover:bg-gray-200 dark:hover:bg-slate-600 transition-all duration-300">
                                <div class="flex items-start space-x-3">
                                    <div class="w-3 h-3 bg-emerald-500 rounded-full mt-1.5 flex-shrink-0"></div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white mb-2">
                                            Visi
                                        </h4>
                                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                            Terbangunnya Tata Kelola Pemerintahan Desa Yang Baik, Jujur dan Amanah Guna Mewujudkan Desa Papanloe Yang Mandiri, Adil, Makmur dan Sejahtera.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Misi -->
                            <div class="bg-gray-100 dark:bg-slate-700 rounded-xl p-5 border border-gray-200 dark:border-slate-600/50 hover:bg-gray-200 dark:hover:bg-slate-600 transition-all duration-300">
                                <div class="flex items-start space-x-3">
                                    <div class="w-3 h-3 bg-emerald-500 rounded-full mt-1.5 flex-shrink-0"></div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white mb-2">
                                            Misi
                                        </h4>
                                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                            Reformasi dan optimalisasi sistem kerja pemerintah, meningkatkan kesejahteraan masyarakat, menciptakan kemandirian, menciptakan rasa aman.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Button - at bottom -->
                        <div class="mt-6">
                            <a href="{{ route('visi-misi') }}" class="inline-flex items-center text-emerald-600 dark:text-emerald-400 font-semibold hover:text-emerald-800 dark:hover:text-emerald-300 transition-colors duration-300 group/btn">
                                <span>Lihat Detail</span>
                                <svg class="ml-2 w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Struktur Organisasi Card -->
            <div class="group relative h-full scroll-animate fade-right">
                <!-- Background Effects -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-pink-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white dark:bg-slate-800 rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-200 dark:border-slate-600/50 overflow-hidden h-full flex flex-col shadow-lg">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-600/5 to-pink-500/5 dark:from-purple-600/20 dark:to-pink-500/20 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-gradient-to-br from-pink-500/5 to-purple-600/5 dark:from-pink-500/20 dark:to-purple-600/20 rounded-full blur-xl"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <!-- Icon -->
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-500 rounded-xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg shadow-purple-500/25">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        
                        <!-- Content -->
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300">
                            Struktur Organisasi
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                            Perangkat desa yang profesional dan berpengalaman dalam melayani masyarakat dengan integritas tinggi dan komitmen penuh untuk kemajuan desa.
                        </p>
                        
                        <!-- Organization Preview - with flex-grow -->
                        <div class="space-y-3 mb-6 flex-grow">
                            <div class="flex items-center space-x-3 bg-gray-100 dark:bg-slate-700 rounded-lg p-3 border border-gray-200 dark:border-slate-600/50 hover:bg-gray-200 dark:hover:bg-slate-600 transition-all duration-300">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                    K
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white text-sm">Kepala Desa</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Pimpinan Pemerintahan Desa</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 bg-gray-100 dark:bg-slate-700 rounded-lg p-3 border border-gray-200 dark:border-slate-600/50 hover:bg-gray-200 dark:hover:bg-slate-600 transition-all duration-300">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                    S
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white text-sm">Sekretaris Desa</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Koordinator Administrasi</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 bg-gray-100 dark:bg-slate-700 rounded-lg p-3 border border-gray-200 dark:border-slate-600/50 hover:bg-gray-200 dark:hover:bg-slate-600 transition-all duration-300">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                    K
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white text-sm">Kaur Keuangan</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Pengelola Keuangan Desa</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Button - at bottom -->
                        <div class="mt-6">
                            <a href="{{ route('struktur') }}" class="inline-flex items-center text-purple-600 dark:text-purple-400 font-semibold hover:text-purple-800 dark:hover:text-purple-300 transition-colors duration-300 group/btn">
                                <span>Lihat Struktur Lengkap</span>
                                <svg class="ml-2 w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional Info Section -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 md:p-12 border border-gray-200 dark:border-slate-600 shadow-lg scroll-animate fade-up">
            <div class="text-center mb-8">
                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Komitmen <span class="text-blue-600 dark:text-blue-400">Bersama</span>
                </h3>
                <p class="text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Dengan sejarah yang panjang, visi yang jelas, dan struktur organisasi yang solid, Desa Papanloe siap menghadapi tantangan masa depan sambil mempertahankan nilai-nilai luhur tradisi.
                </p>
            </div>
            
            <!-- Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-xl mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Transparansi</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Pemerintahan yang terbuka dan akuntabel</p>
                </div>
                
                <div class="text-center group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-600 to-green-500 rounded-xl mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Partisipatif</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Melibatkan seluruh masyarakat dalam pembangunan</p>
                </div>
                
                <div class="text-center group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-500 rounded-xl mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Inovatif</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Mengadopsi teknologi untuk pelayanan modern</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Berita Section -->
@if($featuredBerita->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 scroll-animate fade-up">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                Berita <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-red-500">Terbaru</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Informasi dan perkembangan terkini dari Desa Papanloe
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($featuredBerita as $berita)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-500 group scroll-animate fade-up border border-gray-100 hover:border-blue-200">
                <!-- Content Header with Icon -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                            {{ $berita->kategori_label }}
                        </span>
                    </div>
                </div>
                
                <!-- Content Body -->
                <div class="p-6">
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $berita->created_at->format('d M Y') }}</span>
                        <span>•</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span>{{ $berita->views }} views</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                        <a href="{{ route('berita.show', $berita->slug) }}">{{ Str::limit($berita->judul, 60) }}</a>
                    </h3>
                    
                    <p class="text-gray-600 leading-relaxed mb-6 line-clamp-3">
                        {{ Str::limit($berita->excerpt, 120) }}
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-500">
                                @if($berita->admin)
                                    {{ $berita->admin->name }}
                                @else
                                    Admin Desa
                                @endif
                            </span>
                        </div>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors group/btn">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-2 transform group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- View All News Button -->
        <div class="text-center scroll-animate fade-up">
            <a href="/berita" class="inline-flex items-center bg-gradient-to-r from-orange-600 to-red-500 text-white px-8 py-4 rounded-2xl font-semibold hover:from-orange-700 hover:to-red-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 group">
                <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <span>Lihat Semua Berita</span>
                <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@else
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 scroll-animate fade-up">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                Berita <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-red-500">Terbaru</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Informasi dan perkembangan terkini dari Desa Papanloe
            </p>
        </div>
        
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada berita unggulan</h3>
            <p class="text-gray-600">Berita akan segera tersedia. Silakan kembali lagi nanti.</p>
        </div>
    </div>
</section>
@endif

<!-- Upcoming Agenda Section -->
@if($upcomingAgenda->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 scroll-animate fade-up">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                Agenda <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Mendatang</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Jangan lewatkan kegiatan dan acara penting di Desa Papanloe
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($upcomingAgenda as $agenda)
            <div class="bg-white border-2 border-gray-100 rounded-2xl p-6 hover:border-purple-200 hover:shadow-xl transition-all group scroll-animate fade-up">
                <div class="flex items-center mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <span class="text-xs font-semibold">{{ $agenda->tanggal_mulai->format('M') }}</span>
                        <span class="text-lg font-bold">{{ $agenda->tanggal_mulai->format('d') }}</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-purple-600 font-semibold">{{ $agenda->tanggal_mulai->format('d M Y') }}</p>
                        <p class="text-xs text-gray-500">
                            {{ $agenda->waktu_mulai ? date('H:i', strtotime($agenda->waktu_mulai)) : '00:00' }} - 
                            {{ $agenda->waktu_selesai ? date('H:i', strtotime($agenda->waktu_selesai)) : '23:59' }} WIB
                        </p>
                    </div>
                </div>
                
                <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors">
                    {{ Str::limit($agenda->judul, 60) }}
                </h3>
                
                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                    {{ Str::limit($agenda->deskripsi, 100) }}
                </p>
                
                <div class="flex items-center justify-between">
                    <div class="flex flex-col space-y-1">
                        <span class="text-xs text-gray-500 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ Str::limit($agenda->tempat, 20) }}
                        </span>
                        @if($agenda->target_peserta)
                        <span class="text-xs text-gray-500 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ Str::limit($agenda->target_peserta, 15) }}
                        </span>
                        @endif
                    </div>
                    <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">
                        {{ $agenda->kategori_label }}
                    </span>
                </div>
                
                @if($agenda->perlu_pendaftaran && $agenda->kapasitas_peserta)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-500">Pendaftar: {{ $agenda->jumlah_pendaftar ?? 0 }}/{{ $agenda->kapasitas_peserta }}</span>
                        <div class="w-16 bg-gray-200 rounded-full h-1.5">
                            <div class="bg-purple-500 h-1.5 rounded-full" style="width: {{ $agenda->kapasitas_peserta > 0 ? (($agenda->jumlah_pendaftar ?? 0) / $agenda->kapasitas_peserta) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        
        <div class="text-center scroll-animate fade-up">
            <a href="/agenda" class="inline-flex items-center bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-2xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 group">
                <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Lihat Semua Agenda</span>
                <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@else
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                Agenda <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Mendatang</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Jangan lewatkan kegiatan dan acara penting di Desa Papanloe
            </p>
        </div>
        
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada agenda mendatang</h3>
            <p class="text-gray-600">Agenda akan segera tersedia. Silakan kembali lagi nanti.</p>
        </div>
    </div>
</section>
@endif
@endsection