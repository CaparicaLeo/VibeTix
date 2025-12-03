<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Inscription;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $inscriptions = Inscription::where('user_id', $user->id)->with('event', 'ticket')->get();
        return view('inscriptions.index', compact('inscriptions'));
    }
    public function show(Inscription $inscription)
    {
        return view('inscriptions.show', compact('inscription'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|uuid|exists:events,id',
            'ticket_id' => 'required|uuid|exists:tickets,id',
        ]);

        $ticket = \App\Models\Ticket::find($data['ticket_id']);
        if ($ticket->event_id !== $data['event_id']) {
            return back()->withErrors(['ticket_id' => 'O ticket selecionado não pertence a este evento.']);
        }

        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';
        $data['qr_code'] = Str::uuid();

        Inscription::create($data);
        return redirect()->route('inscriptions.index', ['user' => $data['user_id']]);
    }
    public function create(Event $event)
    {
        $tickets = $event->tickets;

        return view('inscriptions.create', compact('event', 'tickets'));
    }
}
