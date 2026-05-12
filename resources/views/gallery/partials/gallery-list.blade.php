@php
    $isFirstPage = $galleries->currentPage() == 1;
    $skipFirst = $isFirstPage && !$category && $galleries->count() > 0;
@endphp

<!-- Gallery Grid -->
<div id="gallery-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    @foreach ($galleries as $index => $gallery)
        @if ($skipFirst && $loop->first)
            @continue
        @endif
        <div class="group bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 cursor-pointer"
            data-aos="fade-up" data-aos-delay="{{ (($loop->index - ($skipFirst ? 1 : 0)) % 3) * 100 }}"
            onclick="openLightbox({{ $loop->index }})">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ Str::startsWith($gallery->image, ['http://', 'https://']) ? $gallery->image : asset($gallery->image) }}" alt="{{ $gallery->title }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div class="flex items-center text-white">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                        <span class="font-medium">Lihat Detail</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @if($gallery->category)
                    <span class="inline-block bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-semibold capitalize mb-3">
                        {{ $gallery->category }}
                    </span>
                @endif
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-500 transition-colors line-clamp-2 leading-tight">
                    {{ $gallery->title }}
                </h3>
                @if($gallery->description)
                    <p class="text-gray-600 line-clamp-2 leading-relaxed">{{ $gallery->description }}</p>
                @endif
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div id="pagination-container" class="flex justify-center">
    {{ $galleries->links() }}
</div>
