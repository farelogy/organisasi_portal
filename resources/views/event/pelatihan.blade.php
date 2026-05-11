@extends('layouts.app')

@section('title', 'Pelatihan - PII')

@section('content')
<section class="relative py-24 bg-gradient-to-br from-slate-900 via-green-900 to-slate-800 overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 25% 25%, rgba(34,197,94,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,107,53,0.3) 0%, transparent 50%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="inline-flex items-center px-4 py-2 bg-green-500/20 backdrop-blur-sm rounded-full border border-green-400/30 mb-6">
            <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
            <span class="text-white text-sm font-medium">Event & Pelatihan</span>
        </div>
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-4">Pelatihan <span class="bg-gradient-to-r from-orange-400 to-orange-200 bg-clip-text text-transparent">PII</span></h1>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">Program pelatihan dan pengembangan kompetensi insinyur profesional</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up">
            <a href="{{ route('event.index') }}" class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">Semua</a>
            <a href="{{ route('event.seminar') }}" class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">Seminar</a>
            <a href="{{ route('event.pelatihan') }}" class="px-6 py-3 bg-orange-500 text-white rounded-2xl font-semibold hover:bg-orange-600 transition-all duration-300 ring-2 ring-orange-300">Pelatihan</a>
            <a href="{{ route('event.konvensi') }}" class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">Konvensi</a>
        </div>

        @if($events->total() > 0)
        <!-- Events Container for AJAX -->
        <div id="events-container" class="min-h-[400px]">
            @include('event.partials.events-list')
        </div>

        <!-- Loading Indicator -->
        <div id="loading-indicator" class="hidden flex justify-center py-8">
            <div class="flex items-center space-x-2 text-orange-500">
                <svg class="animate-spin h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="font-medium">Memuat pelatihan...</span>
            </div>
        </div>
        @else
        <div class="text-center py-16">
            <div class="bg-white rounded-3xl shadow-xl p-12 border border-gray-100 max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6 text-4xl">🎓</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Pelatihan</h3>
                <p class="text-gray-600 mb-6">Jadwal pelatihan sedang dipersiapkan.</p>
                <a href="{{ route('event.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold">Lihat Semua Event</a>
            </div>
        </div>
        @endif
    </div>
</section>

@include('event.partials.ajax-pagination-script')
@endsection
