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
    public function update(Request $request, Event $event)
    {
        // Verificar se o usuário é o organizador do evento
        if (Auth::id() !== $event->organizer_id) {
            abort(403, 'Você não tem permissão para editar este evento.');
        }

        // Validar os dados
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,active,cancelled,completed',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        // Processar upload de banner (se houver)
        if ($request->hasFile('banner_image')) {
            // Deletar banner antigo se existir
            if ($event->banner_image_url) {
                $oldPath = str_replace('/storage/', '', $event->banner_image_url);
                Storage::disk('public')->delete($oldPath);
            }

            // Fazer upload do novo banner
            $path = $request->file('banner_image')->store('banners', 'public');
            $validatedData['banner_image_url'] = Storage::url($path);
        }

        // Atualizar o evento
        $event->update($validatedData);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Evento atualizado com sucesso!');
    }
    public function destroy(Event $event)
    {
        // Verificar se o usuário é o organizador do evento
        if (Auth::id() !== $event->organizer_id) {
            abort(403, 'Você não tem permissão para excluir este evento.');
        }

        // Deletar banner se existir
        if ($event->banner_image_url) {
            $oldPath = str_replace('/storage/', '', $event->banner_image_url);
            Storage::disk('public')->delete($oldPath);
        }

        // Deletar o evento (e tickets em cascata se configurado)
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Evento excluído com sucesso!');
    }
}
