<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Event $event)
    {
        $tickets = Ticket::where('event_id', $event->id)->get();

        return view('events.show', compact('event', 'tickets'));
    }
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity_total' => 'required|integer|min:1',
        ]);

        $event->tickets()->create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity_total' => $request->input('quantity_total'),
        ]);

        return redirect()->route('events.show', $event)->with('success', 'Ticket created successfully.');
    }
    public function create(Event $event)
    {
        return view('tickets.create', compact('event'));
    }
    public function edit(Ticket $ticket)
    {
        //
    }
    public function destroy(Ticket $ticket)
    {
        //
    }
}
