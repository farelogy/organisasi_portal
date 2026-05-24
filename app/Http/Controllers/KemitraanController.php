<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kemitraan;

class KemitraanController extends Controller
{
    public function index()
    {
        $kemitraans = Kemitraan::where('is_active', true)->orderBy('order')->paginate(12);
        return view('kemitraan.index', compact('kemitraans'));
    }

    public function kampus()
    {
        $kemitraans = Kemitraan::where('type', 'kerjasama_kampus')->where('is_active', true)->orderBy('order')->paginate(12);
        return view('kemitraan.kampus', compact('kemitraans'));
    }

    public function industri()
    {
        $kemitraans = Kemitraan::where('type', 'kerjasama_industri')->where('is_active', true)->orderBy('order')->paginate(12);
        return view('kemitraan.industri', compact('kemitraans'));
    }

    public function pemerintah()
    {
        $kemitraans = Kemitraan::where('type', 'program_pemerintah')->where('is_active', true)->orderBy('order')->paginate(12);
        return view('kemitraan.pemerintah', compact('kemitraans'));
    }

    public function show($slug)
    {
        $kemitraan = Kemitraan::where('slug', $slug)->firstOrFail();
        return view('kemitraan.show', compact('kemitraan'));
    }
}
