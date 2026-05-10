@extends('layouts.app')

@section('title', 'Edit Kontak - Admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Kontak</h1>
            <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('admin.kontaks.update', $kontak->id) }}" method="POST">
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <textarea name="address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ $kontak->address }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="text" name="phone" value="{{ $kontak->phone }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ $kontak->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                            <input type="text" name="facebook" value="{{ $kontak->facebook }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
                            <input type="text" name="twitter" value="{{ $kontak->twitter }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label>
                            <input type="text" name="instagram" value="{{ $kontak->instagram }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                            <input type="text" name="linkedin" value="{{ $kontak->linkedin }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">YouTube URL</label>
                            <input type="text" name="youtube" value="{{ $kontak->youtube }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Map URL (Embed)</label>
                            <textarea name="map_url" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ $kontak->map_url }}</textarea>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" {{ $kontak->is_active ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Update Kontak</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Preview</h2>
                <div id="preview" class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-[400px]">
                    <div class="flex items-start space-x-4 mb-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📍</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                            <p class="text-gray-600">{{ $kontak->address }}</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4 mb-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📞</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                            <p class="text-gray-600">{{ $kontak->phone }}</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4 mb-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">✉️</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                            <p class="text-gray-600">{{ $kontak->email }}</p>
                        </div>
                    </div>
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
    const address = document.querySelector('textarea[name="address"]').value;
    const phone = document.querySelector('input[name="phone"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const facebook = document.querySelector('input[name="facebook"]').value;
    const twitter = document.querySelector('input[name="twitter"]').value;
    const instagram = document.querySelector('input[name="instagram"]').value;
    const linkedin = document.querySelector('input[name="linkedin"]').value;
    const youtube = document.querySelector('input[name="youtube"]').value;

    let previewHTML = '';
    
    if (address) {
        previewHTML += `<div class="flex items-start space-x-4 mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-2xl">📍</span>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                <p class="text-gray-600">${address}</p>
            </div>
        </div>`;
    }
    
    if (phone) {
        previewHTML += `<div class="flex items-start space-x-4 mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-2xl">📞</span>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                <p class="text-gray-600">${phone}</p>
            </div>
        </div>`;
    }
    
    if (email) {
        previewHTML += `<div class="flex items-start space-x-4 mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-2xl">✉️</span>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                <p class="text-gray-600">${email}</p>
            </div>
        </div>`;
    }

    if (facebook || twitter || instagram || linkedin || youtube) {
        previewHTML += `<div class="mt-6">
            <h3 class="font-semibold text-gray-900 mb-4">Ikuti Kami</h3>
            <div class="flex space-x-4">`;
        
        if (facebook) {
            previewHTML += `<a href="${facebook}" target="_blank" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center">f</a>`;
        }
        if (twitter) {
            previewHTML += `<a href="${twitter}" target="_blank" class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center">X</a>`;
        }
        if (instagram) {
            previewHTML += `<a href="${instagram}" target="_blank" class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center">IG</a>`;
        }
        if (linkedin) {
            previewHTML += `<a href="${linkedin}" target="_blank" class="w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center">in</a>`;
        }
        if (youtube) {
            previewHTML += `<a href="${youtube}" target="_blank" class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center">YT</a>`;
        }
        
        previewHTML += `</div></div>`;
    }

    document.getElementById('preview').innerHTML = previewHTML;
}
</script>
@endsection
