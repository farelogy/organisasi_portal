@extends('layouts.app')

@section('title', 'Kerjasama Industri - PII')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-orange-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Kerjasama Industri</h1>
            <p class="text-xl text-orange-100">Kerjasama dengan Industri</p>
        </div>
    </div>
</section>

<!-- Kemitraan Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($kemitraans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($kemitraans as $kemitraan)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                    @if($kemitraan->logo)
                    <img src="{{ $kemitraan->logo }}" alt="{{ $kemitraan->name }}" class="w-32 h-32 object-contain bg-white rounded-xl p-4">
                    @else
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-4xl">🏭</span>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $kemitraan->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $kemitraan->description }}</p>
                    @if($kemitraan->link)
                    <a href="{{ $kemitraan->link }}" target="_blank" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition">
                        Kunjungi Website
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada kerjasama industri. Silakan hubungi admin untuk menambahkan konten.</p>
        </div>
        @endif
    </div>
</section>
@endsection
