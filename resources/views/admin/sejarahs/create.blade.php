@extends('layouts.app')

@section('title', 'Kelola Sejarah - Admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Kelola Sejarah PII</h1>
            <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
        </div>

        @if(session('success'))
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Panel 1: Sejarah Content -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Konten Sejarah</h2>
                <form action="{{ route('admin.sejarahs.store') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="text" name="title" value="{{ $sejarah->title ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                            <input type="text" name="period" value="{{ $sejarah->period ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                            <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            @if($sejarah->image ?? false)
                            <p class="text-xs text-gray-500 mt-1">Current: <a href="{{ Str::startsWith($sejarah->image, ['http://', 'https://']) ? $sejarah->image : asset($sejarah->image) }}" target="_blank" class="text-orange-500 hover:underline">View Image</a></p>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <textarea name="content" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ $sejarah->content ?? '' }}</textarea>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" {{ ($sejarah->is_active ?? true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>

                        <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Simpan Sejarah</button>
                    </div>
                </form>
            </div>

            <!-- Panel 2: Ketua Umum -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Ketua Umum PII</h2>
                
                <!-- Form Tambah Ketua Umum -->
                <form action="{{ route('admin.ketuaUmums.store') }}" method="POST" enctype="multipart/form-data" class="mb-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ketua Umum</label>
                            <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Periode</label>
                            <input type="text" name="period" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto</label>
                            <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                            <input type="number" name="order" value="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active_ketua" class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" checked>
                            <label for="is_active_ketua" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>

                        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition font-semibold">+ Tambah Ketua Umum</button>
                    </div>
                </form>

                <!-- Table Ketua Umum -->
                <div class="border-t pt-4">
                    <h3 class="font-semibold text-gray-900 mb-3">Daftar Ketua Umum</h3>
                    @if($ketuaUmums->count() > 0)
                    <div class="space-y-3">
                        @foreach($ketuaUmums as $ketuaUmum)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                @if($ketuaUmum->image)
                                <img src="{{ Str::startsWith($ketuaUmum->image, ['http://', 'https://']) ? $ketuaUmum->image : asset($ketuaUmum->image) }}" alt="{{ $ketuaUmum->name }}" class="w-12 h-12 object-cover rounded-full">
                                @else
                                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-xl">👤</div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $ketuaUmum->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $ketuaUmum->period }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('admin.ketuaUmums.update', $ketuaUmum->id) }}" method="POST" class="inline">
                                    @method('PUT')
                                    @csrf
                                    <input type="checkbox" name="is_active" {{ $ketuaUmum->is_active ? 'checked' : '' }} onchange="this.form.submit()" class="w-4 h-4 text-green-500 rounded">
                                </form>
                                <form action="{{ route('admin.ketuaUmums.delete', $ketuaUmum->id) }}" method="POST" class="inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Yakin ingin menghapus ketua umum ini?')">🗑️</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-gray-500 text-sm">Belum ada data ketua umum.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
