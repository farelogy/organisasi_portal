@extends('layouts.app')

@section('title', 'Inovasi Teknologi - PII')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-orange-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Inovasi Teknologi</h1>
            <p class="text-xl text-orange-100">Inovasi Teknologi Terbaru</p>
        </div>
    </div>
</section>

<!-- Articles Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($artikels->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($artikels as $artikel)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2">
                <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        @if($artikel->published_at)
                        <span class="text-sm text-gray-500">{{ $artikel->published_at->format('d M Y') }}</span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $artikel->title }}</h3>
                    <p class="text-gray-600 mb-2 text-sm">Oleh: {{ $artikel->author }}</p>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $artikel->excerpt }}</p>
                    <a href="{{ route('artikel.show', $artikel->id) }}" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        {{ $artikels->links() }}
        @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada inovasi teknologi. Silakan hubungi admin untuk menambahkan konten.</p>
        </div>
        @endif
    </div>
</section>
@endsection
