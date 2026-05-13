<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $heroes = Hero::where('is_active', true)->orderBy('id')->get();
        $beritas = Berita::where('is_active', true)->orderBy('published_at', 'desc')->take(5)->get();
        $galleries = \App\Models\Gallery::where('is_active', true)->orderBy('created_at', 'desc')->take(4)->get();
        $events = Event::where('is_active', true)->where('event_date', '>=', now())->orderBy('event_date', 'asc')->take(3)->get();

        return view('home', compact('heroes', 'beritas', 'galleries', 'events'));
    }
}
