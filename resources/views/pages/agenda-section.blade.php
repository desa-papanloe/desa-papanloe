{{-- resources/views/pages/agenda-section.blade.php --}}
{{-- Partial template untuk AJAX updates - FIXED --}}

<div class="container mx-auto px-4">
    <!-- Results Info -->
    @if(isset($agenda) && method_exists($agenda, 'total') && $agenda->total() > 0)
    <div class="mb-8 results-info">
        <p class="text-gray-600">
            Menampilkan {{ $agenda->firstItem() ?? 0 }}-{{ $agenda->lastItem() ?? 0 }} dari {{ $agenda->total() }} agenda
            @if(request('search'))
            untuk "<strong>{{ request('search') }}</strong>"
            @endif
            @if(request('kategori') && isset($categories))
            dalam kategori "<strong>{{ $categories[request('kategori')] ?? request('kategori') }}</strong>"
            @endif
        </p>
    </div>
    @endif

    <!-- Agenda Grid - Will be styled by JavaScript based on view mode -->
    <div id="agendaGrid" class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
        @if(isset($agenda) && count($agenda) > 0)
            @foreach($agenda as $item)
            <div class="agenda-card bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 group">
                <!-- Card Header with Image -->
                <div class="relative h-48 overflow-hidden">
                    @if($item->featured_image_url)
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110" 
                         style="background-image: url('{{ $item->featured_image_url }}');"></div>
                    @else
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-500"></div>
                    @endif
                    
                    <!-- Date Badge -->
                    <div class="absolute bottom-4 left-4">
                        <div class="bg-white/95 backdrop-blur-sm rounded-xl p-3 text-center shadow-lg">
                            <div class="text-2xl font-bold text-gray-900">{{ $item->tanggal_mulai->format('d') }}</div>
                            <div class="text-xs font-semibold text-gray-600 uppercase">{{ $item->tanggal_mulai->format('M') }}</div>
                        </div>
                    </div>
                    
                    <!-- Category & Priority Badges -->
                    <div class="absolute top-4 left-4 right-4 flex justify-between">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-purple-600 text-xs font-bold rounded-full">
                            {{ $item->kategori_label ?? ucfirst($item->kategori) }}
                        </span>
                        @if($item->prioritas === 'urgent' || $item->prioritas === 'tinggi')
                        <span class="px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-full">
                            {{ $item->prioritas === 'urgent' ? 'URGENT' : 'PENTING' }}
                        </span>
                        @endif
                    </div>
                </div>
                
                <!-- Card Content -->
                <div class="p-6">
                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                        {{ $item->judul }}
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $item->deskripsi }}
                    </p>
                    
                    <!-- Event Details -->
                    <div class="space-y-2 mb-4">
                        <!-- Date & Time -->
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $item->tanggal_mulai->format('d M Y') }}
                            @if($item->waktu_mulai)
                            <span class="ml-2">• {{ date('H:i', strtotime($item->waktu_mulai)) }}</span>
                            @endif
                        </div>
                        
                        <!-- Location -->
                        @if($item->tempat)
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            {{ $item->tempat }}
                        </div>
                        @endif
                        
                        <!-- Organizer -->
                        @if($item->penyelenggara)
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            {{ $item->penyelenggara }}
                        </div>
                        @endif
                    </div>
                    
                    <!-- Action Button - FIXED URL GENERATION -->
                    @php
                        // Generate URL safely
                        $detailUrl = '#';
                        try {
                            if ($item && $item->slug) {
                                $detailUrl = route('agenda.show', ['slug' => $item->slug]);
                            }
                        } catch (\Exception $e) {
                            $detailUrl = url('/agenda/' . ($item->slug ?? 'error'));
                        }
                    @endphp
                    
                    <a href="{{ $detailUrl }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span>Lihat Detail</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        @else
        <!-- Empty State -->
        <div class="col-span-full text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Agenda</h3>
                <p class="text-gray-500 mb-6">
                    @if(request('search') || request('kategori'))
                    Tidak ada agenda yang sesuai dengan pencarian Anda.
                    @else
                    Saat ini belum ada agenda yang tersedia.
                    @endif
                </p>
                @if(request('search') || request('kategori'))
                <a href="{{ route('agenda.index') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-colors">
                    Lihat Semua Agenda
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Pagination -->
    @if(isset($agenda) && method_exists($agenda, 'hasPages') && $agenda->hasPages())
    <div class="mt-12 pagination-wrapper">
        <div class="flex justify-center">
            {{ $agenda->links() }}
        </div>
    </div>
    @endif
</div>