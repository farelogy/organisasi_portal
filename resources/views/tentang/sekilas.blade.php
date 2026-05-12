@extends('layouts.app')

@section('title', 'Sekilas - PII')

@push('styles')
<style>
    .rich-content ol { list-style: decimal !important; padding-left: 1.5rem !important; margin: 0.75rem 0 !important; }
    .rich-content ul { list-style: disc !important; padding-left: 1.5rem !important; margin: 0.75rem 0 !important; }
    .rich-content li { display: list-item !important; margin: 0.25rem 0 !important; }
    .rich-content ol ol, .rich-content ol ul { list-style: lower-alpha !important; }
    .rich-content ul ul { list-style: circle !important; }
</style>
@endpush

@section('content')
<!-- Sekilas Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23FF6B35" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tentang PII
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">
                {{ $sekilas->title ?? 'Sekilas PII' }}
            </h1>
        </div>

        <!-- Content Card -->
        <div class="max-w-7xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 md:p-12 lg:p-16">

                @if($sekilas && $sekilas->image)
                <div class="float-left mr-8 mb-4 md:mr-10 md:mb-6 w-full md:w-80 lg:w-96">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-br from-orange-300 to-orange-500 rounded-xl blur opacity-30"></div>
                        @if($sekilas && $sekilas->image)
                        <div class="mb-8 rounded-2xl overflow-hidden shadow-lg">
                            <img src="{{ Str::startsWith($sekilas->image, ['http://', 'https://']) ? $sekilas->image : asset($sekilas->image) }}" alt="{{ $sekilas->title }}" class="w-full h-auto object-cover">
                        </div>
                        @endif
                        <div class="mt-2 text-center">
                            <span class="text-xs text-gray-500 font-medium">Dokumentasi PII</span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="rich-content prose prose-lg prose-slate max-w-none text-gray-700 leading-[1.8]">
                    {!! $sekilas->content ?? '<p class="text-gray-500 italic">Konten sekilas sedang dalam pengembangan.</p>' !!}
                </div>

                <div class="clear-both"></div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
@if($visiMisi)
<section class="py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,107,53,0.3) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,107,53,0.3) 0%, transparent 50%);"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-orange-500/20 backdrop-blur-sm text-orange-300 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Arah & Tujuan
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ $visiMisi->title }}
            </h2>
        </div>

        <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 md:p-12 border border-white/20">
                <div class="rich-content prose prose-lg prose-invert max-w-none text-gray-200 leading-[1.8]">
                    {!! $visiMisi->content !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-24 bg-gradient-to-r from-orange-500 to-orange-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23FFFFFF" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="space-y-8" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Bergabunglah dengan <span class="block">Komunitas Insinyur Terbesar</span>
            </h2>
            <p class="text-xl text-orange-100 mb-8 max-w-2xl mx-auto">
                Jadilah bagian dari PII yang terus berkembang dan berkontribusi untuk kemajuan profesi keinsinyuran di Indonesia
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}#kontak" class="inline-flex items-center px-8 py-4 bg-white text-orange-600 rounded-2xl font-semibold text-lg hover:bg-orange-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Hubungi Kami
                </a>
                <a href="{{ route('tentang.sejarah') }}" class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-2xl font-semibold text-lg hover:bg-white/20 transition-all duration-300 border border-white/20">
                    <span>Baca Sejarah PII</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
