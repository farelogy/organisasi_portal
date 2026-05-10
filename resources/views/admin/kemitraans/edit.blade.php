@extends('layouts.app')

@section('title', 'Edit Kemitraan - Admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Kemitraan</h1>
            <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('admin.kemitraans.update', $kemitraan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" value="{{ $kemitraan->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                <option value="kerjasama_kampus" {{ $kemitraan->type === 'kerjasama_kampus' ? 'selected' : '' }}>Kerjasama Kampus</option>
                                <option value="kerjasama_industri" {{ $kemitraan->type === 'kerjasama_industri' ? 'selected' : '' }}>Kerjasama Industri</option>
                                <option value="program_pemerintah" {{ $kemitraan->type === 'program_pemerintah' ? 'selected' : '' }}>Program Pemerintah</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ $kemitraan->description }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <textarea name="content" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ $kemitraan->content }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Logo URL</label>
                            <input type="text" name="logo" value="{{ $kemitraan->logo }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Website Link</label>
                            <input type="text" name="link" value="{{ $kemitraan->link }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                            <input type="number" name="order" value="{{ $kemitraan->order }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" {{ $kemitraan->is_active ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Update Kemitraan</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Preview</h2>
                <div id="preview" class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-[400px]">
                    @if($kemitraan->logo)
                    <img src="{{ $kemitraan->logo }}" alt="{{ $kemitraan->name }}" class="w-32 h-32 object-contain bg-white rounded-xl p-4 mb-4 mx-auto">
                    @else
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg mx-auto mb-4">
                        <span class="text-4xl">🤝</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between mb-3">
                        <span class="inline-block bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full font-semibold capitalize">{{ str_replace('_', ' ', $kemitraan->type) }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $kemitraan->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $kemitraan->description }}</p>
                    @if($kemitraan->link)
                    <a href="{{ $kemitraan->link }}" target="_blank" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition">
                        Kunjungi Website
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('input, textarea, select').forEach(input => {
    input.addEventListener('input', updatePreview);
});

function updatePreview() {
    const name = document.querySelector('input[name="name"]').value;
    const type = document.querySelector('select[name="type"]').value;
    const description = document.querySelector('textarea[name="description"]').value;
    const logo = document.querySelector('input[name="logo"]').value;
    const link = document.querySelector('input[name="link"]').value;

    let previewHTML = '';
    
    previewHTML += `<div class="bg-white rounded-2xl shadow-lg overflow-hidden">`;
    
    previewHTML += `<div class="h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">`;
    
    if (logo) {
        previewHTML += `<img src="${logo}" alt="${name}" class="w-32 h-32 object-contain bg-white rounded-xl p-4">`;
    } else {
        previewHTML += `<div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
            <span class="text-4xl">🤝</span>
        </div>`;
    }
    
    previewHTML += `</div><div class="p-6">`;
    
    previewHTML += `<div class="flex items-center justify-between mb-3">
        <span class="inline-block bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full font-semibold capitalize">${type.replace('_', ' ')}</span>
    </div>`;
    
    if (name) {
        previewHTML += `<h3 class="text-xl font-bold text-gray-900 mb-2">${name}</h3>`;
    }
    
    if (description) {
        previewHTML += `<p class="text-gray-600 mb-4 line-clamp-3">${description}</p>`;
    }
    
    if (link) {
        previewHTML += `<a href="${link}" target="_blank" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600 transition">
            Kunjungi Website
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>`;
    }
    
    previewHTML += `</div></div>`;

    document.getElementById('preview').innerHTML = previewHTML;
}
</script>
