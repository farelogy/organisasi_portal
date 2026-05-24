<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Berita;
use Illuminate\Support\Facades\Cache;

class ArtikelController extends Controller
{
    /**
     * Cache duration in seconds (5 minutes)
     */
    private const CACHE_DURATION = 300;

    /**
     * Columns to select for list views (optimize query performance)
     */
    private const LIST_COLUMNS = ['id', 'slug', 'title', 'excerpt', 'category', 'author', 'image', 'published_at', 'is_active'];

    public function index(Request $request)
    {
        // Don't cache paginator object - query fresh each time
        // Cache only the HTML output for AJAX requests
        $page = $request->get('page', 1);

        $artikels = Berita::select(self::LIST_COLUMNS)
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            $cacheKey = "artikel_index_html_page_{$page}";
            $html = Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($artikels) {
                return view('artikel.partials.articles-list', ['artikels' => $artikels])->render();
            });

            return response()->json([
                'html' => $html,
                'hasMore' => $artikels->hasMorePages()
            ]);
        }

        return view('artikel.index', compact('artikels'));
    }

    public function show($slug)
    {
        $artikel = Berita::where('slug', $slug)->firstOrFail();
        return view('artikel.show', compact('artikel'));
    }

    public function artikelTeknik(Request $request)
    {
        $page = $request->get('page', 1);

        $artikels = Berita::select(self::LIST_COLUMNS)
            ->where('category', 'artikel_teknik')
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            $cacheKey = "artikel_teknik_html_page_{$page}";
            $html = Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($artikels) {
                return view('artikel.partials.articles-list', ['artikels' => $artikels])->render();
            });

            return response()->json([
                'html' => $html,
                'hasMore' => $artikels->hasMorePages()
            ]);
        }

        return view('artikel.artikel_teknik', compact('artikels'));
    }

    public function regulasi(Request $request)
    {
        $page = $request->get('page', 1);

        $artikels = Berita::select(self::LIST_COLUMNS)
            ->where('category', 'regulasi')
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            $cacheKey = "artikel_regulasi_html_page_{$page}";
            $html = Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($artikels) {
                return view('artikel.partials.articles-list', ['artikels' => $artikels])->render();
            });

            return response()->json([
                'html' => $html,
                'hasMore' => $artikels->hasMorePages()
            ]);
        }

        return view('artikel.regulasi', compact('artikels'));
    }

    public function inovasi(Request $request)
    {
        $page = $request->get('page', 1);

        $artikels = Berita::select(self::LIST_COLUMNS)
            ->where('category', 'inovasi')
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            $cacheKey = "artikel_inovasi_html_page_{$page}";
            $html = Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($artikels) {
                return view('artikel.partials.articles-list', ['artikels' => $artikels])->render();
            });

            return response()->json([
                'html' => $html,
                'hasMore' => $artikels->hasMorePages()
            ]);
        }

        return view('artikel.inovasi', compact('artikels'));
    }

    public function opini(Request $request)
    {
        $page = $request->get('page', 1);

        $artikels = Berita::select(self::LIST_COLUMNS)
            ->where('category', 'opini')
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            $cacheKey = "artikel_opini_html_page_{$page}";
            $html = Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($artikels) {
                return view('artikel.partials.articles-list', ['artikels' => $artikels])->render();
            });

            return response()->json([
                'html' => $html,
                'hasMore' => $artikels->hasMorePages()
            ]);
        }

        return view('artikel.opini', compact('artikels'));
    }
}
