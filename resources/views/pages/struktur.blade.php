@extends('layouts.home')

@section('content')
<!-- Hero Section Struktur Organisasi -->
<section class="relative min-h-[70vh] bg-white flex items-center justify-center overflow-hidden">
    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-[9rem] text-center">
        <div class="hero-content scroll-animate fade-up">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-white text-purple-700 rounded-full text-sm font-semibold mb-6 border border-purple-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Pemerintahan Desa Profesional
            </div>
            
            <!-- Main Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Struktur Organisasi
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-600">
                    Desa Papanloe
                </span>
            </h1>
            
            <!-- Description -->
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Susunan organisasi pemerintahan desa yang profesional, berpengalaman, dan berkomitmen melayani masyarakat dengan integritas tinggi.
            </p>
            
            <!-- Quick Stats -->
            <div class="flex flex-wrap justify-center items-center gap-8 text-sm text-gray-500">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                    <span>8 Perangkat Desa</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                    <span>7 Kepala Dusun</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span>9 Anggota BPD</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kepala Desa -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Kepala Desa Profile -->
        <div class="relative mb-20 scroll-animate fade-up">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-indigo-500 rounded-3xl blur opacity-20"></div>
            <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-200">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-600 to-indigo-500 p-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">KEPALA DESA</h2>
                    <p class="text-purple-100">Pimpinan Pemerintahan Desa Papanloe</p>
                </div>
                
                <!-- Content -->
                <div class="p-12">
                    <div class="flex flex-col lg:flex-row items-center gap-12">
                        <!-- Photo -->
                        <div class="flex-shrink-0">
                            <div class="w-48 h-48 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-3xl flex items-center justify-center shadow-xl">
                                <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Info -->
                        <div class="flex-grow text-center lg:text-left">
                            <h3 class="text-3xl font-bold text-gray-900 mb-2">Rahmat Hidayat</h3>
                            <p class="text-xl text-purple-600 font-semibold mb-4">Kepala Desa Papanloe</p>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Memimpin Desa Papanloe periode 2023-2029 dengan visi mewujudkan desa yang modern, maju, dan sejahtera. Berkomitmen dalam pembangunan berkelanjutan, digitalisasi pelayanan publik, dan pemberdayaan ekonomi masyarakat.
                            </p>
                            
                            <!-- Achievements -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-purple-600">2+</div>
                                    <div class="text-sm text-gray-500">Tahun Memimpin</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-indigo-600">10+</div>
                                    <div class="text-sm text-gray-500">Program Aktif</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600">3,867</div>
                                    <div class="text-sm text-gray-500">Jiwa Penduduk</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Perangkat Desa -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Perangkat <span class="text-indigo-600">Desa</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Tim profesional yang berkomitmen memberikan pelayanan terbaik kepada masyarakat
            </p>
        </div>

        <!-- Perangkat Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Sekretaris Desa -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-left">
               <div class="text-center">
                   <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                       <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                       </svg>
                   </div>
                   
                   <h3 class="text-xl font-bold text-gray-900 mb-2">Indah Pratiwi M, S.Pd</h3>
                   <p class="text-blue-600 font-semibold mb-4">Sekretaris Desa</p>
                   <p class="text-gray-600 text-sm leading-relaxed">
                       Koordinator administrasi dan tata kelola pemerintahan desa. Bertanggung jawab atas dokumentasi dan arsip desa.
                   </p>
               </div>
           </div>

           <!-- Kasi Kesejahteraan -->
           <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
               <div class="text-center">
                   <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                       <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                       </svg>
                   </div>
                   
                   <h3 class="text-xl font-bold text-gray-900 mb-2">Serly, S.Farm</h3>
                   <p class="text-emerald-600 font-semibold mb-4">Kasi Kesejahteraan</p>
                   <p class="text-gray-600 text-sm leading-relaxed">
                       Menangani program kesejahteraan sosial, bantuan masyarakat, dan pemberdayaan ekonomi keluarga.
                   </p>
               </div>
           </div>

           <!-- Kasi Pelayanan -->
           <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-right">
               <div class="text-center">
                   <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                       <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                       </svg>
                   </div>
                   
                   <h3 class="text-xl font-bold text-gray-900 mb-2">Dewi Sinta, S.Pd</h3>
                   <p class="text-purple-600 font-semibold mb-4">Kasi Pelayanan</p>
                   <p class="text-gray-600 text-sm leading-relaxed">
                       Koordinator pelayanan publik dan penanganan administrasi kependudukan serta perizinan.
                   </p>
               </div>
           </div>

           <!-- Kasi Pemerintahan -->
           <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-left">
               <div class="text-center">
                   <div class="w-24 h-24 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                       <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                       </svg>
                   </div>
                   
                   <h3 class="text-xl font-bold text-gray-900 mb-2">Hamrana, S.E</h3>
                   <p class="text-orange-600 font-semibold mb-4">Kasi Pemerintahan</p>
                   <p class="text-gray-600 text-sm leading-relaxed">
                       Menangani urusan pemerintahan, kependudukan, dan layanan administrasi masyarakat.
                   </p>
               </div>
           </div>

           <!-- Kaur Tata Usaha dan Umum -->
           <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
               <div class="text-center">
                   <div class="w-24 h-24 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                       <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                       </svg>
                   </div>
                   
                   <h3 class="text-xl font-bold text-gray-900 mb-2">Jurnal, S.Pd</h3>
                   <p class="text-teal-600 font-semibold mb-4">Kaur Tata Usaha dan Umum</p>
                   <p class="text-gray-600 text-sm leading-relaxed">
                       Menangani urusan umum, perlengkapan, dan koordinasi kegiatan desa.
                   </p>
               </div>
           </div>

           <!-- Kaur Perencanaan -->
           <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-right">
               <div class="text-center">
                   <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                       <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                       </svg>
                   </div>
                   
                   <h3 class="text-xl font-bold text-gray-900 mb-2">M. Alif Tawakkal, S.Pd</h3>
                   <p class="text-indigo-600 font-semibold mb-4">Kaur Perencanaan</p>
                   <p class="text-gray-600 text-sm leading-relaxed">
                       Bertanggung jawab dalam perencanaan pembangunan dan program desa.
                   </p>
               </div>
           </div>

           <!-- Kaur Keuangan -->
           <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-left">
               <div class="text-center">
                   <div class="w-24 h-24 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                       <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                       </svg>
                   </div>
                   
                   <h3 class="text-xl font-bold text-gray-900 mb-2">Irwan, S.H</h3>
                   <p class="text-amber-600 font-semibold mb-4">Kaur Keuangan</p>
                   <p class="text-gray-600 text-sm leading-relaxed">
                       Pengelola keuangan desa, anggaran, dan pelaporan keuangan dengan transparansi tinggi.
                   </p>
               </div>
           </div>
       </div>
   </div>
