@extends('layouts.app')

@section('title', 'Kemitraan - PII')

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
                <span class="text-orange-300 text-sm font-medium">Kemitraan & Kolaborasi</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                <span class="block">Partner</span>
                <span class="block bg-gradient-to-r from-orange-400 to-orange-200 bg-clip-text text-transparent">PII Indonesia</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">Kolaborasi strategis dengan universitas, industri, dan institusi pemerintah untuk pengembangan teknologi dan profesionalisme</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#kemitraans" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-orange-500/25">
                    <span>Lihat Semua Partner</span>
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

<!-- Kemitraan Section -->
<section id="kemitraans" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23FF6B35" fill-opacity="0.1"%3E%3Ccircle cx="40" cy="40" r="4" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21v-8m0 0l-4-4m4 4l4-4m0 0V3"></path></svg>
                Semua Mitra
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Network <span class="text-orange-500">Kolaborasi</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Bergabunglah dengan ribuan mitra yang bekerja sama dengan Persatuan Insinyur Indonesia</p>
        </div>

        @if($kemitraans->count() > 0)
        <!-- Category Filter - Floating Glass Card -->
        <div class="flex justify-center px-4 -mt-8 relative z-10 mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="backdrop-blur-xl bg-white/90 rounded-3xl shadow-2xl border border-white/20 p-1.5 inline-flex flex-wrap justify-center gap-1.5" style="background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,247,237,0.95) 100%);">
                <a href="{{ route('kemitraan.index') }}" class="flex items-center gap-2 px-5 sm:px-6 py-3 rounded-2xl text-sm font-bold transition-all duration-300 bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg shadow-orange-300/50 ring-2 ring-orange-400/30 whitespace-nowrap hover:shadow-orange-400/60 hover:scale-105">🌐 Semua</a>
                <a href="{{ route('kemitraan.kampus') }}" class="flex items-center gap-2 px-5 sm:px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-600 hover:bg-gradient-to-r hover:from-blue-50 hover:to-blue-100 hover:text-blue-700 hover:shadow-md hover:scale-105 whitespace-nowrap">🎓 Kampus</a>
                <a href="{{ route('kemitraan.industri') }}" class="flex items-center gap-2 px-5 sm:px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-600 hover:bg-gradient-to-r hover:from-orange-50 hover:to-orange-100 hover:text-orange-700 hover:shadow-md hover:scale-105 whitespace-nowrap">🏭 Industri</a>
                <a href="{{ route('kemitraan.pemerintah') }}" class="flex items-center gap-2 px-5 sm:px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 hover:text-red-700 hover:shadow-md hover:scale-105 whitespace-nowrap">🏛️ Pemerintah</a>
            </div>
        </div>

        <!-- Kemitraan Grid - Logo Only -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($kemitraans as $kemitraan)
            <a href="{{ $kemitraan->link ?? '#' }}" target="_blank" class="group">
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 aspect-square flex items-center justify-center p-6"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                    @if($kemitraan->logo)
                    <img src="{{ $kemitraan->logo }}" alt="{{ $kemitraan->name }}"
                         class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300"
                         title="{{ $kemitraan->name }}">
                    @else
                    <div class="text-6xl">🤝</div>
                    @endif
                </div>
                <p class="mt-3 text-center text-sm font-medium text-gray-700 group-hover:text-orange-600 transition-colors truncate">{{ $kemitraan->name }}</p>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-16" data-aos="fade-up">
            <div class="bg-white rounded-3xl shadow-xl p-12 border border-gray-100 max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21v-8m0 0l-4-4m4 4l4-4m0 0V3"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Mitra</h3>
                <p class="text-gray-600 text-lg mb-6">Daftar mitra sedang dipersiapkan. Pantau terus halaman ini.</p>
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

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Tertarik Berkolaborasi?</h2>
        <p class="text-xl text-orange-100 max-w-3xl mx-auto mb-8">Hubungi PII Indonesia untuk peluang kerjasama yang menguntungkan</p>
        <a href="{{ route('tentang.kontak') }}" class="inline-flex items-center px-8 py-4 bg-white text-orange-600 rounded-2xl font-semibold text-lg hover:bg-orange-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
            <span>Hubungi Kami</span>
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>
</section>
@endsection

