@extends('layouts.app')

@section('title', 'Program Pemerintah - PII')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[50vh] flex items-center bg-gradient-to-br from-slate-900 via-red-900 to-slate-800 overflow-hidden pb-16">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(239,68,68,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(239,68,68,0.3) 0%, transparent 50%);"></div>
    </div>
    <div class="absolute top-20 left-10 w-20 h-20 bg-red-500/20 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute top-40 right-20 w-32 h-32 bg-red-400/10 rounded-full blur-2xl animate-pulse delay-1000"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        <div class="text-center text-white space-y-6" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-red-500/20 backdrop-blur-sm rounded-full border border-red-400/30">
                <span class="w-2 h-2 bg-red-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-red-300 text-sm font-medium">Kerjasama Publik</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                <span class="block">Program</span>
                <span class="block bg-gradient-to-r from-red-400 to-red-200 bg-clip-text text-transparent">Pemerintah</span>
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto">Kolaborasi dengan institusi pemerintah untuk pembangunan berkelanjutan dan inovasi nasional</p>
        </div>
    </div>
</section>

<!-- Category Filter - Floating Glass Card -->
<section class="relative z-10">
    <div class="flex justify-center px-4 -mt-8">
        <div class="backdrop-blur-xl bg-white/90 rounded-3xl shadow-2xl border border-white/20 p-1.5 inline-flex flex-wrap justify-center gap-1.5" style="background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(254,242,242,0.95) 100%);">
            <a href="{{ route('kemitraan.index') }}" class="flex items-center gap-2 px-5 sm:px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 hover:text-red-700 hover:shadow-md hover:scale-105 whitespace-nowrap">🌐 Semua</a>
            <a href="{{ route('kemitraan.kampus') }}" class="flex items-center gap-2 px-5 sm:px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 hover:text-red-700 hover:shadow-md hover:scale-105 whitespace-nowrap">🎓 Kampus</a>
            <a href="{{ route('kemitraan.industri') }}" class="flex items-center gap-2 px-5 sm:px-6 py-3 rounded-2xl text-sm font-semibold transition-all duration-300 text-gray-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 hover:text-red-700 hover:shadow-md hover:scale-105 whitespace-nowrap">🏭 Industri</a>
            <a href="{{ route('kemitraan.pemerintah') }}" class="flex items-center gap-2 px-5 sm:px-6 py-3 rounded-2xl text-sm font-bold transition-all duration-300 bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg shadow-red-300/50 ring-2 ring-red-400/30 whitespace-nowrap hover:shadow-red-400/60 hover:scale-105">🏛️ Pemerintah</a>
        </div>
    </div>
</section>

<!-- Kemitraan Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($kemitraans->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($kemitraans as $kemitraan)
            <a href="{{ route('kemitraan.show', $kemitraan->slug) }}" class="group">
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 aspect-square flex items-center justify-center p-6"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                    @if($kemitraan->logo)
                    <img src="{{ Str::startsWith($kemitraan->logo, ['http://', 'https://']) ? $kemitraan->logo : asset($kemitraan->logo) }}" alt="{{ $kemitraan->name }}"
                         class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300"
                         title="{{ $kemitraan->name }}">
                    @else
                    <div class="text-6xl">🏛️</div>
                    @endif
                </div>
                <p class="mt-3 text-center text-sm font-medium text-gray-700 group-hover:text-red-600 transition-colors truncate">{{ $kemitraan->name }}</p>
            </a>
            @endforeach
        </div>

        @if($kemitraans->hasPages())
        <div class="mt-12 flex justify-center" data-aos="fade-up">
            {{ $kemitraans->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada program pemerintah. Silakan hubungi admin untuk menambahkan konten.</p>
        </div>
        @endif
    </div>
</section>
@endsection
