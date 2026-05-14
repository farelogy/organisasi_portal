<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KemitraanController;
use App\Http\Controllers\TentangPiiController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Clear cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');

    return 'Cache & view cleared!';
})->middleware('auth');

// Frontend routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tentang PII routes
Route::prefix('tentang')->name('tentang.')->group(function () {
    Route::get('/sejarah', [TentangPiiController::class, 'sejarah'])->name('sejarah');
    Route::get('/sekilas', [TentangPiiController::class, 'sekilas'])->name('sekilas');
    Route::get('/struktur', [TentangPiiController::class, 'struktur'])->name('struktur');
    Route::get('/kepengurusan', [TentangPiiController::class, 'kepengurusan'])->name('kepengurusan');
    Route::get('/kontak', [TentangPiiController::class, 'kontak'])->name('kontak');
});

// Event & Pelatihan routes
Route::prefix('event')->name('event.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/seminar', [EventController::class, 'seminar'])->name('seminar');
    Route::get('/pelatihan', [EventController::class, 'pelatihan'])->name('pelatihan');
    Route::get('/konferensi', [EventController::class, 'konferensi'])->name('konferensi');
    Route::get('/{id}', [EventController::class, 'show'])->name('show');
});

// Berita & Artikel routes
Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('index');
    Route::get('/artikel-teknik', [ArtikelController::class, 'artikelTeknik'])->name('artikel_teknik');
    Route::get('/regulasi', [ArtikelController::class, 'regulasi'])->name('regulasi');
    Route::get('/inovasi', [ArtikelController::class, 'inovasi'])->name('inovasi');
    Route::get('/opini', [ArtikelController::class, 'opini'])->name('opini');
    Route::get('/{id}', [ArtikelController::class, 'show'])->name('show');
});

// Gallery routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Kemitraan routes
Route::prefix('kemitraan')->name('kemitraan.')->group(function () {
    Route::get('/', [KemitraanController::class, 'index'])->name('index');
    Route::get('/kampus', [KemitraanController::class, 'kampus'])->name('kampus');
    Route::get('/industri', [KemitraanController::class, 'industri'])->name('industri');
    Route::get('/pemerintah', [KemitraanController::class, 'pemerintah'])->name('pemerintah');
});

// Admin routes with authentication middleware
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Hero routes
    Route::get('/heroes/create', [AdminController::class, 'createHero'])->name('heroes.create');
    Route::post('/heroes', [AdminController::class, 'storeHero'])->name('heroes.store');
    Route::get('/heroes/{id}/edit', [AdminController::class, 'editHero'])->name('heroes.edit');
    Route::put('/heroes/{id}', [AdminController::class, 'updateHero'])->name('heroes.update');
    Route::delete('/heroes/{id}', [AdminController::class, 'deleteHero'])->name('heroes.delete');

    
    // Berita routes
    Route::get('/beritas/create', [AdminController::class, 'createBerita'])->name('beritas.create');
    Route::post('/beritas', [AdminController::class, 'storeBerita'])->name('beritas.store');
    Route::get('/beritas/{id}/edit', [AdminController::class, 'editBerita'])->name('beritas.edit');
    Route::put('/beritas/{id}', [AdminController::class, 'updateBerita'])->name('beritas.update');
    Route::delete('/beritas/{id}', [AdminController::class, 'deleteBerita'])->name('beritas.delete');

    // ===== Admin-only routes (sejarah, sekila, visi-misi, struktur, kontak) =====
    Route::middleware('admin')->group(function () {
        // Sejarah routes
        Route::get('/sejarahs/create', [AdminController::class, 'createSejarah'])->name('sejarahs.create');
        Route::post('/sejarahs', [AdminController::class, 'storeSejarah'])->name('sejarahs.store');
        Route::get('/sejarahs/{id}/edit', [AdminController::class, 'editSejarah'])->name('sejarahs.edit');
        Route::put('/sejarahs/{id}', [AdminController::class, 'updateSejarah'])->name('sejarahs.update');

        // Sekila routes
        Route::get('/sekilas/create', [AdminController::class, 'createSekila'])->name('sekilas.create');
        Route::post('/sekilas', [AdminController::class, 'storeSekila'])->name('sekilas.store');
        Route::get('/sekilas/{id}/edit', [AdminController::class, 'editSekila'])->name('sekilas.edit');
        Route::put('/sekilas/{id}', [AdminController::class, 'updateSekila'])->name('sekilas.update');

        // Visi Misi routes
        Route::post('/visi-misis', [AdminController::class, 'storeVisiMisi'])->name('visiMisis.store');
        Route::put('/visi-misis/{id}', [AdminController::class, 'updateVisiMisi'])->name('visiMisis.update');

        // Struktur routes (single record for title/image)
        Route::post('/strukturs', [AdminController::class, 'storeStruktur'])->name('strukturs.store');

        // Struktur Organisasi Item routes (list data)
        Route::post('/struktur-items', [AdminController::class, 'storeStrukturItem'])->name('strukturItems.store');
        Route::put('/struktur-items/{id}', [AdminController::class, 'updateStrukturItem'])->name('strukturItems.update');
        Route::delete('/struktur-items/{id}', [AdminController::class, 'deleteStrukturItem'])->name('strukturItems.delete');

        // Kepengurusan routes (single record)
        Route::post('/kepengurusans', [AdminController::class, 'storeKepengurusan'])->name('kepengurusans.store');

        // Kontak routes (single record)
        Route::post('/kontaks', [AdminController::class, 'storeKontak'])->name('kontaks.store');
    });

    // Event routes
    Route::get('/events/create', [AdminController::class, 'createEvent'])->name('events.create');
    Route::post('/events', [AdminController::class, 'storeEvent'])->name('events.store');
    Route::get('/events/{id}/edit', [AdminController::class, 'editEvent'])->name('events.edit');
    Route::put('/events/{id}', [AdminController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{id}', [AdminController::class, 'deleteEvent'])->name('events.delete');

    // ===== Artikel routes (admin only) =====
    Route::middleware('admin')->group(function () {
        Route::get('/artikels/create', [AdminController::class, 'createArtikel'])->name('artikels.create');
        Route::post('/artikels', [AdminController::class, 'storeArtikel'])->name('artikels.store');
        Route::get('/artikels/{id}/edit', [AdminController::class, 'editArtikel'])->name('artikels.edit');
        Route::put('/artikels/{id}', [AdminController::class, 'updateArtikel'])->name('artikels.update');
    });

    // Gallery routes
    Route::get('/galleries/create', [AdminController::class, 'createGallery'])->name('galleries.create');
    Route::post('/galleries', [AdminController::class, 'storeGallery'])->name('galleries.store');
    Route::get('/galleries/{id}/edit', [AdminController::class, 'editGallery'])->name('galleries.edit');
    Route::put('/galleries/{id}', [AdminController::class, 'updateGallery'])->name('galleries.update');
    Route::delete('/galleries/{id}', [AdminController::class, 'deleteGallery'])->name('galleries.delete');

    // Kemitraan routes
    Route::get('/kemitraans/create', [AdminController::class, 'createKemitraan'])->name('kemitraans.create');
    Route::post('/kemitraans', [AdminController::class, 'storeKemitraan'])->name('kemitraans.store');
    Route::get('/kemitraans/{id}/edit', [AdminController::class, 'editKemitraan'])->name('kemitraans.edit');
    Route::put('/kemitraans/{id}', [AdminController::class, 'updateKemitraan'])->name('kemitraans.update');
    Route::delete('/kemitraans/{id}', [AdminController::class, 'deleteKemitraan'])->name('kemitraans.delete');

    // ===== Admin-only routes (ketua-umum, users, settings) =====
    Route::middleware('admin')->group(function () {
        // KetuaUmum routes
        Route::post('/ketua-umums', [AdminController::class, 'storeKetuaUmum'])->name('ketuaUmums.store');
        Route::put('/ketua-umums/{id}', [AdminController::class, 'updateKetuaUmum'])->name('ketuaUmums.update');
        Route::delete('/ketua-umums/{id}', [AdminController::class, 'deleteKetuaUmum'])->name('ketuaUmums.delete');

        // User management routes
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');

        // Settings route
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    });

    // Generic item API for AJAX
    Route::get('/items/{type}/{id}', [AdminController::class, 'getItem'])->name('items.get');
});
