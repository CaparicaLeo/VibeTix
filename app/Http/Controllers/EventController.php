<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        if ($request->hasFile('banner_file')) {
            $path = $request->file('banner_file')->store('banners', 'public');
            $data['banner_image_url'] = Storage::url($path);
        } elseif ($request->banner_image_url) {
            $data['banner_image_url'] = $request->banner_image_url;
        }
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

        if (Auth::check() && Auth::user()->role === 'organizer' && Auth::id() === $event->organizer_id) {
            return view('events.organizer.show', compact('event'));
        }

        return view('events.show', compact('event'));
    }
    public function edit(Event $event)
    {
        return view('events.organizer.edit', compact('event'));
    }
}
