@extends('layouts.app')

@section('title', 'Berita & Artikel - PII')

@section('content')
    <!-- Hero Section -->
    <section
        class="relative min-h-screen flex items-center bg-gradient-to-br from-slate-900 via-orange-900 to-slate-800 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,107,53,0.3) 0%, transparent 50%);">
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-orange-500/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute top-40 right-20 w-32 h-32 bg-orange-400/10 rounded-full blur-2xl animate-pulse delay-1000">
        </div>
        <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-orange-600/15 rounded-full blur-xl animate-pulse delay-500">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center text-white space-y-8" data-aos="fade-up">
                <div
                    class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm rounded-full border border-orange-400/30">
                    <span class="w-2 h-2 bg-orange-400 rounded-full mr-2 animate-pulse"></span>
                    <span class="text-orange-300 text-sm font-medium">Berita & Artikel</span>
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">
                    <span class="block">Pengetahuan</span>
                    <span
                        class="block bg-gradient-to-r from-orange-400 to-orange-200 bg-clip-text text-transparent">Insinyur</span>
                    <span class="block">Modern</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 leading-relaxed max-w-3xl mx-auto">
                    Temukan artikel, berita, dan wawasan terkini seputar dunia keinsinyuran, inovasi teknologi, dan
                    perkembangan profesi
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#articles"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-orange-500/25">
                        <span>Jelajahi Artikel</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-orange-400 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-orange-400 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Featured Article Section -->
    @if ($artikels->count() > 0)
        <section class="py-24 bg-gradient-to-br from-white via-orange-50 to-white relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="100"
                    height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cg
                    fill-rule="evenodd"%3E%3Cg fill="%23FF6B35" fill-opacity="0.1"%3E%3Cpath
                    d="M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z"
                    /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                        Artikel Unggulan
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Bacaan <span class="text-orange-500">Terpopuler</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Artikel-artikel pilihan yang memberikan wawasan mendalam tentang perkembangan terkini di dunia
                        keinsinyuran
                    </p>
                </div>

                <!-- Featured Article -->
                @php $featured = $artikels->first(); @endphp
                @if ($featured)
                    <div class="mb-16" data-aos="fade-up">
                        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                            <div class="grid grid-cols-1 lg:grid-cols-2">
                                <div class="relative h-64 lg:h-auto">
                                    <img src="{{ Str::startsWith($featured->image, ['http://', 'https://']) ? $featured->image : asset($featured->image) }}" alt="{{ $featured->title }}"
                                        class="w-full h-full object-cover">
                                    <div class="absolute top-6 left-6">
                                        <span
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-full text-sm font-semibold shadow-lg">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                </path>
                                            </svg>
                                            Artikel Unggulan
                                        </span>
                                    </div>
                                </div>
                                <div class="p-8 lg:p-12 flex flex-col justify-center">
                                    <div class="flex items-center mb-4">
                                        <span
                                            class="inline-block bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full font-semibold capitalize mr-4">
                                            {{ str_replace('_', ' ', $featured->category) }}
                                        </span>
                                        @if ($featured->published_at)
                                            <span
                                                class="text-sm text-gray-500">{{ $featured->published_at->format('d M Y') }}</span>
                                        @endif
                                    </div>
                                    <h3 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                                        {{ $featured->title }}</h3>
                                    <p class="text-gray-600 mb-6 text-lg leading-relaxed">{{ $featured->excerpt }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span class="text-gray-600 font-medium">{{ $featured->author }}</span>
                                        </div>
                                        <a href="{{ route('artikel.show', $featured->id) }}"
                                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                            <span>Baca Artikel</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- Articles Grid Section -->
    <section id="articles" class="py-24 bg-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="80"
                height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none"
                fill-rule="evenodd"%3E%3Cg fill="%23FF6B35" fill-opacity="0.1"%3E%3Ccircle cx="40"
                cy="40" r="4" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div
                    class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                    Semua Artikel
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Koleksi <span class="text-orange-500">Artikel</span> Lengkap
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Berbagai artikel informatif dari berbagai kategori yang dapat memperkaya pengetahuan Anda
                </p>
            </div>

            @if ($artikels->count() > 0)
                <!-- Category Filter -->
                <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('artikel.index') }}"
                        class="px-6 py-3 bg-orange-500 text-white rounded-2xl font-semibold hover:bg-orange-600 transition-all duration-300 {{ request('category') ? '' : 'ring-2 ring-orange-300' }}">
                        Semua Kategori
                    </a>
                    <a href="{{ route('artikel.artikel_teknik') }}"
                        class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">
                        Artikel Teknik
                    </a>
                    <a href="{{ route('artikel.regulasi') }}"
                        class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">
                        Regulasi Terbaru
                    </a>
                    <a href="{{ route('artikel.inovasi') }}"
                        class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">
                        Inovasi Teknologi
                    </a>
                    <a href="{{ route('artikel.opini') }}"
                        class="px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold hover:bg-orange-100 hover:text-orange-700 transition-all duration-300 border border-gray-200">
                        Opini
                    </a>
                </div>

                <!-- Articles Container for AJAX -->
                <div id="articles-container" class="min-h-[400px]">
                    @include('artikel.partials.articles-list', ['artikels' => $artikels])
                </div>

                <!-- Loading Indicator -->
                <div id="loading-indicator" class="hidden flex justify-center py-8">
                    <div class="flex items-center space-x-2 text-orange-500">
                        <svg class="animate-spin h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span class="font-medium">Memuat artikel...</span>
                    </div>
                </div>
            @else
                <!-- No Articles State -->
                <div class="text-center py-16" data-aos="fade-up">
                    <div class="bg-white rounded-3xl shadow-xl p-12 border border-gray-100 max-w-2xl mx-auto">
                        <div class="w-24 h-24 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Artikel</h3>
                        <p class="text-gray-600 text-lg mb-6">Konten artikel sedang dalam pengembangan. Silakan kembali
                            lagi nanti untuk mendapatkan informasi terkini.</p>
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-24 bg-gradient-to-r from-orange-500 to-orange-600 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60"
                height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none"
                fill-rule="evenodd"%3E%3Cg fill="%23FFFFFF" fill-opacity="0.1"%3E%3Ccircle cx="30"
                cy="30" r="2" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="space-y-8" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Tetap Update dengan <span class="block">Artikel Terbaru</span>
                </h2>
                <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                    Berlangganan newsletter kami dan dapatkan artikel-artikel menarik langsung ke inbox Anda setiap minggu
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                    <input type="email" placeholder="Masukkan email Anda"
                        class="flex-1 px-6 py-4 rounded-2xl border-0 focus:ring-2 focus:ring-white text-gray-900 placeholder-gray-500">
                    <button
                        class="px-8 py-4 bg-white text-orange-600 rounded-2xl font-semibold hover:bg-orange-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Berlangganan
                    </button>
                </div>
                <p class="text-orange-200 text-sm">Kami menghargai privasi Anda. Tidak ada spam, unsubscribe kapan saja.
                </p>
            </div>
        </div>
        </div>
    </section>

    <!-- AJAX Pagination Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const articlesContainer = document.getElementById('articles-container');
            const loadingIndicator = document.getElementById('loading-indicator');
            let isLoading = false;

            // Function to handle pagination clicks
            function handlePaginationClick(e) {
                e.preventDefault();

                if (isLoading) return;

                const link = e.target.closest('a');
                if (!link || !link.href) return;

                // Check if it's a pagination link
                if (!link.href.includes('page=')) return;

                isLoading = true;
                loadingIndicator.classList.remove('hidden');
                articlesContainer.classList.add('opacity-50');

                // Fetch the page via AJAX
                fetch(link.href, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update the content
                        articlesContainer.innerHTML = data.html;

                        // Scroll to articles section smoothly
                        const articlesSection = document.getElementById('articles');
                        const filterBar = articlesSection.querySelector('.flex.flex-wrap');
                        if (filterBar) {
                            filterBar.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }

                        // Update browser URL without refresh
                        const url = new URL(link.href);
                        url.searchParams.delete('category'); // Keep only page param
                        window.history.pushState({}, '', link.href);

                        // Re-attach event listeners to new pagination links
                        attachPaginationListeners();

                        // Re-initialize AOS animations
                        if (typeof AOS !== 'undefined') {
                            AOS.refresh();
                        }
                    })
                    .catch(error => {
                        console.error('Error loading articles:', error);
                        // Fallback: navigate normally on error
                        window.location.href = link.href;
                    })
                    .finally(() => {
                        isLoading = false;
                        loadingIndicator.classList.add('hidden');
                        articlesContainer.classList.remove('opacity-50');
                    });
            }

            // Function to attach event listeners to pagination links
            function attachPaginationListeners() {
                const paginationLinks = articlesContainer.querySelectorAll('a[href*="page="]');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', handlePaginationClick);
                });
            }

            // Initial attachment
            attachPaginationListeners();

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function(e) {
                // Reload the page on back/forward to maintain correct state
                window.location.reload();
            });
        });
    </script>
@endsection
