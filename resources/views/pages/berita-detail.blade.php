@extends('layouts.home')

@section('title', $berita->judul . ' - ' . config('app.name'))
@section('description', $berita->meta_description ?: Str::limit(strip_tags($berita->excerpt), 155))
@section('keywords', $berita->meta_keywords)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/detail-berita.css') }}">
@endpush

@section('content')
<!-- Breadcrumb -->
<section class="bg-gray-100 pt-[7rem] pb-5 breadcrumb-section">
    <div class="container mx-auto px-4">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Beranda</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('berita.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Berita</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900 font-medium">{{ Str::limit($berita->judul, 50) }}</span>
        </nav>
    </div>
</section>

<!-- Main Content -->
<main class="pt-24 pb-8 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article Content -->
            <article class="lg:col-span-2">
                <!-- Article Header -->
                <header class="mb-8">
                    <!-- Category Badge -->
                    <div class="mb-4">
                        <span class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            {{ $berita->kategori_label }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight mb-6">
                        {{ $berita->judul }}
                    </h1>

                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600 mb-8">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <time datetime="{{ $berita->created_at->toISOString() }}">
                                {{ $berita->created_at->format('d F Y, H:i') }} WIB
                            </time>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>
                                @if($berita->admin)
                                    {{ $berita->admin->name }}
                                @else
                                    Admin Desa
                                @endif
                            </span>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span>{{ $berita->views }} views</span>
                        </div>
                    </div>

                    <!-- Social Share -->
                    <div class="flex items-center justify-between bg-gray-50 rounded-lg p-4">
                        <span class="text-sm font-medium text-gray-700">Bagikan artikel ini:</span>
                        <div class="flex items-center space-x-3">
                            <button onclick="shareToFacebook()" class="share-btn facebook" title="Bagikan ke Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </button>
                            <button onclick="shareToTwitter()" class="share-btn twitter" title="Bagikan ke Twitter">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </button>
                            <button onclick="shareToWhatsApp()" class="share-btn whatsapp" title="Bagikan ke WhatsApp">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </button>
                            <button onclick="copyLink()" class="share-btn copy" title="Salin tautan">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </header>

                <!-- Excerpt Section -->
                @if($berita->excerpt)
                <div class="mb-8 p-6 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                    <p class="text-lg text-gray-700 leading-relaxed italic">
                        {{ $berita->excerpt }}
                    </p>
                </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-p:leading-relaxed prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline prose-strong:text-gray-900 prose-blockquote:border-blue-500 prose-blockquote:bg-blue-50 prose-blockquote:rounded-r-lg">
                    {!! $berita->konten !!}
                </div>

                <!-- Tags (if you have tags) -->
                @if($berita->meta_keywords)
                <section class="mt-8 pt-8 border-t border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Tag:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $berita->meta_keywords) as $tag)
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors">
                            {{ trim($tag) }}
                        </span>
                        @endforeach
                    </div>
                </section>
                @endif
            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Related Articles -->
                @if($relatedBerita && $relatedBerita->count() > 0)
                <section class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Berita Terkait
                    </h3>
                    <div class="space-y-4">
                        @foreach($relatedBerita as $related)
                        <article class="group border-b border-gray-100 last:border-b-0 pb-4 last:pb-0">
                            <a href="{{ route('berita.show', $related->slug) }}" class="block">
                                <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors text-sm leading-tight mb-2">
                                    {{ Str::limit($related->judul, 80) }}
                                </h4>
                                <div class="flex items-center text-xs text-gray-500 mb-2">
                                    <time>{{ $related->created_at->format('d M Y') }}</time>
                                    <span class="mx-2">•</span>
                                    <span>{{ $related->views }} views</span>
                                    <span class="mx-2">•</span>
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs">
                                        {{ $related->kategori_label }}
                                    </span>
                                </div>
                                @if($related->excerpt)
                                <p class="text-xs text-gray-600 line-clamp-2">
                                    {{ Str::limit($related->excerpt, 100) }}
                                </p>
                                @endif
                            </a>
                        </article>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Latest News -->
                <section class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Berita Terbaru
                    </h3>
                    
                    <div id="latest-news" class="space-y-4">
                        <!-- Latest news will be loaded via AJAX -->
                        <div class="animate-pulse space-y-4">
                            @for($i = 0; $i < 3; $i++)
                            <div class="border-b border-blue-200 last:border-b-0 pb-3 last:pb-0">
                                <div class="h-4 bg-gray-300 rounded mb-2"></div>
                                <div class="h-3 bg-gray-300 rounded w-2/3"></div>
                            </div>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-blue-200">
                        <a href="{{ route('berita.index') }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                            Lihat Semua Berita
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </section>
            </aside>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('js/berita-detail.js') }}"></script>
@endpush