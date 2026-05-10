@extends('layouts.app')

@section('title', 'Beranda - PII')

@section('content')
<!-- Hero Section with Slider -->
<section class="relative h-screen overflow-hidden -mt-20">
    @if($heroes->count() > 0)
    <div class="relative hero-carousel h-screen">
        @foreach($heroes as $hero)
        <div class="hero-slide absolute inset-0 {{ $loop->first ? 'active' : '' }}" data-slide-index="{{ $loop->index }}">
            <img src="{{ $hero->image ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1400&q=80' }}" alt="{{ $hero->title }}" class="absolute inset-0 w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-orange-500/30"></div>
            <div class="absolute inset-0 bg-slate-950/50"></div>
            <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 h-full flex items-center">
                <!-- Floating decorative elements -->
                <div class="absolute top-20 left-10 w-20 h-20 bg-orange-400/20 rounded-full blur-xl animate-pulse"></div>
                <div class="absolute top-40 right-20 w-32 h-32 bg-orange-300/10 rounded-full blur-2xl animate-pulse delay-1000"></div>
                <div class="absolute bottom-32 left-1/4 w-24 h-24 bg-orange-500/15 rounded-full blur-xl animate-pulse delay-500"></div>

                <div class="w-full lg:w-1/2 relative">
                    <div class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm rounded-full border border-white/20 text-sm text-orange-100 mb-6">
                        <span class="w-2 h-2 bg-orange-400 rounded-full mr-2 animate-pulse"></span>
                        Persatuan Insinyur Indonesia
                    </div>
                    <div class="bg-orange-500/10 backdrop-blur-md rounded-3xl p-8 md:p-10 border border-orange-400/20 shadow-2xl mb-8">
                        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6">
                            {{ $hero->title }}
                        </h1>
                        <p class="text-lg sm:text-xl md:text-2xl text-slate-200 max-w-2xl leading-relaxed mb-8">
                            {{ $hero->subtitle }}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            @if($hero->button_text && $hero->button_link)
                            <a href="{{ $hero->button_link }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-lg shadow-orange-500/20">
                                {{ $hero->button_text }}
                            </a>
                            @endif
                            <a href="#berita" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 border border-white/20">
                                Berita Terbaru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Carousel Controls - Dot Indicators -->
    @if($heroes->count() > 1)
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-[100] flex items-center gap-3">
        @foreach($heroes as $index => $hero)
        <button onclick="goToSlide({{ $index }})" class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    @endif
    @endif
</section>

<style>
.hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
    transform: scale(1.05);
}
.hero-slide.active {
    opacity: 1;
    transform: scale(1);
}
.hero-slide:not(.active) {
    pointer-events: none;
}
.carousel-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    border: 2px solid white;
    transition: all 0.3s ease;
    cursor: pointer;
}
.carousel-dot:hover {
    background: rgba(255,255,255,0.8);
    transform: scale(1.2);
}
.carousel-dot.active {
    background: white;
    width: 32px;
    border-radius: 8px;
}
</style>

<script>
let currentSlide = 0;
const totalSlides = {{ $heroes->count() ?? 0 }};
let autoPlayInterval;

function showSlide(index) {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.carousel-dot');

    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
            setTimeout(() => {
                slide.classList.add('active');
            }, 50);
        }
    });

    dots.forEach((dot, i) => {
        dot.classList.remove('active');
        if (i === index) {
            dot.classList.add('active');
        }
    });

    currentSlide = index;
}

function nextSlide() {
    const next = (currentSlide + 1) % totalSlides;
    showSlide(next);
}

function prevSlide() {
    const prev = (currentSlide - 1 + totalSlides) % totalSlides;
    showSlide(prev);
}

function goToSlide(index) {
    showSlide(index);
}

// Auto-play functionality
function startAutoPlay() {
    if (totalSlides > 1) {
        autoPlayInterval = setInterval(() => {
            nextSlide();
        }, 5000); // Change slide every 5 seconds
    }
}