</section>

<!-- Kepala Dusun -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Kepala <span class="text-green-600">Dusun</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Pimpinan di tingkat dusun yang menjadi penghubung antara pemerintah desa dengan masyarakat
            </p>
        </div>

        <!-- Kepala Dusun Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Kepala Dusun Papanloe -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Syamsuddin</h3>
                    <p class="text-green-600 font-semibold text-sm mb-2">Kepala Dusun Papanloe</p>
                    <p class="text-gray-500 text-xs">Pusat Desa</p>
                </div>
            </div>

            <!-- Kepala Dusun Bungung Rua -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Wati</h3>
                    <p class="text-blue-600 font-semibold text-sm mb-2">Kepala Dusun Bungung Rua</p>
                    <p class="text-gray-500 text-xs">Dataran Sedang</p>
                </div>
            </div>

            <!-- Kepala Dusun Bungung Pandang -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Rahman T</h3>
                    <p class="text-purple-600 font-semibold text-sm mb-2">Kepala Dusun Bungung Pandang</p>
                    <p class="text-gray-500 text-xs">Dataran Sedang</p>
                </div>
            </div>

            <!-- Kepala Dusun Sapamayo -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Rustan</h3>
                    <p class="text-orange-600 font-semibold text-sm mb-2">Kepala Dusun Sapamayo</p>
                    <p class="text-gray-500 text-xs">Dataran Rendah</p>
                </div>
            </div>

            <!-- Kepala Dusun Balla Tinggia -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Al-Hidayat</h3>
                    <p class="text-teal-600 font-semibold text-sm mb-2">Kepala Dusun Balla Tinggia</p>
                    <p class="text-gray-500 text-xs">Dataran Rendah</p>
                </div>
            </div>

            <!-- Kepala Dusun Kayu Loe -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Firman</h3>
                    <p class="text-cyan-600 font-semibold text-sm mb-2">Kepala Dusun Kayu Loe</p>
                    <p class="text-gray-500 text-xs">Pesisir</p>
                </div>
            </div>

            <!-- Kepala Dusun Mawang -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 scroll-animate fade-up">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Irwan Tomi</h3>
                    <p class="text-emerald-600 font-semibold text-sm mb-2">Kepala Dusun Mawang</p>
                    <p class="text-gray-500 text-xs">Pesisir</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Badan Permusyawaratan Desa (BPD) -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Badan Permusyawaratan <span class="text-blue-600">Desa</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Lembaga legislatif di tingkat desa yang menjalankan fungsi pengawasan dan permusyawaratan
            </p>
        </div>

        <!-- BPD Structure -->
        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200 scroll-animate fade-up">
            <!-- Ketua BPD -->
            <div class="text-center mb-12">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Muh. Ramli</h3>
                <p class="text-blue-600 font-semibold mb-4">Ketua BPD</p>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Memimpin dan mengkoordinasikan kegiatan BPD dalam menjalankan fungsi legislatif dan pengawasan di tingkat desa.
                </p>
            </div>

            <!-- Pengurus BPD -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Wakil Ketua -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900 mb-1">Supardi</h4>
                    <p class="text-green-600 font-semibold text-sm">Wakil Ketua</p>
                </div>

                <!-- Sekretaris -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900 mb-1">Nasrun</h4>
                    <p class="text-purple-600 font-semibold text-sm">Sekretaris</p>
                </div>
            </div>

            <!-- Anggota BPD -->
            <div class="border-t border-gray-200 pt-8">
                <h4 class="text-xl font-bold text-gray-900 mb-6 text-center">Anggota BPD</h4>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="font-bold text-gray-900 text-sm">Nursyamsi</h5>
                        <p class="text-orange-600 text-xs">Anggota</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="font-bold text-gray-900 text-sm">Nurfadillah</h5>
                        <p class="text-teal-600 text-xs">Anggota</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-purple-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="font-bold text-gray-900 text-sm">Nuraeni</h5>
                        <p class="text-pink-600 text-xs">Anggota</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="font-bold text-gray-900 text-sm">Ramlawati</h5>
                        <p class="text-amber-600 text-xs">Anggota</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-slate-500 to-gray-600 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="font-bold text-gray-900 text-sm">Herman</h5>
                        <p class="text-slate-600 text-xs">Anggota</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-pink-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h5 class="font-bold text-gray-900 text-sm">Tajuddin</h5>
                        <p class="text-rose-600 text-xs">Anggota</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Organisasi PKK -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Pemberdayaan dan Kesejahteraan <span class="text-pink-600">Keluarga</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Organisasi perempuan yang berperan dalam pemberdayaan keluarga dan penggerak program kesejahteraan masyarakat
            </p>
        </div>

        <!-- PKK Leadership -->
        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200 scroll-animate fade-up">
            <!-- Ketua PKK -->
            <div class="text-center mb-12">
                <div class="w-24 h-24 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Nurwaeki Jamalia Pratiwi</h3>
                <p class="text-pink-600 font-semibold mb-4">Ketua PKK Desa Papanloe</p>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Memimpin gerakan PKK dalam pemberdayaan keluarga dan peningkatan kesejahteraan masyarakat Desa Papanloe.
                </p>
            </div>

            <!-- Pengurus Inti PKK -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Wakil Ketua -->
                <div class="text-center">
                    <div class="w-18 h-18 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h4 class="text-base font-bold text-gray-900 mb-1">Musdalifa</h4>
                    <p class="text-purple-600 font-semibold text-sm">Wakil Ketua</p>
                </div>

                <!-- Sekretaris -->
                <div class="text-center">
                    <div class="w-18 h-18 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h4 class="text-base font-bold text-gray-900 mb-1">Muliana, S.Pd</h4>
                    <p class="text-green-600 font-semibold text-sm">Sekretaris</p>
                </div>

                                   <!-- Bendahara -->
                <div class="text-center">
                    <div class="w-18 h-18 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-base font-bold text-gray-900 mb-1">Nursyamsi</h4>
                    <p class="text-amber-600 font-semibold text-sm">Bendahara</p>
                </div>
            </div>
            </div>

            <!-- Kelompok Kerja PKK -->
            <div class="border-t border-gray-200 pt-8">
                <h4 class="text-xl font-bold text-gray-900 mb-6 text-center">Kelompok Kerja (POKJA)</h4>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- POKJA 1 -->
                    <div class="bg-rose-50 rounded-xl p-6 border border-rose-200">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-pink-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold text-lg">1</span>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900 mb-1">POKJA 1</h5>
                            <p class="text-rose-600 font-semibold text-sm mb-3">Suriani</p>
                            <p class="text-gray-600 text-xs mb-4">Penghayatan dan Pengamalan Pancasila</p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-rose-400 rounded-full mr-2"></div>
                                <span>Jusni</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-rose-400 rounded-full mr-2"></div>
                                <span>Herlina</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-rose-400 rounded-full mr-2"></div>
                                <span>Hasmi</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-rose-400 rounded-full mr-2"></div>
                                <span>H. Wati</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-rose-400 rounded-full mr-2"></div>
                                <span>Samriani</span>
                            </div>
                        </div>
                    </div>

                    <!-- POKJA 2 -->
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold text-lg">2</span>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900 mb-1">POKJA 2</h5>
                            <p class="text-blue-600 font-semibold text-sm mb-3">Ida H. Juli</p>
                            <p class="text-gray-600 text-xs mb-4">Gotong Royong</p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                <span>Fenti Irwanti</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                <span>H. Isra</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                <span>Nurhayati</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                <span>Rini Syamsuddin</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                <span>Hasrawati</span>
                            </div>
                        </div>
                    </div>

                    <!-- POKJA 3 -->
                    <div class="bg-green-50 rounded-xl p-6 border border-green-200">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold text-lg">3</span>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900 mb-1">POKJA 3</h5>
                            <p class="text-green-600 font-semibold text-sm mb-3">Hasni</p>
                            <p class="text-gray-600 text-xs mb-4">Pangan, Sandang & Perumahan</p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                <span>Sartika</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                <span>Hasmita</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                <span>Nurjannah</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                <span>Erni</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                <span>Nurfadillah</span>
                            </div>
                        </div>
                    </div>

                    <!-- POKJA 4 -->
                    <div class="bg-purple-50 rounded-xl p-6 border border-purple-200">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold text-lg">4</span>
                            </div>
                            <h5 class="text-lg font-bold text-gray-900 mb-1">POKJA 4</h5>
                            <p class="text-purple-600 font-semibold text-sm mb-3">Endriani</p>
                            <p class="text-gray-600 text-xs mb-4">Pendidikan & Keterampilan</p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-400 rounded-full mr-2"></div>
                                <span>Hasnia</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-400 rounded-full mr-2"></div>
                                <span>Srisusanti</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-400 rounded-full mr-2"></div>
                                <span>Riskawati</span>
                            </div>
                            <div class="text-xs text-gray-600 flex items-center">
                                <div class="w-2 h-2 bg-purple-400 rounded-full mr-2"></div>
                                <span>Dewi Sinta</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bagan Organisasi -->
