@extends('layouts.app')

@section('title', 'Event & Pelatihan - PII')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center bg-gradient-to-br from-slate-900 via-orange-900 to-slate-800 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,107,53,0.3) 0%, transparent 50%);"></div>
    </div>
    <div class="absolute top-20 left-10 w-20 h-20 bg-orange-500/20 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute top-40 right-20 w-32 h-32 bg-orange-400/10 rounded-full blur-2xl animate-pulse delay-1000"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
        <div class="text-center text-white space-y-6" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm rounded-full border border-orange-400/30">
                <span class="w-2 h-2 bg-orange-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-orange-300 text-sm font-medium">Event & Pelatihan</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                <span class="block">Jadwal</span>
                <span class="block bg-gradient-to-r from-orange-400 to-orange-200 bg-clip-text text-transparent">Kegiatan PII</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">Seminar, pelatihan, dan konvensi untuk mengembangkan kompetensi insinyur Indonesia</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#events" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-orange-500/25">
                    <span>Lihat Semua Event</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </a>
            </div>
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-orange-400 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-orange-400 rounded-full mt-2 animate-pulse"></div>
        </div>
    </div>
</section>

<!-- Events Grid Section -->
<section id="events" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23FF6B35" fill-opacity="0.1"%3E%3Ccircle cx="40" cy="40" r="4" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Semua Kegiatan
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Agenda <span class="text-orange-500">Mendatang</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Daftar lengkap seminar, pelatihan, dan konvensi PII</p>
        </div>

        @if($events->total() > 0)
        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('event.index') }}" class="px-6 py-3 bg-orange-500 text-white rounded-2xl font-semibold hover:bg-orange-600 transition-all duration-300 ring-2 ring-orange-300">Semua</a>
            <a href="{{ route('event.seminar') }}" class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">Seminar</a>
            <a href="{{ route('event.pelatihan') }}" class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">Pelatihan</a>
            <a href="{{ route('event.konvensi') }}" class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">Konvensi</a>
        </div>

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
                <span class="font-medium">Memuat event...</span>
            </div>
        </div>

        @else
        <div class="text-center py-16" data-aos="fade-up">
            <div class="bg-white rounded-3xl shadow-xl p-12 border border-gray-100 max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Event</h3>
                <p class="text-gray-600 text-lg mb-6">Agenda kegiatan sedang dipersiapkan. Pantau terus halaman ini.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300">Kembali ke Beranda</a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-gradient-to-r from-orange-500 to-orange-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23FFFFFF" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="space-y-8" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Jangan Lewatkan <span class="block">Event Berikutnya</span></h2>
            <p class="text-xl text-orange-100 max-w-2xl mx-auto">Tingkatkan kompetensi dan perluas jaringan profesional Anda bersama PII</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('tentang.kontak') }}" class="inline-flex items-center px-8 py-4 bg-white text-orange-600 rounded-2xl font-semibold text-lg hover:bg-orange-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Hubungi Kami
                </a>
                <a href="{{ route('artikel.index') }}" class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <span>Baca Berita & Artikel</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>

@include('event.partials.ajax-pagination-script')
@endsection
