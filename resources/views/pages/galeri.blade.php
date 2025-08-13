@extends('layouts.home')

@section('title', 'Galeri Desa Papanloe')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-50 via-white to-green-50">    
    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 py-32 text-center">
        <div class="hero-content fade-up">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-white text-blue-700 rounded-full text-sm font-semibold mb-6 border border-blue-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Dokumentasi Visual Desa
            </div>
            
            <!-- Main Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Galeri
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-600">
                    Desa Papanloe
                </span>
            </h1>
            
            <!-- Description -->
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Jelajahi keindahan dan kehidupan Desa Papanloe melalui koleksi foto dan video dokumentasi berbagai aspek kehidupan masyarakat.
            </p>
            
            <!-- Quick Stats -->
            <div class="flex items-center justify-center space-x-8 text-sm text-gray-600">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>36+ Foto</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span>15+ Video</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span>8 Kategori</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Categories Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Kategori Galeri
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Pilih kategori untuk melihat koleksi foto dan video dokumentasi
            </p>
        </div>
        
        <!-- Category Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Jagung -->
            <div class="gallery-category group cursor-pointer" data-category="Jagung">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[4/3] bg-gradient-to-br from-yellow-400 to-orange-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl mb-2">🌽</div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">9 Foto • 2 Video</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-center group-hover:text-yellow-600 transition-colors">Jagung</h3>
                    </div>
                </div>
            </div>

            <!-- Kantor Desa -->
            <div class="gallery-category group cursor-pointer" data-category="Kantor Desa">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[4/3] bg-gradient-to-br from-blue-500 to-indigo-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl mb-2">🏢</div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">1 Foto • 2 Video</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-center group-hover:text-blue-600 transition-colors">Kantor Desa</h3>
                    </div>
                </div>
            </div>

            <!-- Padang Rumput -->
            <div class="gallery-category group cursor-pointer" data-category="Padang Rumput">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[4/3] bg-gradient-to-br from-green-400 to-emerald-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl mb-2">🌿</div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">4 Foto • 2 Video</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-center group-hover:text-green-600 transition-colors">Padang Rumput</h3>
                    </div>
                </div>
            </div>

            <!-- Perusahaan -->
            <div class="gallery-category group cursor-pointer" data-category="Perusahaan">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[4/3] bg-gradient-to-br from-gray-600 to-slate-700 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl mb-2">🏭</div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">7 Foto • 2 Video</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-center group-hover:text-gray-600 transition-colors">Perusahaan</h3>
                    </div>
                </div>
            </div>

            <!-- Rumput Laut -->
            <div class="gallery-category group cursor-pointer" data-category="Rumput Laut">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[4/3] bg-gradient-to-br from-cyan-500 to-teal-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl mb-2">🌊</div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">2 Foto • 1 Video</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-center group-hover:text-cyan-600 transition-colors">Rumput Laut</h3>
                    </div>
                </div>
            </div>

            <!-- Sawah -->
            <div class="gallery-category group cursor-pointer" data-category="Sawah">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[4/3] bg-gradient-to-br from-lime-500 to-green-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl mb-2">🌾</div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">5 Foto • 2 Video</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-center group-hover:text-lime-600 transition-colors">Sawah</h3>
                    </div>
                </div>
            </div>

            <!-- SD -->
            <div class="gallery-category group cursor-pointer" data-category="SD">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[4/3] bg-gradient-to-br from-pink-500 to-rose-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl mb-2">🏫</div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">2 Foto • 2 Video</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-center group-hover:text-pink-600 transition-colors">SD</h3>
                    </div>
                </div>
            </div>

            <!-- SMP -->
            <div class="gallery-category group cursor-pointer" data-category="SMP">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[4/3] bg-gradient-to-br from-purple-500 to-violet-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl mb-2">🎓</div>
                                <div class="text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full">6 Foto • 2 Video</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-center group-hover:text-purple-600 transition-colors">SMP</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Content Section -->
