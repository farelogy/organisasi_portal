@extends('layouts.app')

@section('title', 'Kontak - PII')

@push('styles')
<style>
    .map-embed iframe {
        width: 100% !important;
        height: 400px !important;
        display: block !important;
        border: 0 !important;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center bg-gradient-to-br from-slate-900 via-orange-900 to-slate-800 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,107,53,0.3) 0%, transparent 50%);"></div>
    </div>
    <div class="absolute top-20 left-10 w-20 h-20 bg-orange-500/20 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute top-40 right-20 w-32 h-32 bg-orange-400/10 rounded-full blur-2xl animate-pulse delay-1000"></div>
    <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-orange-600/15 rounded-full blur-xl animate-pulse delay-500"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
        <div class="text-center text-white space-y-6" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm rounded-full border border-orange-400/30">
                <span class="w-2 h-2 bg-orange-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-orange-300 text-sm font-medium">Hubungi Kami</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                <span class="block">Kontak</span>
                <span class="block bg-gradient-to-r from-orange-400 to-orange-200 bg-clip-text text-transparent">PII</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">Hubungi Persatuan Insinyur Indonesia untuk informasi, kerjasama, atau pertanyaan seputar profesi keinsinyuran</p>
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-orange-400 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-orange-400 rounded-full mt-2 animate-pulse"></div>
        </div>
    </div>
</section>

<!-- Contact Content Section -->
<section id="contact" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23FF6B35" fill-opacity="0.1"%3E%3Ccircle cx="40" cy="40" r="4" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($kontak)
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Informasi Kontak
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Jangan Ragu <span class="text-orange-500">Menghubungi</span> Kami</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Tim kami siap membantu Anda dengan segala pertanyaan terkait PII</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="100">
            <!-- Address Card -->
            <div class="bg-gradient-to-br from-white to-orange-50 rounded-3xl p-8 border border-orange-100 shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Alamat</h3>
                <p class="text-gray-600 leading-relaxed">{{ $kontak->address ?? 'Alamat belum tersedia' }}</p>
            </div>

            <!-- Phone Card -->
            <div class="bg-gradient-to-br from-white to-orange-50 rounded-3xl p-8 border border-orange-100 shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Telepon</h3>
                <p class="text-gray-600 leading-relaxed">{{ $kontak->phone ?? 'Telepon belum tersedia' }}</p>
            </div>

            <!-- Email Card -->
            <div class="bg-gradient-to-br from-white to-orange-50 rounded-3xl p-8 border border-orange-100 shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Email</h3>
                <p class="text-gray-600 leading-relaxed">{{ $kontak->email ?? 'Email belum tersedia' }}</p>
            </div>
        </div>

        <!-- Social Media -->
        <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Ikuti Kami</h3>
            <div class="flex justify-center gap-4">
                @if($kontak->facebook)
                <a href="{{ $kontak->facebook }}" target="_blank" class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center hover:bg-blue-700 transition hover:scale-110 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                @endif
                @if($kontak->twitter)
                <a href="{{ $kontak->twitter }}" target="_blank" class="w-12 h-12 bg-sky-500 text-white rounded-2xl flex items-center justify-center hover:bg-sky-600 transition hover:scale-110 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
                @endif
                @if($kontak->instagram)
                <a href="{{ $kontak->instagram }}" target="_blank" class="w-12 h-12 bg-pink-600 text-white rounded-2xl flex items-center justify-center hover:bg-pink-700 transition hover:scale-110 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                @endif
                @if($kontak->youtube)
                <a href="{{ $kontak->youtube }}" target="_blank" class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center hover:bg-red-700 transition hover:scale-110 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                </a>
                @endif
            </div>
        </div>

        <!-- Map Section -->
        @if($kontak->map_url)
        <div class="mt-20" data-aos="fade-up" data-aos-delay="300">
            <div class="text-center mb-10">
                <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Lokasi Kami
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Temukan <span class="text-orange-500">Kantor Kami</span></h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kunjungi kantor Persatuan Insinyur Indonesia untuk berdiskusi langsung dengan tim kami</p>
            </div>

            <div class="relative group max-w-5xl mx-auto">
                <!-- Decorative glow -->
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 rounded-[2rem] blur-lg opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>

                <!-- Map container -->
                <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-100 p-3">
                    <!-- Map -->
                    <div class="relative rounded-2xl overflow-hidden map-embed">
                        {!! $kontak->map_url !!}

                        <!-- Overlay card -->
                        <div class="absolute bottom-6 left-6 right-6 md:right-auto md:max-w-sm">
                            <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-gray-100 p-5">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-sm mb-1">Kantor PII</h4>
                                        <p class="text-gray-600 text-xs leading-relaxed">{{ $kontak->address ?? '' }}</p>
                                        @if($kontak->phone)
                                        <div class="flex items-center gap-1.5 mt-2 text-orange-600">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                            <span class="text-xs font-medium">{{ $kontak->phone }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @else
        <div class="text-center py-24" data-aos="fade-up">
            <div class="bg-white rounded-3xl shadow-xl p-12 border border-gray-100 max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Data Kontak</h3>
                <p class="text-gray-600 text-lg mb-6">Data kontak sedang dipersiapkan. Silakan kembali lagi nanti.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300">Kembali ke Beranda</a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
