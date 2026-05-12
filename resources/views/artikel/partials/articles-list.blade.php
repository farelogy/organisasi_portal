@php
    // This partial is used for AJAX pagination
    // It renders the articles grid and pagination links
    // Note: We skip the first item if it's the first page (for featured article display)
    $isFirstPage = $artikels->currentPage() == 1;
    $skipFirst = $isFirstPage && $artikels->count() > 0;
@endphp

<!-- Articles Grid -->
<div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    @foreach ($artikels as $index => $artikel)
        @if ($skipFirst && $loop->first)
            @continue
        @endif
        <article
            class="group bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100"
            data-aos="fade-up" data-aos-delay="{{ (($loop->index - ($skipFirst ? 1 : 0)) % 3) * 100 }}">
            <div class="relative h-56 overflow-hidden">
                <img src="{{ Str::startsWith($artikel->image, ['http://', 'https://']) ? $artikel->image : asset($artikel->image) }}" alt="{{ $artikel->title }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500" loading="lazy">
                <div class="absolute top-4 left-4">
                    <span
                        class="inline-block bg-gradient-to-r from-orange-500 to-orange-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg capitalize">
                        {{ str_replace('_', ' ', $artikel->category) }}
                    </span>
                </div>
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
            </div>
            <div class="p-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-600">{{ $artikel->author }}</span>
                    </div>
                    @if ($artikel->published_at)
                        <span class="text-sm text-gray-500">{{ $artikel->published_at->format('d M Y') }}</span>
                    @endif
                </div>
                <h3
                    class="text-xl font-bold text-gray-900 mb-4 group-hover:text-orange-500 transition-colors line-clamp-2 leading-tight">
                    {{ $artikel->title }}</h3>
                <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">{{ $artikel->excerpt }}</p>
                <a href="{{ route('artikel.show', $artikel->id) }}"
                    class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors group">
                    <span>Baca Selengkapnya</span>
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </article>
    @endforeach
</div>

<!-- Pagination -->
<div id="pagination-container" class="flex justify-center">
    {{ $artikels->links() }}
</div>