<section id="gallery-content" class="py-16 bg-gray-50" style="display: none;">
    <div class="container mx-auto px-4">
        <!-- Category Header -->
        <div class="text-center mb-8">
            <button id="back-to-categories" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold mb-4 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Kategori
            </button>
            <h2 id="category-title" class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"></h2>
            <p class="text-lg text-gray-600">Koleksi foto dan video</p>
        </div>
        
        <!-- Tab Navigation -->
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg p-1 shadow-lg border border-gray-200">
                <button id="photos-tab" class="tab-button active px-6 py-2 rounded-md text-sm font-semibold transition-all duration-200">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Foto
                </button>
                <button id="videos-tab" class="tab-button px-6 py-2 rounded-md text-sm font-semibold transition-all duration-200">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Video
                </button>
            </div>
        </div>
        
        <!-- Photos Grid -->
        <div id="photos-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Photos will be loaded here dynamically -->
        </div>
        
        <!-- Videos Grid -->
        <div id="videos-grid" class="grid grid-cols-1 lg:grid-cols-3 gap-6" style="display: none;">
            <!-- Videos will be loaded here dynamically -->
            <!-- Layout: Video Utama spans full width, other videos in smaller cards below -->
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center" style="display: none;">
    <div class="relative max-w-7xl max-h-screen p-4">
        <button id="close-lightbox" class="absolute -top-2 -right-2 w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <img id="lightbox-image" class="max-w-full max-h-full object-contain rounded-lg" src="" alt="">
        <div id="lightbox-caption" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-75 text-white px-4 py-2 rounded-lg text-center">
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.tab-button.active {
    background-color: #3b82f6;
    color: white;
    box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
}

.tab-button:not(.active) {
    color: #6b7280;
}

.tab-button:not(.active):hover {
    background-color: #f3f4f6;
    color: #374151;
}

.gallery-item {
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.05);
}

.video-thumbnail {
    position: relative;
}

.video-thumbnail::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 50%;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 24 24'%3E%3Cpath d='M8 5v14l11-7z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 24px;
}
</style>
@endpush

@push('scripts')
<script>
// Gallery data structure based on your folder structure
const galleryData = {
    'Jagung': {
        photos: 9,
        videos: ['Video Utama', 'Video Pendamping']
    },
    'Kantor Desa': {
        photos: 1,
        videos: ['Video Utama', 'Video Pendamping']
    },
    'Padang Rumput': {
        photos: 4,
        videos: ['Video Utama', 'Video Pendamping']
    },
    'Perusahaan': {
        photos: 7,
        videos: ['Video Utama', 'Video Pendamping']
    },
    'Rumput Laut': {
        photos: 2,
        videos: ['Video Utama']
    },
    'Sawah': {
        photos: 5,
        videos: ['Video Utama', 'Video Pendamping']
    },
    'SD': {
        photos: 2,
        videos: ['Video Utama', 'Video Pendamping']
    },
    'SMP': {
        photos: 6,
        videos: ['Video Utama', 'Video Pendamping']
    }
};

let currentCategory = '';

// Category click handlers
document.querySelectorAll('.gallery-category').forEach(category => {
    category.addEventListener('click', function() {
        const categoryName = this.dataset.category;
        showCategory(categoryName);
    });
});

// Tab click handlers
document.getElementById('photos-tab').addEventListener('click', () => showPhotos());
document.getElementById('videos-tab').addEventListener('click', () => showVideos());

// Back to categories
document.getElementById('back-to-categories').addEventListener('click', () => {
    document.querySelector('#gallery-content').style.display = 'none';
    document.querySelector('section:nth-child(2)').scrollIntoView({ behavior: 'smooth' });
});

// Lightbox handlers
document.getElementById('close-lightbox').addEventListener('click', closeLightbox);
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});

function showCategory(categoryName) {
    currentCategory = categoryName;
    document.getElementById('category-title').textContent = categoryName;
    document.querySelector('#gallery-content').style.display = 'block';
    document.querySelector('#gallery-content').scrollIntoView({ behavior: 'smooth' });
    
    // Reset tabs
    document.getElementById('photos-tab').classList.add('active');
    document.getElementById('videos-tab').classList.remove('active');
    
    showPhotos();
}

function showPhotos() {
    document.getElementById('photos-tab').classList.add('active');
    document.getElementById('videos-tab').classList.remove('active');
    document.getElementById('photos-grid').style.display = 'grid';
    document.getElementById('videos-grid').style.display = 'none';
    
    loadPhotos();
}

