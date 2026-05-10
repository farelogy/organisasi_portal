@extends('layouts.app')

@section('title', 'Edit Struktur Organisasi - Admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Struktur Organisasi</h1>
            <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('admin.strukturs.update', $struktur->id) }}" method="POST">
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
                            <input type="text" name="name" value="{{ $struktur->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                            <input type="text" name="position" value="{{ $struktur->position }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Photo URL</label>
                            <input type="text" name="photo" value="{{ $struktur->photo }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ $struktur->description }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                            <input type="number" name="order" value="{{ $struktur->order }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" {{ $struktur->is_active ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Update Struktur</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Preview</h2>
                <div id="preview" class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-[400px]">
                    @if($struktur->photo)
                    <img src="{{ $struktur->photo }}" alt="{{ $struktur->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center rounded-lg mb-4">
                        <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-4xl">👤</span>
                        </div>
                    </div>
                    @endif
                    <p class="text-orange-500 font-semibold mb-2">{{ $struktur->position }}</p>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $struktur->name }}</h3>
                    @if($struktur->description)
                    <p class="text-gray-600 text-sm">{{ $struktur->description }}</p>
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
    const name = document.querySelector('input[name="name"]').value;
    const position = document.querySelector('input[name="position"]').value;
    const photo = document.querySelector('input[name="photo"]').value;
    const description = document.querySelector('textarea[name="description"]').value;

    let previewHTML = '';
    
    previewHTML += `<div class="bg-white rounded-2xl shadow-lg overflow-hidden">`;
    
    if (photo) {
        previewHTML += `<img src="${photo}" alt="${name}" class="w-full h-48 object-cover">`;
    } else {
        previewHTML += `<div class="w-full h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                <span class="text-4xl">👤</span>
            </div>
        </div>`;
    }
    
    previewHTML += `<div class="p-6">`;
    
    if (position) {
        previewHTML += `<p class="text-orange-500 font-semibold mb-2">${position}</p>`;
    }
    
    if (name) {
        previewHTML += `<h3 class="text-xl font-bold text-gray-900 mb-2">${name}</h3>`;
    }
    
    if (description) {
        previewHTML += `<p class="text-gray-600 text-sm">${description}</p>`;
    }
    
    previewHTML += `</div></div>`;

    document.getElementById('preview').innerHTML = previewHTML;
}
</script>
@endsection
