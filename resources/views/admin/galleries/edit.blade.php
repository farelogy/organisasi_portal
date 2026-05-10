@extends('layouts.app')

@section('title', 'Edit Gallery - Admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Gallery</h1>
            <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" value="{{ $gallery->title }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika ingin mempertahankan gambar saat ini.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ $gallery->description }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <input type="text" name="category" value="{{ $gallery->category }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                            <input type="number" name="order" value="{{ $gallery->order }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" {{ $gallery->is_active ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Update Gallery</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Preview</h2>
                <div id="preview" class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-[400px]">
                    <img src="{{ $gallery->image }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover rounded-lg mb-4">
                    @if($gallery->category)
                    <span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded-full font-semibold mb-2 capitalize">{{ $gallery->category }}</span>
                    @endif
                    <h3 class="text-white font-bold text-lg">{{ $gallery->title }}</h3>
                    @if($gallery->description)
                    <p class="text-gray-200 text-sm mt-1 line-clamp-2">{{ $gallery->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('input, textarea').forEach(input => {
    input.addEventListener('input', updatePreview);
});

function updatePreview() {
    const title = document.querySelector('input[name="title"]').value;
    const imageInput = document.querySelector('input[name="image"]');
    const file = imageInput.files[0];
    const image = file ? URL.createObjectURL(file) : document.querySelector('input[name="image"]').getAttribute('data-current');
    const description = document.querySelector('textarea[name="description"]').value;
    const category = document.querySelector('input[name="category"]').value;

    let previewHTML = '';
    
    previewHTML += `<div class="group relative overflow-hidden rounded-2xl shadow-lg">`;
    
    if (image) {
        previewHTML += `<img src="${image}" alt="${title}" class="w-full h-64 object-cover">`;
    } else {
        previewHTML += `<div class="w-full h-64 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
            <span class="text-6xl">🖼️</span>
        </div>`;
    }
    
    previewHTML += `<div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-100 flex items-end p-6">`;
    
    if (category) {
        previewHTML += `<span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded-full font-semibold mb-2 capitalize">${category}</span>`;
    }
    
    if (title) {
        previewHTML += `<h3 class="text-white font-bold text-lg">${title}</h3>`;
    }
    
    if (description) {
        previewHTML += `<p class="text-gray-200 text-sm mt-1 line-clamp-2">${description}</p>`;
    }
    
    previewHTML += `</div></div>`;

    document.getElementById('preview').innerHTML = previewHTML;
}
</script>