function showVideos() {
    document.getElementById('photos-tab').classList.remove('active');
    document.getElementById('videos-tab').classList.add('active');
    document.getElementById('photos-grid').style.display = 'none';
    document.getElementById('videos-grid').style.display = 'grid';
    
    loadVideos();
}

function loadPhotos() {
    const photosGrid = document.getElementById('photos-grid');
    const categoryData = galleryData[currentCategory];
    
    photosGrid.innerHTML = '';
    
    for (let i = 1; i <= categoryData.photos; i++) {
        const photoElement = document.createElement('div');
        photoElement.className = 'gallery-item bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300';
        photoElement.innerHTML = `
            <div class="aspect-[4/3] bg-gray-200 overflow-hidden">
                <img src="{{ asset('img/${currentCategory}/Foto ${i}.jpg') }}" 
                     alt="${currentCategory} - Foto ${i}" 
                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-300"
                     onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
            </div>
            <div class="p-3">
                <h4 class="font-semibold text-gray-900 text-sm">Foto ${i}</h4>
                <p class="text-xs text-gray-600">${currentCategory}</p>
            </div>
        `;
        
        photoElement.addEventListener('click', () => {
            openLightbox(`{{ asset('img/${currentCategory}/Foto ${i}.jpg') }}`, `${currentCategory} - Foto ${i}`);
        });
        
        photosGrid.appendChild(photoElement);
    }
}

function loadVideos() {
    const videosGrid = document.getElementById('videos-grid');
    const categoryData = galleryData[currentCategory];
    
    videosGrid.innerHTML = '';
    
    // Check if there's a main video (Video Utama)
    const hasMainVideo = categoryData.videos.includes('Video Utama');
    const otherVideos = categoryData.videos.filter(video => video !== 'Video Utama');
    
    if (hasMainVideo) {
        // Create featured video section
        const featuredSection = document.createElement('div');
        featuredSection.className = 'col-span-1 md:col-span-2 lg:col-span-3';
        featuredSection.innerHTML = `
            <div class="bg-white rounded-2xl overflow-hidden shadow-xl border-2 border-blue-200 relative">
                <!-- Featured Badge -->
                <div class="absolute top-4 left-4 z-10">
                    <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Video Utama
                    </span>
                </div>
                
                <!-- Main Video -->
                <div class="aspect-video bg-gray-900 relative group">
                    <video class="w-full h-full object-cover" controls poster="{{ asset('img/${currentCategory}/Foto 1.jpg') }}">
                        <source src="{{ asset('video/${currentCategory}/Video Utama.mp4') }}" type="video/mp4">
                        <source src="{{ asset('video/${currentCategory}/Video Utama.webm') }}" type="video/webm">
                        Browser Anda tidak mendukung tag video.
                    </video>
                    
                    <!-- Video Overlay Info -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6">
                        <div class="text-white">
                            <h3 class="text-2xl font-bold mb-2">Video Utama - ${currentCategory}</h3>
                            <p class="text-gray-300 text-sm">Dokumentasi utama dari ${currentCategory}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
        videosGrid.appendChild(featuredSection);
    }
    
    // Add other videos if any
    if (otherVideos.length > 0) {
        otherVideos.forEach((videoName, index) => {
            const videoElement = document.createElement('div');
            videoElement.className = 'bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1';
            videoElement.innerHTML = `
                <div class="aspect-video bg-gray-900 relative group">
                    <video class="w-full h-full object-cover" controls>
                        <source src="{{ asset('video/${currentCategory}/${videoName}.mp4') }}" type="video/mp4">
                        <source src="{{ asset('video/${currentCategory}/${videoName}.webm') }}" type="video/webm">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-semibold text-gray-900">${videoName}</h4>
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">
                            ${index + 1}/${otherVideos.length}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600">${currentCategory}</p>
                </div>
            `;
            videosGrid.appendChild(videoElement);
        });
    }
}

function openLightbox(imageSrc, caption) {
    document.getElementById('lightbox-image').src = imageSrc;
    document.getElementById('lightbox-caption').textContent = caption;
    document.getElementById('lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Keyboard navigation for lightbox
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('lightbox').style.display === 'flex') {
        closeLightbox();
    }
});
</script>
@endpush