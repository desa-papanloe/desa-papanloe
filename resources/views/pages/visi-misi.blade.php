@extends('layouts.home')

@section('content')
<!-- Hero Section Visi Misi -->
<section class="relative min-h-[70vh] bg-white flex items-center justify-center overflow-hidden">
    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-[9rem] text-center">
        <div class="hero-content scroll-animate fade-up">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-white dark:bg-slate-900 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-semibold mb-6 border border-emerald-200 dark:border-emerald-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Arah dan Tujuan Pembangunan
            </div>
            
            <!-- Main Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                Visi & Misi
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">
                    Desa Papanloe
                </span>
            </h1>
            
            <!-- Description -->
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                Rencana Pembangunan Jangka Menengah Desa (RPJMDesa) Tahun 2023-2029 yang ditetapkan melalui pendekatan partisipatif melibatkan seluruh elemen masyarakat.
            </p>
        </div>
    </div>
</section>

<!-- Visi Section -->
<section class="py-20 bg-white dark:bg-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Visi Card -->
        <div class="relative scroll-animate fade-up">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-3xl blur opacity-20"></div>
            <div class="relative bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-200 dark:border-slate-600">
                <!-- Header -->
                <div class="bg-gradient-to-r from-emerald-600 to-teal-500 p-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-4xl font-bold text-white mb-4">VISI</h2>
                    <p class="text-emerald-100 text-lg">Desa Papanloe Tahun 2023-2029</p>
                </div>
                
                <!-- Content -->
                <div class="p-12 text-center">
                    <blockquote class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white leading-relaxed mb-8">
                        "Terbangunnya <span class="text-emerald-600 dark:text-emerald-400">Tata Kelola Pemerintahan Desa</span> Yang Baik, <span class="text-teal-600 dark:text-teal-400">Jujur dan Amanah</span> Guna Mewujudkan Desa Papanloe Yang <span class="text-green-600 dark:text-green-400">Mandiri, Adil, Makmur dan Sejahtera</span>"
                    </blockquote>
                    
                    <!-- Penjelasan Visi -->
                    <div class="grid md:grid-cols-4 gap-6 mt-12">
                        <!-- Tata Kelola -->
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Tata Kelola Baik</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                Pemerintahan yang transparan, akuntabel dan profesional
                            </p>
                        </div>
                        
                        <!-- Mandiri -->
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Mandiri</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                Mampu memenuhi kebutuhan dengan potensi dan sumber daya lokal
                            </p>
                        </div>
                        
                        <!-- Adil -->
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l-3-3m3 3l3-3"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Adil</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                Pemerataan akses dan kesempatan bagi seluruh masyarakat
                            </p>
                        </div>
                        
                        <!-- Makmur & Sejahtera -->
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Makmur & Sejahtera</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                Terpenuhinya kebutuhan dasar dengan kualitas hidup yang layak
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Misi Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-500 rounded-2xl mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-6">MISI</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Langkah-langkah strategis untuk mewujudkan visi Desa Papanloe
            </p>
        </div>

        <!-- Misi Grid -->
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Misi 1 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 scroll-animate fade-left">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-lg">1</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                            Reformasi dan Optimalisasi Sistem Kerja Pemerintah Desa
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                            Sistem kerja yang komunikatif dan tersistematis dalam hal pelayanan yang transparan, cepat dan bermasyarakat.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                Pelayanan delivery (pengaduan-jemput-antar)
                            </li>
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                Pelayanan tanpa pungutan biaya
                            </li>
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                                Keterbukaan informasi publik
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Misi 2 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 scroll-animate fade-right">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-lg">2</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                            Meningkatkan Kesejahteraan Masyarakat Desa
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                            Dengan keterbukaan lapangan kerja dan peningkatan potensi Sumber Daya Manusia (SDM).
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></div>
                                Pengembangan usaha pertanian
                            </li>
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></div>
                                Industri batu bata dan budidaya rumput laut
                            </li>
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mr-3"></div>
                                Pemberdayaan kelompok perempuan dan pemuda
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Misi 3 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 scroll-animate fade-left">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-lg">3</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                            Menciptakan Kemandirian Masyarakat Desa
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                            Dengan peluang usaha bagi produksi rumah tangga kecil (UMKM) untuk meningkatkan perekonomian masyarakat.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                Pendampingan dan pelatihan UMKM
                            </li>
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                Peran aktif BUMDes dalam pemberdayaan
                            </li>
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                Pemasaran produk ke pihak swasta dan pemerintah
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Misi 4 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 scroll-animate fade-right">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-lg">4</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                            Menciptakan Rasa Aman, Nyaman, dan Tertib
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                            Dengan pengadaan sarana dan prasarana desa untuk mendukung kesejahteraan masyarakat.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                                Pembangunan infrastruktur dasar
                            </li>
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                                Fasilitas kesehatan dan pendidikan
                            </li>
                            <li class="flex items-center">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mr-3"></div>
                                Sistem keamanan dan ketertiban
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tujuan dan Sasaran -->
<section class="py-20 bg-white dark:bg-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                Tujuan & <span class="text-blue-600 dark:text-blue-400">Sasaran</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Target pencapaian yang terukur dalam mewujudkan visi dan misi Desa Papanloe
            </p>
        </div>

        <!-- Tujuan Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Tujuan Pemerintahan -->
            <div class="text-center scroll-animate fade-up">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-blue-600 dark:text-blue-400 mb-2">Tata Kelola</h3>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Aparatur Profesional</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300">Peningkatan kapasitas SDM dan transparansi keuangan desa</p>
            </div>

            <!-- Tujuan Kesejahteraan -->
            <div class="text-center scroll-animate fade-up">
                <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-green-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-emerald-600 dark:text-emerald-400 mb-2">Kesejahteraan</h3>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Peningkatan SDM</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300">Mengurangi kemiskinan dan pengangguran melalui pemberdayaan</p>
            </div>

            <!-- Tujuan Kemandirian -->
            <div class="text-center scroll-animate fade-up">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-purple-600 dark:text-purple-400 mb-2">Kemandirian</h3>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">UMKM & BUMDes</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300">Pengembangan ekonomi melalui usaha mikro dan kecil</p>
            </div>

            <!-- Tujuan Infrastruktur -->
            <div class="text-center scroll-animate fade-up">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-orange-600 dark:text-orange-400 mb-2">Infrastruktur</h3>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Sarana Prasarana</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300">Pembangunan jalan, air bersih, listrik dan fasilitas publik</p>
            </div>
        </div>
    </div>
