<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_active', true)->orderBy('order')->get();
        return view('gallery.index', compact('galleries'));
    }
}
