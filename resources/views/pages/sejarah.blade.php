@extends('layouts.home')

@section('content')
<!-- Hero Section Sejarah -->
<section class="relative min-h-[70vh] flex bg-white items-center justify-center overflow-hidden">
    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-[9rem] text-center">
        <div class="hero-content scroll-animate fade-up">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-white dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full text-sm font-semibold mb-6 border border-blue-200 dark:border-blue-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Sejarah dan Warisan Budaya
            </div>
            
            <!-- Main Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                Sejarah
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                    Desa Papanloe
                </span>
            </h1>
            
            <!-- Description -->
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                Perjalanan panjang Desa Papanloe dari masa ke masa, dari tahun 1965 hingga menjadi desa modern dengan kawasan industri yang maju.
            </p>
            
            <!-- Timeline Preview -->
            <div class="flex flex-wrap justify-center items-center gap-8 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                    <span>1965 - Mulai Digarap</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                    <span>1997 - Pemekaran</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                    <span>2024 - Era Modern</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Asal Nama Desa -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                Asal Usul <span class="text-blue-600 dark:text-blue-400">Nama Papanloe</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Nama "Papanloe" memiliki makna historis yang dalam bagi masyarakat setempat.
            </p>
        </div>

        <!-- Etymology Card -->
        <div class="max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-slate-600 scroll-animate fade-up">
            <div class="flex items-start space-x-6">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">"Papoang Loe" - Banyaknya Kubangan</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                        Secara terminologi, kata "Papanloe" berasal dari bahasa daerah Makassar yaitu <strong>"Papoang Loe"</strong> yang berarti "banyaknya kubangan". Nama ini kemudian diperhalus menjadi "Papanloe".
                    </p>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        Pada masa lalu, wilayah ini memang memiliki banyak kubangan air yang digunakan warga untuk memberikan minum ternak mereka seperti kerbau, sapi, dan kuda. Kubangan-kubangan inilah yang menjadi ciri khas wilayah ini dan akhirnya diabadikan sebagai nama desa.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Sejarah -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-20 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                Perjalanan <span class="text-blue-600 dark:text-blue-400">Sejarah</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Menelusuri jejak perjalanan Desa Papanloe dari masa ke masa dengan berbagai peristiwa penting yang membentuk karakter desa ini.
            </p>
        </div>

        <!-- Timeline -->
        <div class="relative">
            <!-- Vertical Line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-blue-500 via-purple-500 to-emerald-500 rounded-full"></div>
            
            <!-- Timeline Items -->
            <div class="space-y-16">
                <!-- Era 1965-1970: Awal Penggarapan -->
                <div class="relative flex items-center scroll-animate fade-left">
                    <div class="w-1/2 pr-8 text-right">
                        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-slate-600">
                            <div class="flex items-center justify-end mb-4">
                                <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-900 dark:text-blue-300 px-3 py-1 rounded-full text-sm font-semibold">1965-1970</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Awal Penggarapan ABRI/YONKARYA I</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                Papanloe mulai digarap pada tahun 1965 oleh ABRI atau YONKARYA I. Penduduk awal berasal dari berbagai wilayah seperti Jeneponto, Bulukumba, Tompobulu Bantaeng, dan daerah lainnya.
                            </p>
                            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>Masih sunyi dengan penduduk sedikit</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>Daerah hutan masih luas</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>Kemarau panjang 1972 (10 bulan)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="w-1/2 pl-8"></div>
                </div>

                <!-- Era 1975-1985: Pembangunan Infrastruktur -->
                <div class="relative flex items-center scroll-animate fade-right">
                    <div class="w-1/2 pr-8"></div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <div class="w-1/2 pl-8">
                        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-slate-600">
                            <div class="flex items-center mb-4">
                                <span class="bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 px-3 py-1 rounded-full text-sm font-semibold">1975-1985</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Era Pembangunan Infrastruktur</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                Periode pembangunan infrastruktur dasar seperti jalan menuju provinsi, sekolah dasar pertama, dan masa panen melimpah yang meningkatkan kesejahteraan masyarakat.
                            </p>
                            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>1975: Jalan menuju provinsi (mempermudah perjalanan)</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>1983: SD Papanloe dibangun</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>1985: Panen kapas dan kacang hijau melimpah</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Era 1986-1997: Modernisasi Awal -->
                <div class="relative flex items-center scroll-animate fade-left">
                    <div class="w-1/2 pr-8 text-right">
                        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-slate-600">
                            <div class="flex items-center justify-end mb-4">
                                <span class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 px-3 py-1 rounded-full text-sm font-semibold">1986-1997</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Modernisasi Awal</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                Era masuknya program KB, pembangunan sekolah tambahan, dan persiapan menuju pemekaran desa dengan berbagai program pembangunan sosial.
                            </p>
                            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                                <li class="flex items-center"><span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>1986: Penyuluh KB masuk desa</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>1990: Dibangun SD Mawang</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>Persiapan pemekaran dari Desa Borong Loe dan Layoa</li>
                            </ul>
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="w-1/2 pl-8"></div>
                </div>

                <!-- Era 1997-2001: Pemekaran dan Desa Persiapan -->
                <div class="relative flex items-center scroll-animate fade-right">
                    <div class="w-1/2 pr-8"></div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <div class="w-1/2 pl-8">
                        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-slate-600">
                            <div class="flex items-center mb-4">
                                <span class="bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 px-3 py-1 rounded-full text-sm font-semibold">1997-2001</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Pemekaran & Desa Persiapan</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                Tahun bersejarah dengan pemekaran desa dari Borong Loe dan Layoa menjadi Desa Persiapan Papanloe, dengan Abdullah Mattata, S.Sos sebagai kepala desa pertama.
                            </p>
                            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>1997: Pemekaran resmi desa</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>1998: Pengerasan jalan dari provinsi</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>1999: Penggalian sumur bor pertama</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Era 2001-Sekarang: Desa Definitif Modern -->
                <div class="relative flex items-center scroll-animate fade-left">
                    <div class="w-1/2 pr-8 text-right">
                        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-slate-600">
                            <div class="flex items-center justify-end mb-4">
                                <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold">2001-Sekarang</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Desa Definitif & Era Industri</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                                Era transformasi menuju desa modern dengan kawasan industri nikel, infrastruktur lengkap, dan sistem pemerintahan yang mapan dengan 4 periode kepemimpinan.
                            </p>
                            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>2001: Pemilihan kepala desa pertama</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>2012-2013: Era industri nikel (PT. Huadi)</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>2023: Era kepemimpinan Rahmat Hidayat</li>
                            </ul>
                        </div>
                    </div>
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="w-1/2 pl-8"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kepala Desa dari Masa ke Masa -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                Kepemimpinan <span class="text-purple-600 dark:text-purple-400">dari Masa ke Masa</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Para pemimpin yang telah memimpin Desa Papanloe sejak periode persiapan hingga era modern saat ini.
            </p>
        </div>

        <!-- Leaders Grid -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Abdullah Mattata -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-slate-600 scroll-animate fade-left">
                <div class="flex items-start space-x-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Abdullah Mattata, S.Sos</h3>
                        <p class="text-sm text-blue-600 dark:text-blue-400 font-semibold mb-4">Periode 1997-2011 (14 tahun)</p>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Kepala desa pertama yang memimpin sejak masa persiapan (1997-2001) hingga desa definitif. Berhasil membangun fondasi pemerintahan desa dan infrastruktur dasar.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sarifuddin -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-slate-600 scroll-animate fade-right">
                <div class="flex items-start space-x-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                   </div>
                   <div>
                       <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Sarifuddin, S.Sos</h3>
                       <p class="text-sm text-emerald-600 dark:text-emerald-400 font-semibold mb-4">Periode 2011-2017 (6 tahun)</p>
                       <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                           Memimpin desa memasuki era industri dengan pembangunan kawasan industri nikel dan modernisasi pelayanan publik.
                       </p>
                   </div>
               </div>
           </div>

            <!-- Kamaruddin -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-slate-600 scroll-animate fade-left">
                <div class="flex items-start space-x-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Kamaruddin</h3>
                        <p class="text-sm text-orange-600 dark:text-orange-400 font-semibold mb-4">Periode 2018-2023 (5 tahun)</p>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Memimpin desa dalam era ekspansi industri dengan hadirnya PT. Hengsheng dan PT. Unity, serta menghadapi tantangan pandemi COVID-19.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Rahmat Hidayat -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl border border-gray-200 dark:border-slate-600 scroll-animate fade-right">
                <div class="flex items-start space-x-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Rahmat Hidayat</h3>
                        <p class="text-sm text-purple-600 dark:text-purple-400 font-semibold mb-4">Periode 2023-2029 (Aktif)</p>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Kepala desa aktif yang memimpin Papanloe menuju era digitalisasi dan pembangunan berkelanjutan dengan visi desa modern.
                        </p>
                    </div>
                </div>
            </div>
       </div>
   </div>
