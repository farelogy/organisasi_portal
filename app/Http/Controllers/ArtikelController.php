<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('is_active', true)->orderBy('published_at', 'desc')->paginate(10);
        return view('artikel.index', compact('artikels'));
    }

    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('artikel.show', compact('artikel'));
    }

    public function artikelTeknik()
    {
        $artikels = Artikel::where('category', 'artikel_teknik')->where('is_active', true)->orderBy('published_at', 'desc')->paginate(10);
        return view('artikel.artikel_teknik', compact('artikels'));
    }

    public function regulasi()
    {
        $artikels = Artikel::where('category', 'regulasi')->where('is_active', true)->orderBy('published_at', 'desc')->paginate(10);
        return view('artikel.regulasi', compact('artikels'));
    }

    public function inovasi()
    {
        $artikels = Artikel::where('category', 'inovasi')->where('is_active', true)->orderBy('published_at', 'desc')->paginate(10);
        return view('artikel.inovasi', compact('artikels'));
    }

    public function opini()
    {
        $artikels = Artikel::where('category', 'opini')->where('is_active', true)->orderBy('published_at', 'desc')->paginate(10);
        return view('artikel.opini', compact('artikels'));
    }
}
