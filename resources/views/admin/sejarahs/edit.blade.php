@extends('layouts.app')

@section('title', 'Edit Sejarah - Admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Sejarah</h1>
            <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Form -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('admin.sejarahs.update', $sejarah->id) }}" method="POST">
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
                            <input type="text" name="title" value="{{ $sejarah->title }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                            <input type="text" name="period" value="{{ $sejarah->period }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                            <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @if($sejarah->image)
                            <p class="text-xs text-gray-500 mt-1">Current: <a href="{{ $sejarah->image }}" target="_blank" class="text-orange-500 hover:underline">View Image</a></p>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <textarea name="content" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ $sejarah->content }}</textarea>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" {{ $sejarah->is_active ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Update Sejarah</button>
                    </div>
                </form>
            </div>

            <!-- Preview -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Preview</h2>
                <div id="preview" class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-[400px]">
                    @if($sejarah->image)
                    <img src="{{ $sejarah->image }}" alt="{{ $sejarah->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    @endif
                    @if($sejarah->period)
                    <div class="bg-orange-100 text-orange-800 px-4 py-2 rounded-lg inline-block mb-4 font-semibold">{{ $sejarah->period }}</div>
                    @endif
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $sejarah->title }}</h2>
                    <div class="text-gray-700 leading-relaxed">{{ $sejarah->content }}</div>
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
    const period = document.querySelector('input[name="period"]').value;
    const imageInput = document.querySelector('input[name="image"]');
    const content = document.querySelector('textarea[name="content"]').value;

    let previewHTML = '';
    
    if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewHTML = `<img src="${e.target.result}" alt="${title}" class="w-full h-48 object-cover rounded-lg mb-4">`;
            
            if (period) {
                previewHTML += `<div class="bg-orange-100 text-orange-800 px-4 py-2 rounded-lg inline-block mb-4 font-semibold">${period}</div>`;
            }
            
            if (title) {
                previewHTML += `<h2 class="text-2xl font-bold text-gray-900 mb-4">${title}</h2>`;
            }
            
            if (content) {
                previewHTML += `<div class="text-gray-700 leading-relaxed">${content}</div>`;
            }

            document.getElementById('preview').innerHTML = previewHTML;
        }
        reader.readAsDataURL(imageInput.files[0]);
    } else {
        @if($sejarah->image)
        previewHTML = `<img src="{{ $sejarah->image }}" alt="{{ $sejarah->title }}" class="w-full h-48 object-cover rounded-lg mb-4">`;
        @endif
        
        if (period) {
            previewHTML += `<div class="bg-orange-100 text-orange-800 px-4 py-2 rounded-lg inline-block mb-4 font-semibold">${period}</div>`;
        }
        
        if (title) {
            previewHTML += `<h2 class="text-2xl font-bold text-gray-900 mb-4">${title}</h2>`;
        }
        
        if (content) {
            previewHTML += `<div class="text-gray-700 leading-relaxed">${content}</div>`;
        }

        document.getElementById('preview').innerHTML = previewHTML;
    }
}
</script>
@endsection
