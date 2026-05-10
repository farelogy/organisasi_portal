@extends('layouts.app')

@section('title', 'Create Artikel - Admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Create Artikel</h1>
            <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('admin.artikels.store') }}" method="POST">
                    @csrf
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
                            <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                <option value="artikel_teknik">Artikel Teknik</option>
                                <option value="regulasi">Regulasi Terbaru</option>
                                <option value="inovasi">Inovasi Teknologi</option>
                                <option value="opini">Opini</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                            <input type="text" name="author" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                            <textarea name="excerpt" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <textarea name="content" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                            <input type="text" name="image" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Published At</label>
                            <input type="date" name="published_at" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" checked>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Create Artikel</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Preview</h2>
                <div id="preview" class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-[400px]">
                    <p class="text-gray-500 text-center">Fill in the form to see preview</p>
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
    const title = document.querySelector('input[name="title"]').value;
    const category = document.querySelector('select[name="category"]').value;
    const author = document.querySelector('input[name="author"]').value;
    const excerpt = document.querySelector('textarea[name="excerpt"]').value;
    const image = document.querySelector('input[name="image"]').value;
    const publishedAt = document.querySelector('input[name="published_at"]').value;

    let previewHTML = '';
    
    previewHTML += `<div class="bg-white rounded-2xl shadow-lg overflow-hidden">`;
    
    if (image) {
        previewHTML += `<img src="${image}" alt="${title}" class="w-full h-48 object-cover">`;
    } else {
        previewHTML += `<div class="w-full h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
            <span class="text-6xl">📰</span>
        </div>`;
    }
    
    previewHTML += `<div class="p-6">`;
    
    previewHTML += `<div class="flex items-center justify-between mb-3">
        <span class="inline-block bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full font-semibold capitalize">${category.replace('_', ' ')}</span>
        ${publishedAt ? `<span class="text-sm text-gray-500">${new Date(publishedAt).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</span>` : ''}
    </div>`;
    
    if (title) {
        previewHTML += `<h3 class="text-xl font-bold text-gray-900 mb-2">${title}</h3>`;
    }
    
    if (author) {
        previewHTML += `<p class="text-gray-600 mb-2 text-sm">Oleh: ${author}</p>`;
    }
    
    if (excerpt) {
        previewHTML += `<p class="text-gray-600 mb-4 line-clamp-2">${excerpt}</p>`;
    }
    
    previewHTML += `</div></div>`;

    if (!title) {
        previewHTML = '<p class="text-gray-500 text-center">Fill in the form to see preview</p>';
    }

    document.getElementById('preview').innerHTML = previewHTML;
}
</script>
