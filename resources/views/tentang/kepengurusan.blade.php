@extends('layouts.app')

@section('title', 'Struktur Kepengurusan - PII')

@section('content')
    <!-- Struktur Kepengurusan Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23FF6B35&quot; fill-opacity=&quot;0.1&quot;%3E%3Ccircle cx=&quot;30&quot; cy=&quot;30&quot; r=&quot;2&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12" data-aos="fade-up">
                <span
                    class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                    Tentang PII
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">
                    {{ $kepengurusan->title ?? 'Struktur Kepengurusan' }}
                </h1>
            </div>

            <!-- Content Card -->
            <div class="max-w-7xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12 lg:p-16">

                    @if ($kepengurusan && $kepengurusan->image)
                        <!-- Bagan Kepengurusan - Full Width -->
                        <div class="mb-10" data-aos="zoom-in">
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-br from-orange-300 to-orange-500 rounded-2xl blur opacity-20 group-hover:opacity-30 transition-opacity">
                                </div>
                                <div
                                    class="relative rounded-2xl overflow-hidden shadow-lg border border-gray-100 bg-white p-2">
                                    <img src="{{ Str::startsWith($kepengurusan->image, ['http://', 'https://']) ? $kepengurusan->image : asset($kepengurusan->image) }}"
                                        alt="{{ $kepengurusan->title }}" class="w-full h-auto object-contain rounded-xl">
                                </div>
                                <div class="mt-3 text-center">
                                    <span class="text-sm text-gray-500 font-medium">Bagan Struktur Kepengurusan PII</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Text Content -->
                    <div class="prose prose-lg prose-slate max-w-none text-gray-700 leading-[1.8]">
                        {!! $kepengurusan->content ??
                            '<p class="text-gray-500 italic">Konten struktur kepengurusan sedang dalam pengembangan.</p>' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-24 bg-gradient-to-r from-orange-500 to-orange-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23FFFFFF&quot; fill-opacity=&quot;0.1&quot;%3E%3Ccircle cx=&quot;30&quot; cy=&quot;30&quot; r=&quot;2&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="space-y-8" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Bergabunglah dengan <span class="block">Komunitas Insinyur Terbesar</span>
                </h2>
                <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                    Jadilah bagian dari organisasi profesional insinyur dan berkontribusi untuk kemajuan profesi
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
                    <a href="{{ route('tentang.struktur') }}"
                        class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 border border-white/20">
                        <span>Lihat Struktur Organisasi</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
