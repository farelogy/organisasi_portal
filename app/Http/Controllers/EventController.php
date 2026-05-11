<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Items per page for paginated event lists
     */
    private const PER_PAGE = 10;

    public function index(Request $request)
    {
        $events = Event::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->paginate(self::PER_PAGE);

        if ($request->ajax()) {
            return $this->ajaxListResponse($events);
        }

        return view('event.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event.show', compact('event'));
    }

    public function seminar(Request $request)
    {
        $events = Event::where('type', 'seminar')
            ->where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->paginate(self::PER_PAGE);

        if ($request->ajax()) {
            return $this->ajaxListResponse($events);
        }

        return view('event.seminar', compact('events'));
    }

    public function pelatihan(Request $request)
    {
        $events = Event::where('type', 'pelatihan')
            ->where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->paginate(self::PER_PAGE);

        if ($request->ajax()) {
            return $this->ajaxListResponse($events);
        }

        return view('event.pelatihan', compact('events'));
    }

    public function konvensi(Request $request)
    {
        $events = Event::where('type', 'konvensi')
            ->where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->paginate(self::PER_PAGE);

        if ($request->ajax()) {
            return $this->ajaxListResponse($events);
        }

        return view('event.konvensi', compact('events'));
    }

    /**
     * Render JSON response with HTML partial for AJAX pagination requests.
     */
    private function ajaxListResponse($events)
    {
        $html = view('event.partials.events-list', ['events' => $events])->render();
        return response()->json([
            'html' => $html,
            'hasMore' => $events->hasMorePages(),
        ]);
    }
}
