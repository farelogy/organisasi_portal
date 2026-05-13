<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PII - Persatuan Insinyur Indonesia')</title>
    @if (isset($site_settings['site_favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset($site_settings['site_favicon']) }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-orange-100 shadow-lg sticky top-0 z-50 rounded-b-2xl">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="flex items-center space-x-2">
                            @if (isset($site_settings['site_logo']))
                                <img src="{{ asset($site_settings['site_logo']) }}" alt="Logo Utama"
                                    class="w-14 h-14 object-contain flex-shrink-0">
                            @else
                                <div class="w-14 h-14 bg-orange-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">PI</span>
                                </div>
                            @endif

                            @if (isset($site_settings['site_logo_secondary']))
                                <img src="{{ asset($site_settings['site_logo_secondary']) }}" alt="Logo Kedua"
                                    class="w-14 h-14 object-contain flex-shrink-0">
                            @else
                                <div class="w-14 h-14 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">I</span>
                                </div>
                            @endif
                        </div>
                        <span
                            class="text-lg md:text-xl font-bold text-gray-800 max-w-[140px] sm:max-w-[200px] md:max-w-[280px] lg:max-w-[350px] whitespace-normal leading-tight">{{ $site_settings['site_title'] ?? '' }}</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition font-medium">Beranda</a>

                    <!-- Tentang PII Dropdown -->
                    <div class="relative group">
                        <button
                            class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition font-medium flex items-center">
                            Tentang PII
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('tentang.sejarah') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-t-lg">Sejarah</a>
                            <a href="{{ route('tentang.sekilas') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500">Sekilas</a>
                            <a href="{{ route('tentang.struktur') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500">Struktur
                                Organisasi</a>
                            <a href="{{ route('tentang.kepengurusan') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500">
                                Kepengurusan</a>
                            <a href="{{ route('tentang.kontak') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-b-lg">Kontak</a>
                        </div>
                    </div>

                    <!-- Event & Pelatihan Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('event.index') }}"
                            class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition font-medium flex items-center">
                            Event & Pelatihan
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('event.seminar') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-t-lg">Seminar</a>
                            <a href="{{ route('event.pelatihan') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500">Pelatihan</a>
                            <a href="{{ route('event.konferensi') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-b-lg">Konferensi</a>
                        </div>
                    </div>

                    <!-- Berita & Artikel Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('artikel.index') }}"
                            class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition font-medium flex items-center">
                            Berita & Artikel
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('artikel.artikel_teknik') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-t-lg">Artikel
                                Teknik</a>
                            <a href="{{ route('artikel.regulasi') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500">Regulasi
                                Terbaru</a>
                            <a href="{{ route('artikel.inovasi') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500">Inovasi
                                Teknologi</a>
                            <a href="{{ route('artikel.opini') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-b-lg">Opini</a>
                        </div>
                    </div>

                    <!-- Gallery -->
                    <a href="{{ route('gallery.index') }}"
                        class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition font-medium">Gallery</a>

                    <!-- Kemitraan Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('kemitraan.index') }}"
                            class="px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition font-medium flex items-center">
                            Kemitraan
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('kemitraan.kampus') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-t-lg">Kerjasama
                                Kampus</a>
                            <a href="{{ route('kemitraan.industri') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500">Kerjasama
                                Industri</a>
                            <a href="{{ route('kemitraan.pemerintah') }}"
                                class="block px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 rounded-b-lg">Program
                                Pemerintah</a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn"
                        class="p-2 rounded-lg text-gray-700 hover:text-orange-500 hover:bg-orange-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}"
                    class="block px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg">Beranda</a>
                <div class="px-4 py-2">
                    <span class="text-gray-700 font-medium">Tentang PII</span>
                    <div class="ml-4 mt-2 space-y-1">
                        <a href="{{ route('tentang.sejarah') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Sejarah</a>
                        <a href="{{ route('tentang.sekilas') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Sekilas</a>
                        <a href="{{ route('tentang.struktur') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Struktur Organisasi</a>
                        <a href="{{ route('tentang.kepengurusan') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Kepengurusan</a>
                        <a href="{{ route('tentang.kontak') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Kontak</a>
                    </div>
                </div>
                <div class="px-4 py-2">
                    <a href="{{ route('event.index') }}"
                        class="text-gray-700 font-medium hover:text-orange-500 block">Event & Pelatihan</a>
                    <div class="ml-4 mt-2 space-y-1">
                        <a href="{{ route('event.seminar') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Seminar</a>
                        <a href="{{ route('event.pelatihan') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Pelatihan</a>
                        <a href="{{ route('event.konferensi') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Konferensi</a>
                    </div>
                </div>
                <div class="px-4 py-2">
                    <a href="{{ route('artikel.index') }}"
                        class="text-gray-700 font-medium hover:text-orange-500 block">Berita & Artikel</a>
                    <div class="ml-4 mt-2 space-y-1">
                        <a href="{{ route('artikel.artikel_teknik') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Artikel Teknik</a>
                        <a href="{{ route('artikel.regulasi') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Regulasi Terbaru</a>
                        <a href="{{ route('artikel.inovasi') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Inovasi Teknologi</a>
                        <a href="{{ route('artikel.opini') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Opini</a>
                    </div>
                </div>
                <a href="{{ route('gallery.index') }}"
                    class="block px-4 py-2 text-gray-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg">Gallery</a>
                <div class="px-4 py-2">
                    <a href="{{ route('kemitraan.index') }}"
                        class="text-gray-700 font-medium hover:text-orange-500 block">Kemitraan</a>
                    <div class="ml-4 mt-2 space-y-1">
                        <a href="{{ route('kemitraan.kampus') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Kerjasama Kampus</a>
                        <a href="{{ route('kemitraan.industri') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Kerjasama Industri</a>
                        <a href="{{ route('kemitraan.pemerintah') }}"
                            class="block px-4 py-2 text-gray-600 hover:text-orange-500">Program Pemerintah</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="flex items-center space-x-2">
                            @if (isset($site_settings['site_logo']))
                                <div
                                    class="w-12 h-12 rounded-lg p-1 bg-orange-500/20 backdrop-blur-sm border border-orange-400/30">
                                    <img src="{{ asset($site_settings['site_logo']) }}" alt="Logo Utama"
                                        class="w-full h-full object-contain">
                                </div>
                            @else
                                <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">PI</span>
                                </div>
                            @endif

                            @if (isset($site_settings['site_logo_secondary']))
                                <div
                                    class="w-12 h-12 rounded-lg p-1 bg-orange-500/20 backdrop-blur-sm border border-orange-400/30">
                                    <img src="{{ asset($site_settings['site_logo_secondary']) }}" alt="Logo Kedua"
                                        class="w-full h-full object-contain">
                                </div>
                            @else
                                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">I</span>
                                </div>
                            @endif
                        </div>
                        <span class="text-xl font-bold">{{ $site_settings['site_title'] ?? '' }}</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        {{ $site_settings['footer_description'] ?? 'Wadah persatuan dan kesatuan insinyur Indonesia untuk memajukan profesi keinsinyuran dan berkontribusi bagi pembangunan bangsa.' }}
                    </p>
                    <div class="flex space-x-4">
                        @if($footer_kontak && !empty($footer_kontak->facebook))
                        <a href="{{ $footer_kontak->facebook }}" target="_blank"
                            class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        @endif
                        @if($footer_kontak && !empty($footer_kontak->twitter))
                        <a href="{{ $footer_kontak->twitter }}" target="_blank"
                            class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        @endif
                        @if($footer_kontak && !empty($footer_kontak->instagram))
                        <a href="{{ $footer_kontak->instagram }}" target="_blank"
                            class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        @endif
                        @if($footer_kontak && !empty($footer_kontak->youtube))
                        <a href="{{ $footer_kontak->youtube }}" target="_blank"
                            class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z" />
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                @php
                    $quick_links = isset($site_settings['footer_quick_links'])
                        ? json_decode($site_settings['footer_quick_links'], true)
                        : [];
                @endphp
                @if (!empty($quick_links))
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-orange-500">Tautan Cepat</h3>
                        <ul class="space-y-2">
                            @foreach ($quick_links as $link)
                                <li><a href="{{ $link['url'] }}"
                                        class="text-gray-400 hover:text-orange-500 transition">{{ $link['label'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-orange-500">Hubungi Kami</h3>
                    @if ($footer_kontak)
                        <ul class="space-y-3">
                            @if ($footer_kontak->address)
                                <li class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-orange-500 mt-1 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-gray-400">{{ $footer_kontak->address }}</span>
                                </li>
                            @endif
                            @if ($footer_kontak->phone)
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-400">{{ $footer_kontak->phone }}</span>
                                </li>
                            @endif
                            @if ($footer_kontak->email)
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-orange-500 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-400">{{ $footer_kontak->email }}</span>
                                </li>
                            @endif
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm">Belum ada data kontak.</p>
                    @endif
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }}
                    {{ $site_settings['footer_copyright'] ?? 'Persatuan Insinyur Indonesia. Hak Cipta Dilindungi.' }}
                </p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