<section class="py-20 bg-gray-50">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
       <!-- Section Header -->
       <div class="text-center mb-16 scroll-animate fade-scale">
           <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
               Bagan <span class="text-purple-600">Organisasi</span>
           </h2>
           <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
               Struktur hierarki dan alur koordinasi dalam pemerintahan Desa Papanloe
           </p>
       </div>

       <!-- Organizational Chart -->
       <div class="scroll-animate fade-up">
           <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200 overflow-x-auto">
               <!-- Level 1: Kepala Desa -->
               <div class="flex justify-center mb-12">
                   <div class="text-center">
                       <div class="w-32 h-32 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                           <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                           </svg>
                       </div>
                       <h3 class="text-lg font-bold text-gray-900">KEPALA DESA</h3>
                       <p class="text-sm text-purple-600">Rahmat Hidayat</p>
                   </div>
               </div>

               <!-- Connecting Line -->
               <div class="flex justify-center mb-8">
                   <div class="w-1 h-8 bg-gray-300"></div>
               </div>

               <!-- Level 2: Sekretaris Desa -->
               <div class="flex justify-center mb-12">
                   <div class="text-center">
                       <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                           <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                           </svg>
                       </div>
                       <h3 class="text-base font-bold text-gray-900">SEKRETARIS DESA</h3>
                       <p class="text-sm text-blue-600">Indah Pratiwi M, S.Pd</p>
                   </div>
               </div>

               <!-- Connecting Lines -->
               <div class="flex justify-center mb-8">
                   <div class="flex items-center">
                       <div class="w-16 h-1 bg-gray-300"></div>
                       <div class="w-1 h-8 bg-gray-300"></div>
                       <div class="w-16 h-1 bg-gray-300"></div>
                   </div>
               </div>

               <!-- Level 3: Kaur -->
               <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                   <!-- Kaur Tata Usaha dan Umum -->
                   <div class="text-center">
                       <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                           <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                           </svg>
                       </div>
                       <h4 class="text-sm font-bold text-gray-900">KAUR TATA USAHA & UMUM</h4>
                       <p class="text-xs text-teal-600">Jurnal, S.Pd</p>
                   </div>

                   <!-- Kaur Perencanaan -->
                   <div class="text-center">
                       <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                           <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                           </svg>
                       </div>
                       <h4 class="text-sm font-bold text-gray-900">KAUR PERENCANAAN</h4>
                       <p class="text-xs text-indigo-600">M. Alif Tawakkal, S.Pd</p>
                   </div>

                   <!-- Kaur Keuangan -->
                   <div class="text-center">
                       <div class="w-20 h-20 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                           <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                           </svg>
                       </div>
                       <h4 class="text-sm font-bold text-gray-900">KAUR KEUANGAN</h4>
                       <p class="text-xs text-amber-600">Irwan, S.H</p>
                   </div>
               </div>

               <!-- Connecting Lines untuk Kasi -->
               <div class="flex justify-center mb-8">
                   <div class="flex items-center">
                       <div class="w-32 h-1 bg-gray-300"></div>
                       <div class="w-1 h-8 bg-gray-300"></div>
                       <div class="w-32 h-1 bg-gray-300"></div>
                   </div>
               </div>

               <!-- Level 4: Kasi -->
               <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                   <!-- Kasi Pemerintahan -->
                   <div class="text-center">
                       <div class="w-18 h-18 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center mx-auto mb-3 shadow-lg">
                           <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                           </svg>
                       </div>
                       <h4 class="text-sm font-bold text-gray-900">KASI PEMERINTAHAN</h4>
                       <p class="text-xs text-orange-600">Hamrana, S.E</p>
                   </div>

                   <!-- Kasi Kesejahteraan -->
                   <div class="text-center">
                       <div class="w-18 h-18 bg-gradient-to-br from-emerald-500 to-green-500 rounded-lg flex items-center justify-center mx-auto mb-3 shadow-lg">
                           <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                           </svg>
                       </div>
                       <h4 class="text-sm font-bold text-gray-900">KASI KESEJAHTERAAN</h4>
                       <p class="text-xs text-emerald-600">Serly, S.Farm</p>
                   </div>

                   <!-- Kasi Pelayanan -->
                   <div class="text-center">
                       <div class="w-18 h-18 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-lg flex items-center justify-center mx-auto mb-3 shadow-lg">
                           <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                           </svg>
                       </div>
                       <h4 class="text-sm font-bold text-gray-900">KASI PELAYANAN</h4>
                       <p class="text-xs text-purple-600">Dewi Sinta, S.Pd</p>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>
