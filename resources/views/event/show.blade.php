@extends('layouts.app')

@section('title', $event->title . ' - PII')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-orange-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $event->title }}</h1>
            <p class="text-xl text-orange-100">{{ ucfirst($event->type) }}</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($event->image)
        <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full rounded-2xl shadow-lg mb-8">
        @endif

        <div class="flex items-center space-x-6 mb-6">
            @if($event->event_date)
            <div class="flex items-center text-gray-600">
                <span class="mr-2">📅</span>
                {{ $event->event_date->format('d F Y') }}
            </div>
            @endif
            @if($event->location)
            <div class="flex items-center text-gray-600">
                <span class="mr-2">📍</span>
                {{ $event->location }}
            </div>
            @endif
        </div>

        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-8">
            <p>{{ $event->description }}</p>
            @if($event->content)
            <div class="mt-6">
                {!! $event->content !!}
            </div>
            @endif
        </div>

        @if($event->link)
        <a href="{{ $event->link }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition">
            Daftar Sekarang
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
        @endif
    </div>
</section>
@endsection
