@extends('layouts.app')

@section('title', 'Sejarah - PII')

@section('content')
    <!-- Sejarah Section - Landscape with Picture in Text -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60"
                viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg
                fill="%23FF6B35" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"
                /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12" data-aos="fade-up">
                <span
                    class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tentang PII
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">
                    {{ $sejarah->title ?? 'Sejarah' }}
                </h1>
                @if ($sejarah->period)
                    <p class="text-xl text-orange-500 font-medium">{{ $sejarah->period }}</p>
                @endif
            </div>

            <!-- Landscape Content Card with Picture in Text -->
            <div class="max-w-7xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12 lg:p-16">

                    @if ($sejarah && $sejarah->image)
                        <!-- Picture in Text Layout -->
                        <div class="float-left mr-8 mb-4 md:mr-10 md:mb-6 w-full md:w-80 lg:w-96">
                            <div class="relative group">
                                <!-- Decorative shadow -->
                                <div
                                    class="absolute -inset-1 bg-gradient-to-br from-orange-300 to-orange-500 rounded-xl blur opacity-30">
                                </div>
                                <div class="mb-8 rounded-2xl overflow-hidden shadow-lg">
                                    <img src="{{ Str::startsWith($sejarah->image, ['http://', 'https://']) ? $sejarah->image : asset($sejarah->image) }}"
                                        alt="{{ $sejarah->title }}" class="w-full h-auto object-cover">
                                </div>
                                <!-- Caption -->
                                <div class="mt-2 text-center">
                                    <span class="text-xs text-gray-500 font-medium">Dokumentasi Sejarah PII</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Flowing Text Content -->
                    <div class="prose prose-lg prose-slate max-w-none text-gray-700 leading-[1.8]">
                        {!! $sejarah->content ?? '<p class="text-gray-500 italic">Konten sejarah sedang dalam pengembangan.</p>' !!}
                    </div>

                    <!-- Clear float -->
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ketua Umum Section -->
    @if ($ketuaUmums && $ketuaUmums->count() > 0)
        <section id="ketua-umum"
            class="py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,107,53,0.3) 0%, transparent 50%);">
                </div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm text-orange-300 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Pemimpin PII
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Ketua Umum <span class="text-orange-400">Sejak Dulu</span>
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Para pemimpin visioner yang telah membawa PII menjadi organisasi insinyur terdepan di Indonesia
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($ketuaUmums->sortBy('order') as $ketuaUmum)
                        <div class="group bg-white/10 backdrop-blur-md rounded-3xl p-8 border border-white/20 hover:bg-white/15 transition-all duration-500 transform hover:-translate-y-2"
                            data-aos="fade-up" data-aos-delay="{{ ($loop->index + 1) * 100 }}">
                            <div class="text-center">
                                @if ($ketuaUmum->image)
                                    <div class="relative mb-6">
                                        <img src="{{ Str::startsWith($ketuaUmum->image, ['http://', 'https://']) ? $ketuaUmum->image : asset($ketuaUmum->image) }}"
                                            alt="{{ $ketuaUmum->name }}"
                                            class="w-32 h-32 object-cover rounded-2xl mx-auto shadow-lg border-4 border-orange-400/30 group-hover:scale-110 transition-transform duration-300">
                                        <div
                                            class="absolute -bottom-2 -right-2 w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="w-32 h-32 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl mx-auto mb-6 flex items-center justify-center text-5xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        👤
                                    </div>
                                @endif
                                <h3
                                    class="text-2xl font-bold text-white mb-2 group-hover:text-orange-300 transition-colors">
                                    {{ $ketuaUmum->name }}</h3>
                                @if ($ketuaUmum->period)
                                    <div
                                        class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm rounded-full text-orange-300 text-sm font-medium">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $ketuaUmum->period }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Call to Action -->
    <section class="py-24 bg-gradient-to-r from-orange-500 to-orange-600 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60"
                viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg
                fill="%23FFFFFF" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"
                /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="space-y-8" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Bergabunglah dengan <span class="block">Komunitas Insinyur Terbesar</span>
                </h2>
                <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                    Jadilah bagian dari sejarah PII yang terus berkembang dan berkontribusi untuk kemajuan profesi
                    keinsinyuran di Indonesia
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('tentang.kontak') }}"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl font-semibold text-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl shadow-orange-500/25">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Hubungi Kami
                    </a>
                    <a href="{{ route('tentang.sekilas') }}"
                        class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 border border-white/20">
                        <span>Pelajari Lebih Lanjut</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