</section>

<!-- Kondisi Demografis -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 scroll-animate fade-scale">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
                Kondisi <span class="text-emerald-600 dark:text-emerald-400">Demografis</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Gambaran geografis dan administratif Desa Papanloe di Kecamatan Pajukukang, Kabupaten Bantaeng.
            </p>
        </div>

        <!-- Geography Info -->
        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            <!-- Location Info -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 scroll-animate fade-left">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Lokasi Geografis</h3>
                <div class="space-y-3 text-gray-600 dark:text-gray-300">
                    <p><span class="font-semibold">Kecamatan:</span> Pajukukang</p>
                    <p><span class="font-semibold">Kabupaten:</span> Bantaeng</p>
                    <p><span class="font-semibold">Provinsi:</span> Sulawesi Selatan</p>
                    <p><span class="font-semibold">Jarak ke Ibukota:</span> ±15 km dari Bantaeng</p>
                    <p><span class="font-semibold">Luas Wilayah:</span> 7,35 km²</p>
                </div>
            </div>

            <!-- Boundaries -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 scroll-animate fade-right">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Batas Wilayah</h3>
                <div class="space-y-3 text-gray-600 dark:text-gray-300">
                    <p><span class="font-semibold">Utara:</span> Desa Kaloling</p>
                    <p><span class="font-semibold">Timur:</span> Desa Layoa, Desa Baruga</p>
                    <p><span class="font-semibold">Selatan:</span> Laut Pajukukang</p>
                    <p><span class="font-semibold">Barat:</span> Desa Borong Loe</p>
                </div>
            </div>
        </div>

        <!-- Dusun Grid -->
        <div class="mb-16 scroll-animate fade-up">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 text-center">
                Tujuh Dusun di Papanloe
            </h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-slate-600 text-center">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Dusun Papanloe</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pusat Desa</p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-slate-600 text-center">
                    <div class="w-12 h-12 bg-cyan-100 dark:bg-cyan-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Dusun Kayu Loe</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pesisir</p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-slate-600 text-center">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Dusun Mawang</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pesisir</p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-slate-600 text-center">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Dusun Balla Tinggia</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Dataran Rendah</p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-slate-600 text-center">
                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Dusun Bungung Rua</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Dataran Sedang</p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-slate-600 text-center">
                    <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Dusun Bungung Pandang</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Dataran Sedang</p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-slate-600 text-center">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Dusun Sapamayo</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Dataran Rendah</p>
                </div>
            </div>
        </div>

        <!-- Topografi dan Iklim -->
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Topografi -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 scroll-animate fade-left">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Topografi Wilayah</h3>
                <div class="space-y-4 text-gray-600 dark:text-gray-300">
                    <p class="leading-relaxed">
                        Wilayah Desa Papanloe sebagian besar berupa dataran sedang dan rendah. Dusun Kayuloe, Balla Tinggia, Sapamayo dan Mawang berada di dataran rendah.
                    </p>
                    <p class="leading-relaxed">
                        Dusun Papanloe, Bungung Rua dan Bungung Pandang merupakan dataran sedang. Dua dusun pesisir (Kayu Loe dan Mawang) mayoritas berprofesi sebagai nelayan dan pembudidaya rumput laut.
                    </p>
                </div>
            </div>

            <!-- Iklim -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-slate-600 scroll-animate fade-right">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Kondisi Iklim</h3>
                <div class="space-y-4 text-gray-600 dark:text-gray-300">
                    <p class="leading-relaxed">
                        Iklim tropis dengan 3 musim: hujan, kemarau, dan pancaroba. Curah hujan sangat rendah dibanding desa lain di Kabupaten Bantaeng.
                    </p>
                    <p class="leading-relaxed">
                        Intensitas curah hujan rendah menjadi salah satu alasan strategis Desa Papanloe dijadikan Kawasan Industri Bantaeng (KIBA), dengan panen padi dan jagung hanya sekali setahun.
                    </p>
                </div>
            </div>
        </div>

        <!-- KIBA Info -->
        <div class="mt-16 bg-white rounded-3xl p-8 scroll-animate fade-scale">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Kawasan Industri Bantaeng (KIBA)
                </h3>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Hampir keseluruhan wilayah di Desa Papanloe adalah kawasan industri. Desa Papanloe menjadi titik KIBA bersama dengan Desa Borong Loe dan Desa Baruga, mengubah lanskap ekonomi dan sosial masyarakat.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection