@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Inscrição no Evento: {{ $event->title }}</h2>

        <form action="{{ route('inscriptions.store') }}" method="POST">
            @csrf

            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <div class="mb-3">
                <label for="ticket_id" class="form-label">Selecione um Ticket:</label>
                <select name="ticket_id" id="ticket_id" class="form-control" required>
                    <option value="">Escolha...</option>

                    @foreach ($tickets as $ticket)
                        <option value="{{ $ticket->id }}">
                            {{ $ticket->name }} —
                            @if ($ticket->price > 0)
                                R$ {{ number_format($ticket->price, 2, ',', '.') }}
                            @else
                                Gratuito
                            @endif
                        </option>
                    @endforeach

                </select>

                @error('ticket_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary">Confirmar Inscrição</button>

        </form>

    </div>
@endsection
