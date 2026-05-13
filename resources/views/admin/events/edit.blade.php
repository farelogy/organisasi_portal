@extends('layouts.app')

@section('title', 'Edit Event - Admin')

@section('content')
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Edit Event</h1>
                <a href="{{ route('admin.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Back to Admin</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                                <input type="text" name="title" value="{{ $event->title }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                <select name="type"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                                    <option value="seminar" {{ $event->type === 'seminar' ? 'selected' : '' }}>Seminar
                                    </option>
                                    <option value="pelatihan" {{ $event->type === 'pelatihan' ? 'selected' : '' }}>Pelatihan
                                    </option>
                                    <option value="konferensi" {{ $event->type === 'konferensi' ? 'selected' : '' }}>
                                        Konferensi</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="description" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>{{ $event->description }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                <textarea name="content" rows="6"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ $event->content }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                                <input type="text" name="image" value="{{ $event->image }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                                <input type="date" name="event_date"
                                    value="{{ $event->event_date ? $event->event_date->format('Y-m-d') : '' }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                <input type="text" name="location" value="{{ $event->location }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Registration Link</label>
                                <input type="text" name="link" value="{{ $event->link }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active"
                                    class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500"
                                    {{ $event->is_active ? 'checked' : '' }}>
                                <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                            </div>

                            <button type="submit"
                                class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition font-semibold">Update
                                Event</button>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Preview</h2>
                    <div id="preview" class="border-2 border-dashed border-gray-300 rounded-lg p-4 min-h-[400px]">
                        @if ($event->image)
                            <img src="{{ Str::startsWith($event->image, ['http://', 'https://']) ? $event->image : asset($event->image) }}"
                                alt="{{ $event->title }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        @else
                            <div
                                class="w-full h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center rounded-lg mb-4">
                                <span class="text-6xl">📅</span>
                            </div>
                        @endif
                        <div class="flex items-center justify-between mb-3">
                            <span
                                class="inline-block bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full font-semibold capitalize">{{ $event->type }}</span>
                            @if ($event->event_date)
                                <span class="text-sm text-gray-500">{{ $event->event_date->format('d M Y') }}</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $event->description }}</p>
                        @if ($event->location)
                            <div class="flex items-center text-gray-500 text-sm mb-4">
                                <span class="mr-2">📍</span>
                                {{ $event->location }}
                            </div>
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
            const title = document.querySelector('input[name="title"]').value;
            const type = document.querySelector('select[name="type"]').value;
            const description = document.querySelector('textarea[name="description"]').value;
            const image = document.querySelector('input[name="image"]').value;
            const eventDate = document.querySelector('input[name="event_date"]').value;
            const location = document.querySelector('input[name="location"]').value;

            let previewHTML = '';

            previewHTML += `<div class="bg-white rounded-2xl shadow-lg overflow-hidden">`;

            if (image) {
                previewHTML += `<img src="${image}" alt="${title}" class="w-full h-48 object-cover">`;
            } else {
                const icons = {
                    seminar: '🎤',
                    pelatihan: '🎓',
                    konferensi: '🏆'
                };
                previewHTML += `<div class="w-full h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
            <span class="text-6xl">${icons[type] || '📅'}</span>
        </div>`;
            }

            previewHTML += `<div class="p-6">`;

            previewHTML += `<div class="flex items-center justify-between mb-3">
        <span class="inline-block bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full font-semibold capitalize">${type}</span>
        ${eventDate ? `<span class="text-sm text-gray-500">${new Date(eventDate).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</span>` : ''}
    </div>`;

            if (title) {
                previewHTML += `<h3 class="text-xl font-bold text-gray-900 mb-2">${title}</h3>`;
            }

            if (description) {
                previewHTML += `<p class="text-gray-600 mb-4 line-clamp-2">${description}</p>`;
            }

            if (location) {
                previewHTML += `<div class="flex items-center text-gray-500 text-sm mb-4">
            <span class="mr-2">📍</span>
            ${location}
        </div>`;
            }

            previewHTML += `</div></div>`;

            document.getElementById('preview').innerHTML = previewHTML;
        }
    </script>
