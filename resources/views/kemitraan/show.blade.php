@extends('layouts.app')

@section('title', $kemitraan->name . ' - Kemitraan PII')

@section('meta')
    <meta property="og:title" content="{{ $kemitraan->name }} | {{ $site_settings['site_title'] ?? 'PII - Persatuan Insinyur Indonesia' }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($kemitraan->description ?: $kemitraan->content ?: ''), 150) }}">
    <meta property="og:image" content="{{ Str::startsWith($kemitraan->logo, ['http://', 'https://']) ? $kemitraan->logo : asset($kemitraan->logo) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')
    <!-- Hero Header with Gradient -->
    <section class="relative min-h-[45vh] flex items-center bg-gradient-to-br from-slate-900 via-orange-950 to-slate-800 overflow-hidden py-16">
        <!-- Floating Decorative Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%);"></div>
        </div>
        <div class="absolute top-20 left-10 w-24 h-24 bg-orange-500/20 rounded-full blur-2xl animate-pulse"></div>
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10" data-aos="fade-up">
            <a href="{{ route('kemitraan.index') }}"
                class="inline-flex items-center text-orange-300 hover:text-orange-200 text-sm font-medium mb-6 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Kemitraan
            </a>
            
            <div class="flex flex-col md:flex-row md:items-center gap-8">
                <!-- Logo Frame -->
                <div class="w-32 h-32 md:w-40 md:h-40 bg-white rounded-3xl p-6 shadow-2xl flex items-center justify-center border border-white/20 flex-shrink-0">
                    @if($kemitraan->logo)
                        <img src="{{ Str::startsWith($kemitraan->logo, ['http://', 'https://']) ? $kemitraan->logo : asset($kemitraan->logo) }}" alt="{{ $kemitraan->name }}" class="max-w-full max-h-full object-contain">
                    @else
                        <span class="text-5xl">🤝</span>
                    @endif
                </div>
                
                <div class="space-y-4">
                    <span class="inline-block bg-orange-500/20 backdrop-blur-sm text-orange-300 text-xs px-3 py-1.5 rounded-full font-semibold border border-orange-400/30 uppercase tracking-wider">
                        {{ str_replace('_', ' ', $kemitraan->type) }}
                    </span>
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight">
                        {{ $kemitraan->name }}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Detail Content Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center text-sm text-gray-500 mb-8" data-aos="fade-up">
                <a href="{{ route('home') }}" class="hover:text-orange-500 transition">Beranda</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('kemitraan.index') }}" class="hover:text-orange-500 transition">Kemitraan</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-orange-500 font-medium">{{ $kemitraan->name }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Description -->
                <div class="lg:col-span-2 space-y-8" data-aos="fade-up">
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Profil Mitra</h3>
                        <p class="text-lg text-gray-600 mb-6">{{ $kemitraan->description }}</p>
                        
                        @if ($kemitraan->content)
                            <div class="mt-6 border-t border-gray-100 pt-6">
                                {!! $kemitraan->content !!}
                            </div>
                        @endif
                    </div>

                    <!-- Share Section -->
                    <div class="pt-8 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <span class="text-gray-600 font-medium">Bagikan kemitraan ini:</span>
                            <div class="flex gap-3">
                                <button onclick="shareFacebook()"
                                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition text-white">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </button>
                                <button onclick="shareTwitter()"
                                    class="w-10 h-10 bg-sky-500 rounded-full flex items-center justify-center hover:bg-sky-600 transition text-white">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                </button>
                                <button onclick="shareLinkedIn()"
                                    class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center hover:bg-blue-800 transition text-white">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </button>
                                <button onclick="copyLink()"
                                    class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center hover:bg-gray-700 transition text-white"
                                    title="Copy Link">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Card -->
                <div class="lg:col-span-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-3xl p-6 border border-orange-200 sticky top-28 space-y-6 shadow-sm">
                        <h4 class="text-lg font-bold text-gray-900">Hubungan Kerjasama</h4>
                        
                        <div class="space-y-4">
                            <div>
                                <span class="block text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Tipe Mitra</span>
                                <span class="text-gray-800 font-medium capitalize">{{ str_replace('_', ' ', $kemitraan->type) }}</span>
                            </div>
                            
                            @if ($kemitraan->link)
                                <div>
                                    <span class="block text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Website Resmi</span>
                                    <a href="{{ $kemitraan->link }}" target="_blank" class="text-orange-600 hover:text-orange-700 font-medium break-all flex items-center gap-1.5 transition">
                                        <span>Kunjungi Situs</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>

                        @if ($kemitraan->link)
                            <a href="{{ $kemitraan->link }}" target="_blank"
                                class="block w-full text-center px-6 py-3.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-bold hover:from-orange-600 hover:to-orange-700 transition duration-300 shadow-md shadow-orange-500/10 hover:shadow-orange-500/20 transform hover:-translate-y-0.5">
                                Kunjungi Website Mitra
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Share Scripts -->
    <script>
        function shareFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
        }

        function shareTwitter() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent('{{ $kemitraan->name }}');
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
        }

        function shareLinkedIn() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank', 'width=600,height=400');
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Link berhasil disalin ke clipboard!');
            }).catch(err => {
                console.error('Gagal menyalin link:', err);
            });
        }
    </script>
@endsection
