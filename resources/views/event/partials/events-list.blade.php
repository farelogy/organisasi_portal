<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
@foreach($events as $event)
@php
    $typeColors = ['seminar' => 'bg-blue-100 text-blue-800', 'pelatihan' => 'bg-green-100 text-green-800', 'konvensi' => 'bg-purple-100 text-purple-800'];
    $typeColor = $typeColors[$event->type] ?? 'bg-orange-100 text-orange-800';
    $isPast = $event->event_date && $event->event_date->isPast();
@endphp
<div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
    <div class="flex flex-col md:flex-row">
        <!-- Date Badge -->
        <div class="flex-shrink-0 flex items-center justify-center bg-gradient-to-br from-orange-500 to-orange-600 text-white p-6 md:w-36 md:flex-col">
            @if($event->event_date)
            <div class="text-center">
                <div class="text-3xl font-bold leading-none">{{ $event->event_date->format('d') }}</div>
                <div class="text-sm font-semibold uppercase tracking-wide mt-1">{{ $event->event_date->format('M') }}</div>
                <div class="text-xs opacity-80 mt-1">{{ $event->event_date->format('Y') }}</div>
            </div>
            @else
            <div class="text-4xl">📅</div>
            @endif
        </div>

        @if($event->image)
        <div class="flex-shrink-0 w-full md:w-32 h-32 overflow-hidden">
            <img src="{{ Str::startsWith($event->image, ['http://', 'https://']) ? $event->image : asset($event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        @endif

        <!-- Content -->
        <div class="flex-1 p-6 md:p-8 flex flex-col justify-between">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $typeColor }} capitalize">{{ $event->type }}</span>
                    @if($event->category)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 capitalize">{{ $event->category }}</span>
                    @endif
                    @if($event->sub_category)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-600">{{ $event->sub_category }}</span>
                    @endif
                    @if($isPast)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-500">Selesai</span>
                    @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>Akan Datang
                    </span>
                    @endif
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">{{ $event->title }}</h3>
                <p class="text-gray-600 line-clamp-2 text-sm md:text-base">{{ $event->description }}</p>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 gap-3">
                <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                    @if($event->location)
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $event->location }}
                    </span>
                    @endif
                    @if($event->event_date)
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $event->event_date->format('H:i') }} WIB
                    </span>
                    @endif
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('event.show', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-orange-50 text-orange-600 rounded-xl font-semibold text-sm hover:bg-orange-100 transition-all duration-300">
                        Detail
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    @if($event->link && !$isPast)
                    <a href="{{ $event->link }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold text-sm hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-md">
                        Daftar
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>

@if($events instanceof \Illuminate\Contracts\Pagination\Paginator && $events->hasPages())
<div id="pagination-container" class="flex justify-center mt-12">
    {{ $events->links() }}
</div>
@endif