</section>

<!-- Sasaran Target -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                Sasaran <span class="text-emerald-600 dark:text-emerald-400">Utama</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Kelompok sasaran dalam implementasi program pembangunan desa
            </p>
        </div>

        <!-- Sasaran Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Seluruh Masyarakat -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 hover:shadow-xl transition-all duration-300 scroll-animate fade-left">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Seluruh Masyarakat</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Seluruh warga Desa Papanloe menjadi sasaran utama dalam program peningkatan kesejahteraan dan pembangunan berkelanjutan.
                </p>
            </div>

            <!-- Kelompok Petani dan Nelayan -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Kelompok Tani & Nelayan</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Kelompok tani, nelayan, dan budidaya rumput laut sebagai tulang punggung perekonomian desa yang perlu diberdayakan.
                </p>
            </div>

            <!-- Generasi Muda -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 hover:shadow-xl transition-all duration-300 scroll-animate fade-right">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Generasi Muda</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Siswa SD, SMP, SMA, mahasiswa, dan kelompok pemuda sebagai generasi penerus pembangunan desa.
                </p>
            </div>

            <!-- Kaum Perempuan -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 hover:shadow-xl transition-all duration-300 scroll-animate fade-left">
                <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Kaum Perempuan</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Kelompok perempuan desa yang diberi peran besar dalam pembangunan ekonomi dan sosial masyarakat.
                </p>
            </div>

            <!-- Pelaku UMKM -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Pelaku UMKM</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Pelaku usaha mikro kecil menengah dan pengurus BUMDes untuk mengembangkan ekonomi desa.
                </p>
            </div>

            <!-- Perangkat Desa -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 hover:shadow-xl transition-all duration-300 scroll-animate fade-right">
                <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Perangkat Desa</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Perangkat desa, BPD, RK dan RT sebagai pelaksana program pemerintahan dan pembangunan desa.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Periode Pelaksanaan -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center scroll-animate fade-scale">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl mb-8">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                Periode <span class="text-indigo-600 dark:text-indigo-400">Pelaksanaan</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                Rencana Pembangunan Jangka Menengah Desa (RPJMDesa) ini ditetapkan untuk periode 6 tahun
            </p>
            
            <!-- Timeline -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-8 text-white">
                <div class="flex items-center justify-center space-x-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2">2023</div>
                        <div class="text-indigo-200">Tahun Mulai</div>
                    </div>
                    <div class="flex-1 h-1 bg-white/30 rounded-full relative">
                        <div class="absolute inset-0 bg-white rounded-full animate-pulse"></div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold mb-2">2029</div>
                        <div class="text-indigo-200">Tahun Berakhir</div>
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <p class="text-lg font-semibold">6 Tahun Periode Pembangunan</p>
                    <p class="text-indigo-200 mt-2">Ditetapkan melalui pendekatan partisipatif melibatkan seluruh elemen masyarakat</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection