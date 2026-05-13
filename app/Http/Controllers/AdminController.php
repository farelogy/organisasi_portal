<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Berita;
use App\Models\Sejarah;
use App\Models\Sekila;
use App\Models\StrukturOrganisasi;
use App\Models\StrukturKepengurusan;
use App\Models\Kontak;
use App\Models\Event;
use App\Models\Artikel;
use App\Models\Gallery;
use App\Models\Kemitraan;
use App\Models\StrukturOrganisasiItem;
use App\Models\KetuaUmum;
use App\Models\User;
use App\Models\VisiMisi;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    /**
     * Columns to select for admin list views
     */
    private const ADMIN_LIST_COLUMNS = ['id', 'title', 'category', 'sub_category', 'author', 'excerpt', 'image', 'is_active', 'published_at', 'created_at'];

    public function index()
    {
        // Query fresh data for admin panel - no caching to avoid serialization issues
        $heroes = Hero::all();
        // Don't cache paginator - query fresh each time
        $beritas = Berita::select(self::ADMIN_LIST_COLUMNS)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $sejarah = Sejarah::first();
        $sekilas = Sekila::first();
        $strukturs = StrukturOrganisasi::first();
        $kepengurusans = StrukturKepengurusan::first();
        $kontaks = Kontak::first();
        $events = Event::orderBy('event_date', 'desc')
            ->paginate(10, ['*'], 'events_page');
        $artikels = Artikel::all();
        $galleries = Gallery::orderBy('order')
            ->paginate(10, ['*'], 'galleries_page');
        $kemitraans = Kemitraan::orderBy('order')->paginate(10, ['*'], 'kemitraans_page');
        $strukturItems = StrukturOrganisasiItem::orderBy('order')->paginate(10, ['*'], 'struktur_items_page');
        $ketuaUmums = KetuaUmum::orderBy('order')->get();
        $users = User::orderBy('name')->paginate(10, ['*'], 'users_page');
        $visiMisis = VisiMisi::first();

        return view('admin.index', compact(
            'heroes', 'beritas', 'sejarah', 'sekilas',
            'strukturs', 'kepengurusans', 'kontaks', 'events', 'artikels', 'galleries', 'kemitraans', 'strukturItems', 'ketuaUmums', 'users', 'visiMisis'
        ));
    }

    private $modelMap = [
        'heroes' => \App\Models\Hero::class,
        'beritas' => \App\Models\Berita::class,
        'sejarahs' => \App\Models\Sejarah::class,
        'sekilas' => \App\Models\Sekila::class,
        'strukturs' => \App\Models\StrukturOrganisasi::class,
        'kepengurusans' => \App\Models\StrukturKepengurusan::class,
        'kontaks' => \App\Models\Kontak::class,
        'events' => \App\Models\Event::class,
        'artikels' => \App\Models\Artikel::class,
        'galleries' => \App\Models\Gallery::class,
        'kemitraans' => \App\Models\Kemitraan::class,
        'struktur-items' => \App\Models\StrukturOrganisasiItem::class,
        'ketuaUmums' => \App\Models\KetuaUmum::class,
        'users' => \App\Models\User::class,
        'visi-misis' => \App\Models\VisiMisi::class,
    ];

    private function ajaxResponse(Request $request, $message, $route = 'admin.index')
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => $message]);
        }
        return redirect()->route($route)->with('success', $message);
    }

    public function getItem($type, $id)
    {
        if (!isset($this->modelMap[$type])) {
            return response()->json(['error' => 'Invalid type'], 404);
        }

        $item = $this->modelMap[$type]::findOrFail($id);
        return response()->json($item);
    }

    // Hero methods
    public function createHero()
    {
        return view('admin.heroes.create');
    }

    public function storeHero(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Auto-prefix https:// if user didn't include protocol
        if (!empty($validated['button_link']) && !preg_match('/^https?:\/\//i', $validated['button_link'])) {
            $validated['button_link'] = 'https://' . $validated['button_link'];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/heroes'), $imageName);
            $validated['image'] = 'uploads/heroes/' . $imageName;
        }

        Hero::create($validated);

        return $this->ajaxResponse($request, 'Hero berhasil ditambahkan.');
    }

    public function editHero($id)
    {
        $hero = Hero::findOrFail($id);
        return view('admin.heroes.edit', compact('hero'));
    }

    public function updateHero(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Auto-prefix https:// if user didn't include protocol
        if (!empty($validated['button_link']) && !preg_match('/^https?:\/\//i', $validated['button_link'])) {
            $validated['button_link'] = 'https://' . $validated['button_link'];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteUploadedFile($hero->image);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/heroes'), $imageName);
            $validated['image'] = 'uploads/heroes/' . $imageName;
        }

        $hero->update($validated);

        return $this->ajaxResponse($request, 'Hero berhasil diperbarui.');
    }

    public function deleteHero(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        // Delete image file if exists
        $this->deleteUploadedFile($hero->image);

        $hero->delete();

        return $this->ajaxResponse($request, 'Hero berhasil dihapus.');
    }

    
    // Berita methods
    public function createBerita()
    {
        return view('admin.beritas.create');
    }

    public function storeBerita(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:50',
            'sub_category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // Auto-generate excerpt from content (strip HTML and limit to 150 chars)
        if (!empty($validated['content'])) {
            $plainText = strip_tags($validated['content']);
            $validated['excerpt'] = substr($plainText, 0, 150) . (strlen($plainText) > 150 ? '...' : '');
        } else {
            $validated['excerpt'] = '';
        }

        // Set author from authenticated user
        $validated['author'] = auth()->user()->name ?? 'Admin';

        // Handle image upload (same pattern as Ketua Umum / Hero)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/beritas'), $imageName);
            $validated['image'] = 'uploads/beritas/' . $imageName;
        } else {
            $validated['image'] = null;
        }

        $validated['published_at'] = now();
        $validated['is_active'] = $request->boolean('is_active', true);

        Berita::create($validated);

        // Clear all article caches
        $this->clearArticleCache();

        return response()->json(['success' => true, 'message' => 'Berita berhasil ditambahkan.']);
    }

    public function editBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.beritas.edit', compact('berita'));
    }

    public function updateBerita(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:50',
            'sub_category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // Auto-generate excerpt from content (strip HTML and limit to 150 chars)
        if (!empty($validated['content'])) {
            $plainText = strip_tags($validated['content']);
            $validated['excerpt'] = substr($plainText, 0, 150) . (strlen($plainText) > 150 ? '...' : '');
        }

        // Handle image upload (same pattern as Ketua Umum / Hero)
        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteUploadedFile($berita->image);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/beritas'), $imageName);
            $validated['image'] = 'uploads/beritas/' . $imageName;
        } else {
            unset($validated['image']); // Keep existing image
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $berita->update($validated);

        // Clear all article caches
        $this->clearArticleCache();

        return $this->ajaxResponse($request, 'Berita berhasil diperbarui.');
    }

    public function deleteBerita($id)
    {
        $berita = Berita::findOrFail($id);

        // Delete image file if exists
        $this->deleteUploadedFile($berita->image);

        $berita->delete();

        // Clear all article caches
        $this->clearArticleCache();

        // Clear all article caches
        $this->clearArticleCache();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Berita berhasil dihapus.']);
        }

        // Get current page from request
        $currentPage = request()->get('page', 1);
        
        // Check if current page is still valid after deletion
        $totalItems = Berita::count();
        $perPage = 10;
        $lastPage = max(1, ceil($totalItems / $perPage));
        
        // If current page exceeds last page, redirect to last page, otherwise stay on current page
        $redirectPage = min($currentPage, $lastPage);
        $redirectUrl = url('/admin?page=' . $redirectPage . '#tab=beritas');
        return redirect($redirectUrl)->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Safely delete an uploaded file from public/ directory.
     * Skips external URLs (http/https) and missing files.
     */
    private function deleteUploadedFile(?string $path): void
    {
        if (empty($path)) {
            return;
        }

        // Skip external URLs
        if (preg_match('/^https?:\/\//i', $path)) {
            return;
        }

        // Normalize: strip leading slashes and any URL prefix
        $relativePath = ltrim(parse_url($path, PHP_URL_PATH) ?? $path, '/');

        // Restrict deletion to the uploads directory only (safety)
        if (!str_starts_with($relativePath, 'uploads/')) {
            return;
        }

        $fullPath = public_path($relativePath);
        if (file_exists($fullPath) && is_file($fullPath)) {
            @unlink($fullPath);
        }
    }

    /**
     * Clear all article-related cache keys
     */
    private function clearArticleCache(): void
    {
        // Clear HTML output cache for all article pages
        $cachePrefixes = [
            'artikel_index_html_page_',
            'artikel_teknik_html_page_',
            'artikel_regulasi_html_page_',
            'artikel_inovasi_html_page_',
            'artikel_opini_html_page_',
        ];

        // Clear cache for first 20 pages of each type
        foreach ($cachePrefixes as $prefix) {
            for ($i = 1; $i <= 20; $i++) {
                Cache::forget($prefix . $i);
            }
        }
    }

    // Sejarah methods
    public function createSejarah()
    {
        $sejarah = Sejarah::first();
        $ketuaUmums = KetuaUmum::orderBy('order')->get();
        return view('admin.sejarahs.create', compact('sejarah', 'ketuaUmums'));
    }

    public function storeSejarah(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // If sejarah exists, update it, otherwise create new
        $sejarah = Sejarah::first();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($sejarah) {
                $this->deleteUploadedFile($sejarah->image_path ?? $sejarah->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sejarah'), $imageName);
            $validated['image_path'] = 'uploads/sejarah/' . $imageName;
            $validated['image'] = 'uploads/sejarah/' . $imageName;
        }

        if ($sejarah) {
            $sejarah->update($validated);
        } else {
            Sejarah::create($validated);
        }

        return $this->ajaxResponse($request, 'Sejarah berhasil disimpan.');
    }

    public function editSejarah($id)
    {
        $sejarah = Sejarah::findOrFail($id);
        $ketuaUmums = KetuaUmum::orderBy('order')->get();
        return view('admin.sejarahs.edit', compact('sejarah', 'ketuaUmums'));
    }

    public function updateSejarah(Request $request, $id)
    {
        $sejarah = Sejarah::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteUploadedFile($sejarah->image_path ?? $sejarah->image);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sejarah'), $imageName);
            $validated['image_path'] = 'uploads/sejarah/' . $imageName;
            $validated['image'] = 'uploads/sejarah/' . $imageName;
        }

        $sejarah->update($validated);

        return $this->ajaxResponse($request, 'Sejarah berhasil diperbarui.');
    }

    // KetuaUmum methods
    public function storeKetuaUmum(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'period' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/ketua-umum'), $imageName);
            $validated['image_path'] = 'uploads/ketua-umum/' . $imageName;
            $validated['image'] = 'uploads/ketua-umum/' . $imageName;
        }

        KetuaUmum::create($validated);

        return $this->ajaxResponse($request, 'Ketua Umum berhasil ditambahkan.', 'admin.sejarahs.create');
    }

    public function updateKetuaUmum(Request $request, $id)
    {
        $ketuaUmum = KetuaUmum::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'period' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteUploadedFile($ketuaUmum->image_path ?? $ketuaUmum->image);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/ketua-umum'), $imageName);
            $validated['image_path'] = 'uploads/ketua-umum/' . $imageName;
            $validated['image'] = 'uploads/ketua-umum/' . $imageName;
        }

        $ketuaUmum->update($validated);

        return $this->ajaxResponse($request, 'Ketua Umum berhasil diperbarui.', 'admin.sejarahs.create');
    }

    public function deleteKetuaUmum(Request $request, $id)
    {
        $ketuaUmum = KetuaUmum::findOrFail($id);

        // Delete image if exists
        $this->deleteUploadedFile($ketuaUmum->image_path ?? $ketuaUmum->image);

        $ketuaUmum->delete();

        return $this->ajaxResponse($request, 'Ketua Umum berhasil dihapus.');
    }

    // Sekila methods
    public function createSekila()
    {
        return view('admin.sekilas.create');
    }

    public function storeSekila(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // Single record: update existing or create new
        $existing = Sekila::first();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($existing) {
                $this->deleteUploadedFile($existing->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sekilas'), $imageName);
            $validated['image'] = 'uploads/sekilas/' . $imageName;
        } else {
            $validated['image'] = null;
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($existing) {
            $existing->update($validated);
        } else {
            Sekila::create($validated);
        }

        return $this->ajaxResponse($request, 'Sekilas berhasil disimpan.');
    }

    public function editSekila($id)
    {
        $sekila = Sekila::findOrFail($id);
        return view('admin.sekilas.edit', compact('sekila'));
    }

    public function updateSekila(Request $request, $id)
    {
        $sekila = Sekila::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteUploadedFile($sekila->image);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sekilas'), $imageName);
            $validated['image'] = 'uploads/sekilas/' . $imageName;
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $sekila->update($validated);

        return $this->ajaxResponse($request, 'Sekilas berhasil diperbarui.');
    }

    // Visi Misi methods
    public function storeVisiMisi(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        // Single record: update existing or create new
        $existing = VisiMisi::first();
        if ($existing) {
            $existing->update($validated);
        } else {
            VisiMisi::create($validated);
        }

        return $this->ajaxResponse($request, 'Visi & Misi berhasil disimpan.');
    }

    public function updateVisiMisi(Request $request, $id)
    {
        $visiMisi = VisiMisi::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $visiMisi->update($validated);

        return $this->ajaxResponse($request, 'Visi & Misi berhasil diperbarui.');
    }

    // Struktur Organisasi methods (single record for title/image)
    public function storeStruktur(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // Single record: update if exists, otherwise create
        $struktur = StrukturOrganisasi::first();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($struktur) {
                $this->deleteUploadedFile($struktur->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/struktur'), $imageName);
            $validated['image'] = 'uploads/struktur/' . $imageName;
        }

        if ($struktur) {
            $struktur->update($validated);
        } else {
            StrukturOrganisasi::create($validated);
        }

        return $this->ajaxResponse($request, 'Struktur Organisasi berhasil disimpan.');
    }

    // Struktur Organisasi Item methods (list data like Kemitraan, without type/description)
    public function storeStrukturItem(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link' => 'nullable|url|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '_struktur_item.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/struktur_items'), $imageName);
            $validated['logo'] = 'uploads/struktur_items/' . $imageName;
        } else {
            unset($validated['logo']);
        }

        StrukturOrganisasiItem::create($validated);

        return $this->ajaxResponse($request, 'Item Struktur Organisasi berhasil ditambahkan.');
    }

    public function updateStrukturItem(Request $request, $id)
    {
        $item = StrukturOrganisasiItem::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link' => 'nullable|url|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $this->deleteUploadedFile($item->logo);

            $image = $request->file('logo');
            $imageName = time() . '_struktur_item.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/struktur_items'), $imageName);
            $validated['logo'] = 'uploads/struktur_items/' . $imageName;
        } else {
            unset($validated['logo']);
        }

        $item->update($validated);

        return $this->ajaxResponse($request, 'Item Struktur Organisasi berhasil diperbarui.');
    }

    public function deleteStrukturItem(Request $request, $id)
    {
        $item = StrukturOrganisasiItem::findOrFail($id);

        $this->deleteUploadedFile($item->logo);

        $item->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Item Struktur Organisasi berhasil dihapus.']);
        }

        $currentPage = (int) $request->input('struktur_items_page', 1);
        $totalItems = StrukturOrganisasiItem::count();
        $perPage = 10;
        $lastPage = max(1, (int) ceil($totalItems / $perPage));
        $redirectPage = min(max(1, $currentPage), $lastPage);

        $redirectUrl = url('/admin?struktur_items_page=' . $redirectPage . '#tab=strukturs');
        return redirect($redirectUrl)->with('success', 'Item Struktur Organisasi berhasil dihapus.');
    }

    // Struktur Kepengurusan methods (single record)
    public function storeKepengurusan(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $kepengurusan = StrukturKepengurusan::first();

        if ($request->hasFile('image')) {
            if ($kepengurusan) {
                $this->deleteUploadedFile($kepengurusan->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/kepengurusan'), $imageName);
            $validated['image'] = 'uploads/kepengurusan/' . $imageName;
        }

        if ($kepengurusan) {
            $kepengurusan->update($validated);
        } else {
            StrukturKepengurusan::create($validated);
        }

        return $this->ajaxResponse($request, 'Struktur Kepengurusan berhasil disimpan.');
    }

    // Kontak methods (single record)
    public function storeKontak(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'map_url' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $kontak = Kontak::first();
        if ($kontak) {
            $kontak->update($validated);
        } else {
            Kontak::create($validated);
        }

        return $this->ajaxResponse($request, 'Kontak berhasil disimpan.');
    }

    // Event methods
    public function createEvent()
    {
        return view('admin.events.create');
    }

    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'sub_category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Auto-generate description from content
        if (!empty($validated['content'])) {
            $validated['description'] = substr(strip_tags($validated['content']), 0, 200) . (strlen(strip_tags($validated['content'])) > 200 ? '...' : '');
        } else {
            $validated['description'] = '';
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/events'), $imageName);
            $validated['image'] = 'uploads/events/' . $imageName;
        } else {
            $validated['image'] = null;
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        Event::create($validated);

        return $this->ajaxResponse($request, 'Event berhasil ditambahkan.');
    }

    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'sub_category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        if (!empty($validated['content'])) {
            $validated['description'] = substr(strip_tags($validated['content']), 0, 200) . (strlen(strip_tags($validated['content'])) > 200 ? '...' : '');
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteUploadedFile($event->image);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/events'), $imageName);
            $validated['image'] = 'uploads/events/' . $imageName;
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $event->update($validated);

        return $this->ajaxResponse($request, 'Event berhasil diperbarui.');
    }

    public function deleteEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // Delete image file if exists
        $this->deleteUploadedFile($event->image);

        $event->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Event berhasil dihapus.']);
        }
        $currentPage = (int) $request->input('events_page', 1);

        // Pastikan page saat ini masih valid setelah penghapusan
        $totalItems = Event::count();
        $perPage = 10;
        $lastPage = max(1, (int) ceil($totalItems / $perPage));
        $redirectPage = min(max(1, $currentPage), $lastPage);

        $redirectUrl = url('/admin?events_page=' . $redirectPage . '#tab=events');
        return redirect($redirectUrl)->with('success', 'Event berhasil dihapus.');
    }

    // Artikel methods
    public function createArtikel()
    {
        return view('admin.artikels.create');
    }

    public function storeArtikel(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'required|string',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        Artikel::create($validated);

        return $this->ajaxResponse($request, 'Artikel berhasil ditambahkan.');
    }

    public function editArtikel($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikels.edit', compact('artikel'));
    }

    public function updateArtikel(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'required|string',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $artikel->update($validated);

        return $this->ajaxResponse($request, 'Artikel berhasil diperbarui.');
    }

    // Gallery methods
    public function createGallery()
    {
        return view('admin.galleries.create');
    }

    public function storeGallery(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '', $image->getClientOriginalName());
            $image->move(public_path('uploads/galleries'), $imageName);
            $validated['image'] = '/uploads/galleries/' . $imageName;
        }

        Gallery::create($validated);

        return $this->ajaxResponse($request, 'Gallery berhasil ditambahkan.');
    }

    public function editGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function updateGallery(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            $this->deleteUploadedFile($gallery->image);

            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '', $image->getClientOriginalName());
            $image->move(public_path('uploads/galleries'), $imageName);
            $validated['image'] = '/uploads/galleries/' . $imageName;
        } else {
            $validated['image'] = $gallery->image;
        }

        $gallery->update($validated);

        return $this->ajaxResponse($request, 'Gallery berhasil diperbarui.');
    }

    public function deleteGallery(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete image file if exists
        $this->deleteUploadedFile($gallery->image);

        $gallery->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Gallery berhasil dihapus.']);
        }
        $currentPage = (int) $request->input('galleries_page', 1);

        // Pastikan page saat ini masih valid setelah penghapusan
        $totalItems = Gallery::count();
        $perPage = 10;
        $lastPage = max(1, (int) ceil($totalItems / $perPage));
        $redirectPage = min(max(1, $currentPage), $lastPage);

        $redirectUrl = url('/admin?galleries_page=' . $redirectPage . '#tab=galleries');
        return redirect($redirectUrl)->with('success', 'Gallery berhasil dihapus.');
    }

    // Kemitraan methods
    public function createKemitraan()
    {
        return view('admin.kemitraans.create');
    }

    public function storeKemitraan(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '_kemitraan.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/kemitraans'), $imageName);
            $validated['logo'] = 'uploads/kemitraans/' . $imageName;
        } else {
            unset($validated['logo']);
        }

        Kemitraan::create($validated);

        return $this->ajaxResponse($request, 'Kemitraan berhasil ditambahkan.');
    }

    public function editKemitraan($id)
    {
        $kemitraan = Kemitraan::findOrFail($id);
        return view('admin.kemitraans.edit', compact('kemitraan'));
    }

    public function updateKemitraan(Request $request, $id)
    {
        $kemitraan = Kemitraan::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            $this->deleteUploadedFile($kemitraan->logo);

            $image = $request->file('logo');
            $imageName = time() . '_kemitraan.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/kemitraans'), $imageName);
            $validated['logo'] = 'uploads/kemitraans/' . $imageName;
        } else {
            unset($validated['logo']);
        }

        $kemitraan->update($validated);

        return $this->ajaxResponse($request, 'Kemitraan berhasil diperbarui.');
    }

    public function deleteKemitraan(Request $request, $id)
    {
        $kemitraan = Kemitraan::findOrFail($id);

        // Delete logo file if exists
        $this->deleteUploadedFile($kemitraan->logo);

        $kemitraan->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Kemitraan berhasil dihapus.']);
        }

        $currentPage = (int) $request->input('kemitraans_page', 1);
        $totalItems = Kemitraan::count();
        $perPage = 10;
        $lastPage = max(1, (int) ceil($totalItems / $perPage));
        $redirectPage = min(max(1, $currentPage), $lastPage);

        $redirectUrl = url('/admin?kemitraans_page=' . $redirectPage . '#tab=kemitraans');
        return redirect($redirectUrl)->with('success', 'Kemitraan berhasil dihapus.');
    }

    // User management methods
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'required|same:password',
            'role' => 'required|string|in:admin,user',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return $this->ajaxResponse($request, 'User berhasil ditambahkan.');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => ['nullable', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'nullable|same:password',
            'role' => 'required|string|in:admin,user',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return $this->ajaxResponse($request, 'User berhasil diperbarui.');
    }

    // Settings methods
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'nullable|string|max:255',
            'footer_description' => 'nullable|string',
            'footer_copyright' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'site_logo_secondary' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:png,ico,svg,jpeg,jpg,webp|max:2048',
            'member_registration_link' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            $this->deleteUploadedFile(Setting::where('key', 'site_logo')->value('value'));

            $image = $request->file('site_logo');
            $imageName = time() . '_logo.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $imageName);
            $validated['site_logo'] = 'uploads/settings/' . $imageName;
        } else {
            unset($validated['site_logo']);
        }

        if ($request->hasFile('site_logo_secondary')) {
            // Delete old secondary logo if exists
            $this->deleteUploadedFile(Setting::where('key', 'site_logo_secondary')->value('value'));

            $image = $request->file('site_logo_secondary');
            $imageName = time() . '_logo_secondary.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $imageName);
            $validated['site_logo_secondary'] = 'uploads/settings/' . $imageName;
        } else {
            unset($validated['site_logo_secondary']);
        }

        if ($request->hasFile('site_favicon')) {
            // Delete old favicon if exists
            $this->deleteUploadedFile(Setting::where('key', 'site_favicon')->value('value'));

            $favicon = $request->file('site_favicon');
            $ext = strtolower($favicon->getClientOriginalExtension());
            $uploadPath = public_path('uploads/settings');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // SVG and ICO: save as-is (cannot resize with GD)
            if (in_array($ext, ['svg', 'ico'])) {
                $faviconName = time() . '_favicon.' . $ext;
                $favicon->move($uploadPath, $faviconName);
                $validated['site_favicon'] = 'uploads/settings/' . $faviconName;
            } else {
                // Auto-resize raster images to 64x64 PNG using GD
                $faviconName = time() . '_favicon.png';
                $targetPath = $uploadPath . DIRECTORY_SEPARATOR . $faviconName;
                $sourcePath = $favicon->getRealPath();

                $sourceImage = null;
                switch ($ext) {
                    case 'jpeg':
                    case 'jpg':
                        $sourceImage = @imagecreatefromjpeg($sourcePath);
                        break;
                    case 'png':
                        $sourceImage = @imagecreatefrompng($sourcePath);
                        break;
                    case 'webp':
                        $sourceImage = function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($sourcePath) : null;
                        break;
                    case 'gif':
                        $sourceImage = @imagecreatefromgif($sourcePath);
                        break;
                }

                if ($sourceImage) {
                    $size = 64;
                    $srcW = imagesx($sourceImage);
                    $srcH = imagesy($sourceImage);
                    $resized = imagecreatetruecolor($size, $size);
                    // Preserve transparency
                    imagealphablending($resized, false);
                    imagesavealpha($resized, true);
                    $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
                    imagefilledrectangle($resized, 0, 0, $size, $size, $transparent);
                    imagecopyresampled($resized, $sourceImage, 0, 0, 0, 0, $size, $size, $srcW, $srcH);
                    imagepng($resized, $targetPath, 9);
                    imagedestroy($resized);
                    imagedestroy($sourceImage);
                    $validated['site_favicon'] = 'uploads/settings/' . $faviconName;
                } else {
                    // Fallback: save original if GD fails
                    $faviconName = time() . '_favicon.' . $ext;
                    $favicon->move($uploadPath, $faviconName);
                    $validated['site_favicon'] = 'uploads/settings/' . $faviconName;
                }
            }
        } else {
            unset($validated['site_favicon']);
        }

        // Handle quick links (5 inputs)
        $quickLinks = [];
        for ($i = 1; $i <= 5; $i++) {
            $label = $request->input("quick_link_label_$i");
            $url = $request->input("quick_link_url_$i");
            if (!empty($label) && !empty($url)) {
                $quickLinks[] = ['label' => $label, 'url' => $url];
            }
        }
        $validated['footer_quick_links'] = json_encode($quickLinks);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan situs berhasil diperbarui.');
    }
}