<!-- Staf Kantor -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Staf <span class="text-gray-600">Kantor</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Tim pendukung yang membantu kelancaran operasional pemerintahan desa
            </p>
        </div>

        <!-- Staf Bagian -->
        <div class="space-y-8">
            <!-- Kaur Perencanaan -->
            <div class="bg-gray-50 rounded-2xl p-8 scroll-animate fade-left">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bagian Kaur Perencanaan</h3>
                        <p class="text-indigo-600 font-semibold">Kepala: M. Alif Tawakkal, S.Pd</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Nurjannah</h4>
                        <p class="text-sm text-gray-600">Staf Perencanaan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Fitri</h4>
                        <p class="text-sm text-gray-600">Staf Perencanaan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Sri Susanti</h4>
                        <p class="text-sm text-gray-600">Staf Perencanaan</p>
                    </div>
                </div>
            </div>

            <!-- Kaur Keuangan -->
            <div class="bg-gray-50 rounded-2xl p-8 scroll-animate fade-right">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bagian Kaur Keuangan</h3>
                        <p class="text-amber-600 font-semibold">Kepala: Irwan, S.H</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Erni</h4>
                        <p class="text-sm text-gray-600">Staf Keuangan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Hasrawati M, S.Pd</h4>
                        <p class="text-sm text-gray-600">Staf Keuangan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Sartika</h4>
                        <p class="text-sm text-gray-600">Staf Keuangan</p>
                    </div>
                </div>
            </div>

            <!-- Kaur Tata Usaha dan Umum -->
            <div class="bg-gray-50 rounded-2xl p-8 scroll-animate fade-left">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bagian Kaur Tata Usaha dan Umum</h3>
                        <p class="text-teal-600 font-semibold">Kepala: Jurnal, S.Pd</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-5 gap-4">
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Nurlaela</h4>
                        <p class="text-sm text-gray-600">Staf TU</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Samriani</h4>
                        <p class="text-sm text-gray-600">Staf TU</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Asmaul Husnah</h4>
                        <p class="text-sm text-gray-600">Staf TU</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Tasbiana</h4>
                        <p class="text-sm text-gray-600">Staf TU</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Risnawati</h4>
                        <p class="text-sm text-gray-600">Staf TU</p>
                    </div>
                </div>
            </div>

            <!-- Kasi Pemerintahan -->
            <div class="bg-gray-50 rounded-2xl p-8 scroll-animate fade-right">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bagian Kasi Pemerintahan</h3>
                        <p class="text-orange-600 font-semibold">Kepala: Hamrana, S.E</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Juharni</h4>
                        <p class="text-sm text-gray-600">Staf Pemerintahan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Magfira</h4>
                        <p class="text-sm text-gray-600">Staf Pemerintahan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Irmawati ST</h4>
                        <p class="text-sm text-gray-600">Staf Pemerintahan</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Riskawanti</h4>
                        <p class="text-sm text-gray-600">Staf Pemerintahan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Maya</h4>
                        <p class="text-sm text-gray-600">Staf Pemerintahan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Nurjannah</h4>
                        <p class="text-sm text-gray-600">Staf Pemerintahan</p>
                    </div>
                </div>
            </div>

            <!-- Kasi Pelayanan -->
            <div class="bg-gray-50 rounded-2xl p-8 scroll-animate fade-left">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bagian Kasi Pelayanan</h3>
                        <p class="text-purple-600 font-semibold">Kepala: Dewi Sinta, S.Pd</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Safira</h4>
                        <p class="text-sm text-gray-600">Staf Pelayanan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Inar</h4>
                        <p class="text-sm text-gray-600">Staf Pelayanan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Irna</h4>
                        <p class="text-sm text-gray-600">Staf Pelayanan</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-4 mt-4">
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Rina</h4>
                        <p class="text-sm text-gray-600">Staf Pelayanan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Rahmawati</h4>
                        <p class="text-sm text-gray-600">Staf Pelayanan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Sri Nursafitri</h4>
                        <p class="text-sm text-gray-600">Staf Pelayanan</p>
                    </div>
                </div>
            </div>

            <!-- Kasi Kesejahteraan -->
            <div class="bg-gray-50 rounded-2xl p-8 scroll-animate fade-right">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center mr-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bagian Kasi Kesejahteraan</h3>
                        <p class="text-emerald-600 font-semibold">Kepala: Serly, S.Farm</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-5 gap-4">
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Sartika</h4>
                        <p class="text-sm text-gray-600">Staf Kesejahteraan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Rika</h4>
                        <p class="text-sm text-gray-600">Staf Kesejahteraan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Kasmita</h4>
                        <p class="text-sm text-gray-600">Staf Kesejahteraan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Marissa</h4>
                        <p class="text-sm text-gray-600">Staf Kesejahteraan</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-1">Muliana</h4>
                        <p class="text-sm text-gray-600">Staf Kesejahteraan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection