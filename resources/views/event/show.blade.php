@extends('layouts.app')

@section('title', $event->title . ' - PII')

@push('styles')
    <style>
        .rich-content ol {
            list-style: decimal !important;
            padding-left: 1.5rem !important;
            margin: 0.75rem 0 !important;
        }

        .rich-content ul {
            list-style: disc !important;
            padding-left: 1.5rem !important;
            margin: 0.75rem 0 !important;
        }

        .rich-content li {
            display: list-item !important;
            margin: 0.25rem 0 !important;
        }
    </style>
@endpush

@section('content')
    @php
        $typeColors = [
            'seminar' => 'bg-blue-100 text-blue-800',
            'pelatihan' => 'bg-green-100 text-green-800',
            'konferensi' => 'bg-purple-100 text-purple-800',
        ];
        $typeColor = $typeColors[$event->type] ?? 'bg-orange-100 text-orange-800';
        $isPast = $event->event_date && $event->event_date->isPast();
    @endphp

    <!-- Hero Banner -->
    <section class="relative py-24 bg-gradient-to-br from-slate-900 via-orange-900 to-slate-800 overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%);"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <a href="{{ route('event.index') }}"
                class="inline-flex items-center text-orange-300 hover:text-orange-200 text-sm font-medium mb-6 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Event
            </a>
            <div class="flex flex-wrap gap-2 mb-4">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $typeColor }} capitalize">{{ $event->type }}</span>
                @if ($event->category)
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white capitalize">{{ $event->category }}</span>
                @endif
                @if ($event->sub_category)
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-500/30 text-orange-200">{{ $event->sub_category }}</span>
                @endif
                @if ($isPast)
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-500/30 text-gray-300">Selesai</span>
                @else
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500/30 text-green-300">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5 animate-pulse"></span>Akan Datang
                    </span>
                @endif
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-6">{{ $event->title }}</h1>
            <!-- Meta Info -->
            <div class="flex flex-wrap gap-6 text-gray-300 text-sm">
                @if ($event->event_date)
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $event->event_date->format('d F Y') }} &bull; {{ $event->event_date->format('H:i') }} WIB
                    </div>
                @endif
                @if ($event->location)
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $event->location }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if ($event->image)
                        <div class="mb-8 rounded-2xl overflow-hidden shadow-lg">
                            <img src="{{ Str::startsWith($event->image, ['http://', 'https://']) ? $event->image : asset($event->image) }}"
                                alt="{{ $event->title }}" class="w-full h-auto object-cover">
                        </div>
                    @endif

                    @if ($event->content)
                        <div class="rich-content prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! $event->content !!}
                        </div>
                    @elseif($event->description)
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p>{{ $event->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar: Info Card -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6 border border-orange-200 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Event</h3>
                        <div class="space-y-4">
                            @if ($event->event_date)
                                <div>
                                    <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Tanggal
                                    </div>
                                    <div class="text-gray-800 font-medium">{{ $event->event_date->format('d F Y') }}</div>
                                    <div class="text-gray-600 text-sm">{{ $event->event_date->format('H:i') }} WIB</div>
                                </div>
                            @endif
                            @if ($event->location)
                                <div>
                                    <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Lokasi
                                    </div>
                                    <div class="text-gray-800 font-medium">{{ $event->location }}</div>
                                </div>
                            @endif
                            @if ($event->type)
                                <div>
                                    <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Tipe
                                        Kegiatan</div>
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $typeColor }} capitalize">{{ $event->type }}</span>
                                </div>
                            @endif
                            @if ($event->category)
                                <div>
                                    <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Kategori
                                    </div>
                                    <div class="text-gray-800 font-medium capitalize">{{ $event->category }}</div>
                                    @if ($event->sub_category)
                                        <div class="text-gray-500 text-sm">{{ $event->sub_category }}</div>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if ($event->link && !$isPast)
                            <div class="mt-6">
                                <a href="{{ $event->link }}" target="_blank"
                                    class="block w-full text-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-md">
                                    Daftar Sekarang
                                    <svg class="w-4 h-4 ml-1 inline" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        @elseif($isPast)
                            <div class="mt-6 p-3 bg-gray-100 rounded-xl text-center text-gray-500 text-sm font-medium">
                                Pendaftaran telah ditutup</div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('event.index') }}"
                                class="block w-full text-center px-6 py-3 bg-white text-orange-600 rounded-xl font-semibold hover:bg-orange-50 transition-all duration-300 border border-orange-200">
                                Lihat Event Lainnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
