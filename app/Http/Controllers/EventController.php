<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->role === 'organizer') {
            $validatedData['organizer_id'] = Auth::id();
        }

        Event::create($validatedData);

        return redirect()->route('events.index')
            ->with('success', 'Evento Criado com Sucesso!');
    }
    public function show(Event $event)
    {
        $event->load('tickets');

        if(Auth::check() && Auth::user()->role ==='organizer'){
            return view('events.organizer.show', compact('event'));
        }

        return view('events.show', compact('event'));
    }
}
