@extends('layouts.app')

@section('title', 'Create Gallery - Admin')

@section('content')
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Create Gallery</h1>
                <a href="{{ route('admin.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" name="title"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                                <input type="file" name="image" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="description" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <input type="text" name="category"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                                <input type="number" name="order" value="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active"
                                    class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500" checked>
                                <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                            </div>

                            <button type="submit"
                                class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Create
                                Gallery</button>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Preview</h2>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-[400px]">
                        <div class="relative overflow-hidden rounded-2xl shadow-lg">
                            <img id="preview-img" src="" alt="Preview" class="w-full h-64 object-cover hidden">
                            <div id="preview-placeholder"
                                class="w-full h-64 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                                <span class="text-6xl">🖼️</span>
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex flex-col justify-end p-6 pointer-events-none">
                                <span id="preview-category"
                                    class="inline-block bg-orange-500 text-white text-xs px-3 py-1 rounded-full font-semibold mb-2 capitalize w-fit hidden"></span>
                                <h3 id="preview-title" class="text-white font-bold text-lg">Judul Gallery</h3>
                                <p id="preview-description" class="text-gray-200 text-sm mt-1 line-clamp-2"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const titleInput = document.querySelector('input[name="title"]');
            const imageInput = document.querySelector('input[name="image"]');
            const descInput = document.querySelector('textarea[name="description"]');
            const categoryInput = document.querySelector('input[name="category"]');

            const previewImg = document.getElementById('preview-img');
            const previewPlaceholder = document.getElementById('preview-placeholder');
            const previewTitle = document.getElementById('preview-title');
            const previewDesc = document.getElementById('preview-description');
            const previewCategory = document.getElementById('preview-category');

            titleInput.addEventListener('input', function() {
                previewTitle.textContent = this.value || 'Judul Gallery';
            });

            descInput.addEventListener('input', function() {
                previewDesc.textContent = this.value;
            });

            categoryInput.addEventListener('input', function() {
                if (this.value) {
                    previewCategory.textContent = this.value;
                    previewCategory.classList.remove('hidden');
                } else {
                    previewCategory.classList.add('hidden');
                }
            });

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        previewImg.src = ev.target.result;
                        previewImg.classList.remove('hidden');
                        previewPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImg.classList.add('hidden');
                    previewPlaceholder.classList.remove('hidden');
                }
            });
        })();
    </script>
