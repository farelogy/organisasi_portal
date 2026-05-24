<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @foreach ($events as $event)
        @php
            $typeColors = [
                'seminar' => 'bg-blue-100 text-blue-700',
                'pelatihan' => 'bg-green-100 text-green-700',
                'konferensi' => 'bg-purple-100 text-purple-700',
            ];
            $typeColor = $typeColors[$event->type] ?? 'bg-orange-100 text-orange-700';
            $isPast = $event->event_date && $event->event_date->isPast();
        @endphp
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col"
            data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">

            <!-- Image + date overlay -->
            <div class="relative h-48 overflow-hidden">
                @if ($event->image)
                    <img src="{{ Str::startsWith($event->image, ['http://', 'https://']) ? $event->image : asset($event->image) }}"
                        alt="{{ $event->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div
                        class="w-full h-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif

                <!-- Dark gradient at bottom -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                <!-- Status badge top-left -->
                <div class="absolute top-3 left-3">
                    @if ($isPast)
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-700/80 text-white backdrop-blur-sm">Selesai</span>
                    @else
                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-500/90 text-white backdrop-blur-sm">
                            <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>Akan Datang
                        </span>
                    @endif
                </div>

                <!-- Type badge top-right -->
                <span
                    class="absolute top-3 right-3 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $typeColor }} backdrop-blur-sm capitalize">{{ $event->type }}</span>

                <!-- Date block bottom-left -->
                @if ($event->event_date)
                    <div
                        class="absolute bottom-3 left-3 bg-white rounded-xl px-3 py-1.5 shadow-lg text-center leading-tight">
                        <div class="text-2xl font-extrabold text-orange-500 leading-none">
                            {{ $event->event_date->format('d') }}</div>
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                            {{ $event->event_date->format('M Y') }}</div>
                    </div>
                @endif
            </div>

            <!-- Card Body -->
            <div class="flex flex-col flex-1 p-5">
                <!-- Date badge -->
                @if ($event->event_date)
                    <div class="flex items-center gap-1.5 mb-3">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-orange-500 text-white">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $event->event_date->translatedFormat('d F Y') }}
                        </span>
                    </div>
                @endif

                <!-- Category tags -->
                <div class="flex flex-wrap gap-1.5 mb-3">
                    @if ($event->category)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 capitalize">{{ $event->category }}</span>
                    @endif
                    @if ($event->sub_category)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-600">{{ $event->sub_category }}</span>
                    @endif
                </div>

                <!-- Title -->
                <h3
                    class="text-base font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors line-clamp-2 leading-snug">
                    {{ $event->title }}</h3>

                <!-- Description -->
                <p class="text-gray-500 text-sm line-clamp-2 mb-4 flex-1">{{ $event->description }}</p>

                <!-- Meta info -->
                <div class="flex flex-col gap-1.5 text-xs text-gray-500 border-t border-gray-100 pt-3 mb-4">
                    @if ($event->location)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="truncate">{{ $event->location }}</span>
                        </span>
                    @endif
                    @if ($event->event_date)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-orange-400 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $event->event_date->format('H:i') }} WIB
                        </span>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('event.show', $event->slug) }}"
                        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-orange-50 text-orange-600 rounded-xl font-semibold text-sm hover:bg-orange-100 transition-all duration-300 border border-orange-200">
                        Detail
                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    @if ($event->link && !$isPast)
                        <a href="{{ $event->link }}" target="_blank"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold text-sm hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-sm">
                            Daftar
                            <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

@if ($events instanceof \Illuminate\Contracts\Pagination\Paginator && $events->hasPages())
    <div id="pagination-container" class="flex justify-center mt-12">
        {{ $events->links() }}
    </div>
@endif
