<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Layanan - Admin PII</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen">
        <!-- Admin Header -->
        <header class="bg-slate-900 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Admin Panel - PII</h1>
                    <a href="{{ route('admin.index') }}" class="text-orange-400 hover:text-orange-300 transition">
                        ← Kembali
                    </a>
                </div>
            </div>
        </header>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Layanan</h2>
                
                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.layanans.update', $layanan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $layanan->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ old('description', $layanan->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Icon (Emoji)</label>
                        <input type="text" name="icon" value="{{ old('icon', $layanan->icon) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required placeholder="Contoh: 👥">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">URL Gambar (Opsional)</label>
                        <input type="text" name="image" value="{{ old('image', $layanan->image) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="https://example.com/image.jpg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Link (Opsional)</label>
                        <input type="text" name="link" value="{{ old('link', $layanan->link) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="https://example.com">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Urutan</label>
                        <input type="number" name="order" value="{{ old('order', $layanan->order) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $layanan->is_active) ? 'checked' : '' }} class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500">
                            <span class="ml-2 text-gray-700">Aktif</span>
                        </label>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                            Update
                        </button>
                        <a href="{{ route('admin.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
