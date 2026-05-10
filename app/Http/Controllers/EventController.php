<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)->orderBy('event_date', 'desc')->get();
        return view('event.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event.show', compact('event'));
    }

    public function seminar()
    {
        $events = Event::where('type', 'seminar')->where('is_active', true)->orderBy('event_date', 'desc')->get();
        return view('event.seminar', compact('events'));
    }

    public function pelatihan()
    {
        $events = Event::where('type', 'pelatihan')->where('is_active', true)->orderBy('event_date', 'desc')->get();
        return view('event.pelatihan', compact('events'));
    }

    public function konvensi()
    {
        $events = Event::where('type', 'konvensi')->where('is_active', true)->orderBy('event_date', 'desc')->get();
        return view('event.konvensi', compact('events'));
    }
}