function stopAutoPlay() {
    if (autoPlayInterval) {
        clearInterval(autoPlayInterval);
    }
}

// Initialize carousel
document.addEventListener('DOMContentLoaded', function() {
    if (totalSlides > 0) {
        showSlide(0); // Show first slide
        startAutoPlay();
    }
});

// Pause auto-play on hover
document.addEventListener('DOMContentLoaded', function() {
    const heroSection = document.querySelector('.hero-carousel');
    if (heroSection) {
        heroSection.addEventListener('mouseenter', stopAutoPlay);
        heroSection.addEventListener('mouseleave', startAutoPlay);
    }
});
</script>



<!-- Berita Terkini Section -->
<section id="berita" class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23FF6B35" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Berita Terkini
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Update <span class="text-orange-500">Informasi</span> Terbaru
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Dapatkan berita terbaru seputar kegiatan, program, dan inisiatif PII yang penting untuk anggota dan masyarakat.
            </p>
            <div class="mt-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('artikel.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-lg shadow-orange-500/20">
                    <span>Lihat Semua Berita</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($beritas->take(3) as $berita)
            <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                <div class="h-56 overflow-hidden">
                    <img src="{{ $berita->image ?? 'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=1400&q=80' }}" alt="{{ $berita->title }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-8">
                    <div class="text-gray-400 text-sm mb-3">
                        {{ $berita->published_at?->format('d M Y') ?? 'Tanggal belum tersedia' }} • {{ $berita->author ?? 'PII' }}
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-orange-500 transition-colors">{{ Str::limit($berita->title, 70) }}</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($berita->excerpt ?? strip_tags($berita->content), 120) }}</p>
                    <a href="{{ url('/berita/'.$berita->id) }}" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition-colors group">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Upcoming Events Section -->
