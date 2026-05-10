@extends('layouts.app')

@section('title', 'Gallery - PII')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-500 to-orange-600 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Gallery</h1>
            <p class="text-xl text-orange-100">Galeri Foto Persatuan Insinyur Indonesia</p>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galleries as $gallery)
            <button type="button" onclick="openGalleryModal({{ $gallery->id }})" class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition text-left" data-aos="fade-up">
                <img src="{{ Str::startsWith($gallery->image, ['http://','https://']) ? $gallery->image : asset($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition flex items-end p-6">
                    <div>
                        @if($gallery->category)
                        <span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded-full font-semibold mb-2 capitalize">
                            {{ $gallery->category }}
                        </span>
                        @endif
                        <h3 class="text-white font-bold text-lg">{{ $gallery->title }}</h3>
                        @if($gallery->description)
                        <p class="text-gray-200 text-sm mt-1 line-clamp-2">{{ $gallery->description }}</p>
                        @endif
                    </div>
                </div>
            </button>
            @endforeach
        </div>

        <div id="gallery-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-4 backdrop-blur-sm">
            <div class="relative w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-2xl">
                <button type="button" onclick="closeGalleryModal()" class="absolute top-4 right-4 z-20 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-700 shadow hover:bg-gray-100">
                    <span class="text-2xl leading-none">×</span>
                </button>
                <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_0.8fr]">
                    <div class="relative h-96 lg:h-full">
                        <img id="modal-image" src="" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-8 flex flex-col justify-between">
                        <div>
                            <span id="modal-category" class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded-full font-semibold mb-4 uppercase tracking-wide"></span>
                            <h2 id="modal-title" class="text-3xl font-bold text-slate-900 mb-4"></h2>
                            <p id="modal-description" class="text-gray-700 leading-relaxed"></p>
                        </div>
                        <div class="mt-8">
                            <button type="button" onclick="closeGalleryModal()" class="inline-flex items-center justify-center w-full rounded-2xl border border-orange-500 bg-orange-500 px-6 py-3 text-white font-semibold hover:bg-orange-600 transition">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const galleryItems = [
                @foreach($galleries as $gallery)
                {
                    id: {{ $gallery->id }},
                    title: {{ json_encode($gallery->title) }},
                    description: {{ json_encode($gallery->description) }},
                    category: {{ json_encode($gallery->category) }},
                    image: {{ json_encode(Str::startsWith($gallery->image, ['http://','https://']) ? $gallery->image : asset($gallery->image)) }}
                }{{ $loop->last ? '' : ',' }}
                @endforeach
            ];

            function openGalleryModal(id) {
                const item = galleryItems.find(entry => entry.id === id);
                if (!item) return;
                document.getElementById('modal-image').src = item.image;
                document.getElementById('modal-image').alt = item.title;
                document.getElementById('modal-title').textContent = item.title;
                document.getElementById('modal-description').textContent = item.description || 'Tidak ada deskripsi tersedia.';
                document.getElementById('modal-category').textContent = item.category || 'Galeri PII';
                document.getElementById('gallery-modal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeGalleryModal() {
                document.getElementById('gallery-modal').classList.add('hidden');
                document.body.style.overflow = '';
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeGalleryModal();
                }
            });
        </script>
        @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada galeri. Silakan hubungi admin untuk menambahkan konten.</p>
        </div>
        @endif
    </div>
</section>
@endsection
