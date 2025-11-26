<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('events.index', ['events' => Event::all()]);
    }

    public function create()
    {
        return view('events.organizer.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date_time' => 'required|date|after:now',
            'location' => 'required|string',
            'banner_image_url' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        Event::create($validatedData);

        return redirect()->route('events.index')
            ->with('success', 'Evento Criado com Sucesso!');
    }
    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
    }
}