<section class="py-24 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,107,53,0.3) 0%, transparent 50%);"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm text-orange-300 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Event Mendatang
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Jadwal <span class="text-orange-400">Kegiatan</span> Terdekat
            </h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                Ikuti berbagai seminar, workshop, dan konferensi yang akan memperkaya pengetahuan dan jaringan profesional Anda
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Event 1 -->
            <div class="group bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-orange-400 font-bold text-2xl">15</div>
                        <div class="text-gray-400 text-sm">NOV</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-orange-300 transition-colors">Seminar Teknologi AI</h3>
                <p class="text-gray-300 mb-6 leading-relaxed">
                    Pelajari penerapan kecerdasan buatan dalam industri keinsinyuran modern dan peluang karir di era digital
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-gray-400 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        Jakarta
                    </div>
                    <a href="#" class="inline-flex items-center text-orange-400 font-semibold hover:text-orange-300 transition-colors group">
                        <span>Daftar</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Event 2 -->
            <div class="group bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-blue-400 font-bold text-2xl">22</div>
                        <div class="text-gray-400 text-sm">NOV</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-blue-300 transition-colors">Workshop BIM</h3>
                <p class="text-gray-300 mb-6 leading-relaxed">
                    Pelatihan praktis Building Information Modeling untuk proyek konstruksi efisien dan berkelanjutan
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-gray-400 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        Surabaya
                    </div>
                    <a href="#" class="inline-flex items-center text-blue-400 font-semibold hover:text-blue-300 transition-colors group">
                        <span>Daftar</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Event 3 -->
            <div class="group bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-green-400 font-bold text-2xl">05</div>
                        <div class="text-gray-400 text-sm">DEC</div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-green-300 transition-colors">Konvensi Insinyur</h3>
                <p class="text-gray-300 mb-6 leading-relaxed">
                    Konferensi tahunan PII dengan tema "Insinyur 4.0: Menghadapi Tantangan Industri Digital"
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-gray-400 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        Bali
                    </div>
                    <a href="#" class="inline-flex items-center text-green-400 font-semibold hover:text-green-300 transition-colors group">
                        <span>Daftar</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
            <a href="#" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-orange-500/25">
                <span>Lihat Semua Event</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-12 bg-gradient-to-br from-white via-orange-50 to-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill-rule="evenodd"%3E%3Cg fill="%23FF6B35" fill-opacity="0.1"%3E%3Cpath d="M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Galeri Foto
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Dokumentasi <span class="text-orange-500">Kegiatan</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Sekilas foto kegiatan PII — klik untuk melihat galeri lengkap.
            </p>
            <div class="mt-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('gallery') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-lg shadow-orange-500/20">
                    <span>Lihat Galeri Lengkap</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Compact Thumbnail Grid -->
        <div class="flex flex-wrap justify-center gap-2" data-aos="fade-up" data-aos-delay="200">
            @forelse($galleries->take(10) as $gallery)
            <a href="{{ route('gallery') }}" class="group relative overflow-hidden rounded-xl shadow-md w-48 h-48 sm:w-60 sm:h-60 md:w-72 md:h-72 flex-shrink-0" aria-label="Lihat Galeri Lengkap">
                <img src="{{ Str::startsWith($gallery->image, ['http://','https://']) ? $gallery->image : asset($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-110">
                <div class="absolute inset-0 bg-orange-500/0 group-hover:bg-orange-500/20 transition-colors duration-300 rounded-xl"></div>
            </a>
            @empty
            <p class="text-gray-400 text-sm py-4">Belum ada foto dalam galeri.</p>
            @endforelse
        </div>

        @if($galleries->count() > 10)
        <div class="text-center mt-6">
            <a href="{{ route('gallery') }}" class="inline-flex items-center text-sm text-orange-500 font-medium hover:text-orange-600 transition-colors">
                <span>Lihat {{ $galleries->count() - 10 }} foto lainnya</span>
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Enhanced CTA Section -->
<section id="kontak" class="py-24 bg-gradient-to-br from-slate-900 via-orange-900 to-slate-800 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-orange-500/10 to-transparent"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-500/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-blue-500/5 rounded-full blur-2xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- CTA Content -->
            <div class="text-white space-y-8" data-aos="fade-right">
                <div class="space-y-4">
                    <div class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm rounded-full border border-orange-400/30">
                        <span class="w-2 h-2 bg-orange-400 rounded-full mr-2 animate-pulse"></span>
                        <span class="text-orange-300 text-sm font-medium">Bergabung Sekarang</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                        Siap untuk <span class="bg-gradient-to-r from-orange-400 to-orange-200 bg-clip-text text-transparent">Berkembang</span>?
                    </h2>
                    <p class="text-xl text-gray-300 leading-relaxed max-w-lg">
                        Jadilah bagian dari komunitas insinyur terbesar di Indonesia. Dapatkan akses ke pelatihan, networking, dan kesempatan karier yang tak terbatas.
                    </p>
                </div>

                <!-- Benefits -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-300">Pelatihan Berkualitas</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-300">Jaringan Profesional</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-300">Sertifikasi Resmi</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500/20 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-300">Inovasi Teknologi</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-orange-500/25">
                        <span>Daftar Anggota</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#" class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- CTA Visual -->
            <div class="relative" data-aos="fade-left">
                <div class="relative">
                    <!-- Main Visual -->
                    <div class="relative bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/20">
                        <div class="text-center space-y-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">10,000+ Anggota</h3>
                                <p class="text-gray-300">Bergabunglah dengan komunitas insinyur terbesar di Indonesia</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <div class="text-2xl font-bold text-orange-400">50+</div>
                                    <div class="text-sm text-gray-400">Tahun Pengalaman</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-orange-400">100+</div>
                                    <div class="text-sm text-gray-400">Event Berhasil</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -left-4 bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 animate-bounce delay-300">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold text-sm">Terverifikasi</div>
                                <div class="text-orange-300 text-xs">Resmi PII</div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-4 -right-4 bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 animate-bounce delay-700">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold text-sm">Inovatif</div>
                                <div class="text-orange-300 text-xs">Teknologi Terkini</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
