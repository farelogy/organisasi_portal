@extends('layouts.app')

@section('title', 'Kontak - PII')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-orange-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Hubungi Kami</h1>
            <p class="text-xl text-orange-100">Kontak Persatuan Insinyur Indonesia</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($kontak)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📍</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                            <p class="text-gray-600">{{ $kontak->address }}</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📞</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                            <p class="text-gray-600">{{ $kontak->phone }}</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">✉️</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                            <p class="text-gray-600">{{ $kontak->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="font-semibold text-gray-900 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        @if($kontak->facebook)
                        <a href="{{ $kontak->facebook }}" target="_blank" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                            <span>f</span>
                        </a>
                        @endif
                        @if($kontak->twitter)
                        <a href="{{ $kontak->twitter }}" target="_blank" class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition">
                            <span>X</span>
                        </a>
                        @endif
                        @if($kontak->instagram)
                        <a href="{{ $kontak->instagram }}" target="_blank" class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition">
                            <span>IG</span>
                        </a>
                        @endif
                        @if($kontak->linkedin)
                        <a href="{{ $kontak->linkedin }}" target="_blank" class="w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center hover:bg-blue-800 transition">
                            <span>in</span>
                        </a>
                        @endif
                        @if($kontak->youtube)
                        <a href="{{ $kontak->youtube }}" target="_blank" class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition">
                            <span>YT</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Map -->
            @if($kontak->map_url)
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Lokasi</h2>
                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <iframe src="{{ $kontak->map_url }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            @endif
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada data kontak. Silakan hubungi admin untuk menambahkan konten.</p>
        </div>
        @endif
    </div>
</section>
@endsection
