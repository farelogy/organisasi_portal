@extends('layouts.app')

@section('title', $artikel->title . ' - PII')

@section('content')
    <!-- Hero Header with Image -->
    <section class="relative min-h-[70vh] flex items-end overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            @if($artikel->image)
                <img src="{{ Str::startsWith($artikel->image, ['http://', 'https://']) ? $artikel->image : asset($artikel->image) }}" alt="{{ $artikel->title }}" class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/70 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/50 to-transparent"></div>
        </div>

        <!-- Floating Decorative Elements -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-orange-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-40 right-20 w-48 h-48 bg-orange-400/10 rounded-full blur-3xl animate-pulse delay-1000">
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 pt-32 w-full">
            <div class="max-w-4xl" data-aos="fade-up">
                <!-- Category Badge -->
                <div class="mb-6">
                    <a href="{{ route('artikel.' . $artikel->category) }}"
                        class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm rounded-full border border-orange-400/30 text-orange-300 text-sm font-medium hover:bg-orange-500/30 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                        {{ str_replace('_', ' ', $artikel->category) }}
                    </a>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    {{ $artikel->title }}
                </h1>

                <!-- Excerpt -->
                <p class="text-xl md:text-2xl text-gray-300 leading-relaxed mb-8 max-w-3xl">
                    {{ $artikel->excerpt }}
                </p>

                <!-- Author & Date -->
                <div class="flex flex-wrap items-center gap-6 text-gray-300">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-white font-medium">{{ $artikel->author }}</span>
                            <span class="text-sm text-gray-400">Penulis</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <span
                                class="block text-white font-medium">{{ $artikel->published_at ? $artikel->published_at->format('d M Y') : '-' }}</span>
                            <span class="text-sm text-gray-400">Dipublikasikan</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <span
                                class="block text-white font-medium">{{ $artikel->published_at ? $artikel->published_at->diffForHumans() : '-' }}</span>
                            <span class="text-sm text-gray-400">Update Terakhir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/50 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Article Content Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center text-sm text-gray-500 mb-8" data-aos="fade-up">
                <a href="{{ route('home') }}" class="hover:text-orange-500 transition">Beranda</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('artikel.index') }}" class="hover:text-orange-500 transition">Berita & Artikel</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-orange-500 font-medium">{{ str_replace('_', ' ', $artikel->category) }}</span>
            </nav>

            <!-- Main Content -->
            <article class="prose prose-lg prose-orange max-w-none" data-aos="fade-up">
                @if ($artikel->content)
                    <div class="text-gray-700 leading-relaxed text-lg space-y-6">
                        {!! $artikel->content !!}
                    </div>
                @else
                    <div class="bg-orange-50 border-l-4 border-orange-500 p-6 rounded-r-xl">
                        <p class="text-orange-700 italic">Konten lengkap sedang dalam penyusunan. Silakan kembali lagi nanti
                            untuk membaca artikel lengkap.</p>
                    </div>
                @endif
            </article>

            <!-- Share Section -->
            <div class="mt-12 pt-8 border-t border-gray-200" data-aos="fade-up">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-gray-600 font-medium">Bagikan artikel ini:</span>
                    <div class="flex gap-3">
                        <button onclick="shareFacebook()"
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </button>
                        <button onclick="shareTwitter()"
                            class="w-10 h-10 bg-sky-500 rounded-full flex items-center justify-center hover:bg-sky-600 transition text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </button>
                        <button onclick="shareLinkedIn()"
                            class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center hover:bg-blue-800 transition text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
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
    </section>

    <!-- Related Articles Section -->
    @php
        $relatedArticles = \App\Models\Berita::where('id', '!=', $artikel->id)
            ->where('category', $artikel->category)
            ->where('is_active', true)
            ->take(3)
            ->get();
    @endphp

    @if ($relatedArticles->count() > 0)
        <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        Artikel Terkait
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Baca Juga</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedArticles as $related)
                        <article
                            class="group bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ Str::startsWith($related->image, ['http://', 'https://']) ? $related->image : asset($related->image) }}" alt="{{ $related->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                            </div>
                            <div class="p-6">
                                <span
                                    class="inline-block bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full font-semibold mb-3">
                                    {{ str_replace('_', ' ', $related->category) }}
                                </span>
                                <h3
                                    class="text-lg font-bold text-gray-900 mb-3 group-hover:text-orange-500 transition-colors line-clamp-2">
                                    {{ $related->title }}</h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $related->excerpt }}</p>
                                <a href="{{ route('artikel.show', $related->id) }}"
                                    class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors text-sm">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Back to Articles CTA -->
    <section class="py-20 bg-gradient-to-r from-slate-900 via-orange-900 to-slate-800 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,107,53,0.3) 0%, transparent 50%);">
            </div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="space-y-6" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-white">
                    Ingin Membaca Artikel Lainnya?
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Jelajahi lebih banyak artikel menarik dari berbagai kategori
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                    <a href="{{ route('artikel.index') }}"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <span>Lihat Semua Artikel</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </a>
                    <a href="{{ route('artikel.' . $artikel->category) }}"
                        class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-semibold hover:bg-white/20 transition-all duration-300 border border-white/20">
                        <span>Kategori {{ str_replace('_', ' ', $artikel->category) }}</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
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
            const text = encodeURIComponent('{{ $artikel->title }}');
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
