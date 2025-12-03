@extends('layouts.app')

@section('content')
    <div class="container">

        <h1 class="mb-4">{{ $event->title }}</h1>

        <p class="text-muted">{{ $event->description }}</p>

        <hr>

        <h3 class="mt-4">Ingressos disponíveis</h3>

        @if ($event->tickets->count() === 0)
            <p class="text-muted">Nenhum ticket cadastrado para este evento.</p>
        @endif

        <div class="row mt-3">

            @foreach ($event->tickets as $ticket)
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">

                        <div class="card-body">
                            <h5 class="card-title">{{ $ticket->name }}</h5>

                            <p class="card-text">
                                <strong>Preço:</strong>
                                @if ($ticket->price > 0)
                                    R$ {{ number_format($ticket->price, 2, ',', '.') }}
                                @else
                                    Gratuito
                                @endif
                            </p>

                            <form method="POST" action="{{ route('inscriptions.create') }}">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                <button type="submit" class="btn btn-primary w-100">
                                    Inscrever-se com este ticket
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection
