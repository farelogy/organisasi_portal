@extends('layouts.app')

@section('title', 'Gallery - PII')

@section('content')
    <!-- Hero Section -->
    <section
        class="relative min-h-[60vh] flex items-center bg-gradient-to-br from-slate-900 via-orange-900 to-slate-800 overflow-hidden">
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
                    <span class="text-orange-300 text-sm font-medium">Dokumentasi & Arsip</span>
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">
                    <span class="block">Galeri</span>
                    <span class="block bg-gradient-to-r from-orange-400 to-orange-200 bg-clip-text text-transparent">
                        PII</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 leading-relaxed max-w-3xl mx-auto">
                    Arsip visual kegiatan, acara, dan momen berharga Persatuan Insinyur Indonesia
                </p>
            </div>
        </div>
    </section>

    <!-- Slideshow Section -->
    @if ($galleries->count() > 0)
        <section class="py-20 bg-gradient-to-br from-white via-orange-50 to-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle at 20% 30%, rgba(255,107,53,0.2) 0%, transparent 50%), radial-gradient(circle at 80% 70%, rgba(255,107,53,0.2) 0%, transparent 50%);">
                </div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Sorotan
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        Momen <span class="text-orange-500">Pilihan</span>
                    </h2>
                </div>

                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <!-- Main Image Display -->
                    <div class="relative bg-slate-900">
                        <div id="slideshow-main" class="relative w-full overflow-hidden" style="min-height: 280px; max-height: 80vh;">
                            @foreach ($galleries as $idx => $slide)
                                <div id="slide-{{ $idx }}" class="slideshow-slide absolute inset-0" style="opacity: {{ $idx === 0 ? '1' : '0' }}; pointer-events: {{ $idx === 0 ? 'auto' : 'none' }}; transition: opacity 0.7s ease;">
                                    <img src="{{ Str::startsWith($slide->image, ['http://', 'https://']) ? $slide->image : asset($slide->image) }}"
                                        alt="{{ $slide->title }}"
                                        class="w-full h-full object-contain"
                                        onload="adjustSlideshowHeight()">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 text-white">
                                        @if ($slide->category)
                                            <span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded-full font-semibold capitalize mb-3">
                                                {{ $slide->category }}
                                            </span>
                                        @endif
                                        <h3 class="text-2xl md:text-4xl font-bold mb-2 leading-tight">{{ $slide->title }}</h3>
                                        @if ($slide->description)
                                            <p class="text-gray-200 text-sm md:text-base max-w-3xl line-clamp-2">{{ $slide->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <!-- Prev / Next Buttons -->
                            <button type="button" onclick="slideshowPrev()" aria-label="Sebelumnya"
                                class="absolute left-4 top-1/2 -translate-y-1/2 z-10 inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button type="button" onclick="slideshowNext()" aria-label="Berikutnya"
                                class="absolute right-4 top-1/2 -translate-y-1/2 z-10 inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>

                            <!-- Counter -->
                            <div class="absolute top-4 right-4 z-10 bg-black/50 backdrop-blur-sm text-white text-sm px-3 py-1.5 rounded-full font-medium">
                                <span id="slide-counter-current">1</span> / {{ $galleries->count() }}
                            </div>
                        </div>
                    </div>

                    <!-- Thumbnail Strip -->
                    <div class="relative bg-gray-50 p-4">
                        <button type="button" onclick="thumbsScroll(-1)" aria-label="Geser kiri"
                            class="absolute left-2 top-1/2 -translate-y-1/2 z-10 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-lg text-gray-700 hover:bg-orange-500 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>

                        <div id="thumbs-container" class="overflow-x-auto scroll-smooth no-scrollbar mx-12">
                            <div class="flex gap-3 py-2">
                                @foreach ($galleries as $idx => $slide)
                                    <button type="button" onclick="slideshowGoTo({{ $idx }})"
                                        data-thumb="{{ $idx }}"
                                        class="slideshow-thumb flex-shrink-0 relative w-28 h-20 md:w-32 md:h-24 rounded-xl overflow-hidden border-2 transition-all duration-300 {{ $idx === 0 ? 'border-orange-500 ring-2 ring-orange-300 scale-105' : 'border-transparent hover:border-orange-300' }}">
                                        <img src="{{ Str::startsWith($slide->image, ['http://', 'https://']) ? $slide->image : asset($slide->image) }}"
                                            alt="{{ $slide->title }}"
                                            class="w-full h-full object-cover" loading="lazy">
                                        <div class="thumb-overlay absolute inset-0 bg-black/40" style="opacity: {{ $idx === 0 ? '0' : '0.5' }}; transition: opacity 0.3s ease;"></div>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <button type="button" onclick="thumbsScroll(1)" aria-label="Geser kanan"
                            class="absolute right-2 top-1/2 -translate-y-1/2 z-10 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white shadow-lg text-gray-700 hover:bg-orange-500 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        </style>

        <script>
            window.adjustSlideshowHeight = function() {
                var container = document.getElementById('slideshow-main');
                if (!container) return;
                var activeSlide = container.querySelector('.slideshow-slide[style*="opacity: 1"]') ||
                                    container.querySelector('.slideshow-slide');
                if (!activeSlide) return;
                var img = activeSlide.querySelector('img');
                if (!img || !img.complete) return;
                var containerWidth = container.clientWidth;
                var naturalW = img.naturalWidth || containerWidth;
                var naturalH = img.naturalHeight || 280;
                var targetH = containerWidth * (naturalH / naturalW);
                container.style.height = Math.max(targetH, 280) + 'px';
            };

            window.addEventListener('resize', window.adjustSlideshowHeight);

            (function() {
                const totalSlides = {{ $galleries->count() }};
                let currentSlide = 0;
                let autoplayTimer = null;

                window.slideshowGoTo = function(index) {
                    if (index < 0 || index >= totalSlides) return;

                    var prevEl = document.getElementById('slide-' + currentSlide);
                    if (prevEl) { prevEl.style.opacity = '0'; prevEl.style.pointerEvents = 'none'; }

                    currentSlide = index;

                    var currEl = document.getElementById('slide-' + currentSlide);
                    if (currEl) { currEl.style.opacity = '1'; currEl.style.pointerEvents = 'auto'; }

                    document.getElementById('slide-counter-current').textContent = currentSlide + 1;

                    document.querySelectorAll('.slideshow-thumb').forEach(function(t, i) {
                        var overlay = t.querySelector('.thumb-overlay');
                        if (i === currentSlide) {
                            t.style.borderColor = '#f97316';
                            t.style.boxShadow = '0 0 0 2px #fdba74';
                            t.style.transform = 'scale(1.05)';
                            if (overlay) overlay.style.opacity = '0';
                            t.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                        } else {
                            t.style.borderColor = 'transparent';
                            t.style.boxShadow = 'none';
                            t.style.transform = 'scale(1)';
                            if (overlay) overlay.style.opacity = '0.5';
                        }
                    });

                    window.adjustSlideshowHeight();
                    restartAutoplay();
                };

                window.slideshowNext = function() {
                    window.slideshowGoTo((currentSlide + 1) % totalSlides);
                };

                window.slideshowPrev = function() {
                    window.slideshowGoTo((currentSlide - 1 + totalSlides) % totalSlides);
                };

                window.thumbsScroll = function(direction) {
                    const container = document.getElementById('thumbs-container');
                    if (container) container.scrollBy({ left: direction * 240, behavior: 'smooth' });
                };

                function restartAutoplay() {
                    if (autoplayTimer) clearInterval(autoplayTimer);
                    autoplayTimer = setInterval(window.slideshowNext, 6000);
                }

                restartAutoplay();
                window.adjustSlideshowHeight();

                // Pause autoplay when hovering over slideshow
                const slideshow = document.querySelector('.slideshow-slide')?.parentElement;
                if (slideshow) {
                    slideshow.addEventListener('mouseenter', function() {
                        if (autoplayTimer) clearInterval(autoplayTimer);
                    });
                    slideshow.addEventListener('mouseleave', restartAutoplay);
                }
            })();
        </script>
    @else
        <div class="py-24 text-center">
            <div class="bg-white rounded-3xl shadow-xl p-12 border border-gray-100 max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Galeri</h3>
                <p class="text-gray-600 text-lg mb-6">Konten galeri sedang dalam pengembangan.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300">Kembali ke Beranda</a>
            </div>
        </div>
    @endif
@endsection

