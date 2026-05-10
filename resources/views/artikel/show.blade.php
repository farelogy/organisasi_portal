@extends('layouts.app')

@section('title', $artikel->title . ' - PII')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-orange-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $artikel->title }}</h1>
            <p class="text-xl text-orange-100">{{ str_replace('_', ' ', $artikel->category) }}</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="w-full rounded-2xl shadow-lg mb-8">
        
        <div class="flex items-center space-x-6 mb-6">
            <div class="flex items-center text-gray-600">
                <span class="mr-2">✍️</span>
                {{ $artikel->author }}
            </div>
            @if($artikel->published_at)
            <div class="flex items-center text-gray-600">
                <span class="mr-2">📅</span>
                {{ $artikel->published_at->format('d F Y') }}
            </div>
            @endif
        </div>

        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            <p class="text-lg font-semibold text-gray-800 mb-6">{{ $artikel->excerpt }}</p>
            @if($artikel->content)
            <div>{!! $artikel->content !!}</div>
            @endif
        </div>
    </div>
</section>
@endsection
