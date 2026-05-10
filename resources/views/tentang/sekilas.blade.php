@extends('layouts.app')

@section('title', 'Sekilas - PII')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-orange-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Sekilas PII</h1>
            <p class="text-xl text-orange-100">Mengenal Persatuan Insinyur Indonesia</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($sekilas)
        <div class="prose prose-lg max-w-none">
            @if($sekilas->image)
            <img src="{{ $sekilas->image }}" alt="{{ $sekilas->title }}" class="w-full rounded-2xl shadow-lg mb-8">
            @endif
            <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $sekilas->title }}</h2>
            <div class="text-gray-700 leading-relaxed">
                {!! $sekilas->content !!}
            </div>
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada data sekilas. Silakan hubungi admin untuk menambahkan konten.</p>
        </div>
        @endif
    </div>
</section>
@endsection
