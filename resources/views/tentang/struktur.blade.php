@extends('layouts.app')

@section('title', 'Struktur Organisasi - PII')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-orange-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Struktur Organisasi</h1>
            <p class="text-xl text-orange-100">Pimpinan Persatuan Insinyur Indonesia</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($struktur->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($struktur as $item)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                    @if($item->photo)
                    <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-4xl">👤</span>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->name }}</h3>
                    <p class="text-orange-500 font-semibold mb-3">{{ $item->position }}</p>
                    @if($item->description)
                    <p class="text-gray-600 text-sm">{{ $item->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada data struktur organisasi. Silakan hubungi admin untuk menambahkan konten.</p>
        </div>
        @endif
    </div>
</section>
@endsection
