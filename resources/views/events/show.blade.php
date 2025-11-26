@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container">

    <a href="{{ route('events.index') }}" class="btn btn-secondary mb-4">
        ← Voltar para lista
    </a>

    <div class="card shadow-sm">

        {{-- Banner --}}
        @if($event->banner_image_url)
            <img src="{{ $event->banner_image_url }}" class="card-img-top" alt="Banner do evento">
        @else
            <div class="bg-secondary text-white text-center py-5">
                <h5>Sem imagem disponível</h5>
            </div>
        @endif

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="card-title">{{ $event->title }}</h1>

                {{-- Status --}}
                @php
                    $colors = [
                        'scheduled' => 'primary',
                        'on going'  => 'warning',
                        'done'      => 'success',
                        'cancelled' => 'danger'
                    ];
                @endphp

                <span class="badge bg-{{ $colors[$event->status] }} px-3 py-2">
                    {{ ucfirst($event->status) }}
                </span>
            </div>

            <p class="text-muted"><strong>Local:</strong> {{ $event->location }}</p>

            <p class="text-muted">
                <strong>Data:</strong>
                {{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y') }}
            </p>

            <hr>

            <h4>Descrição</h4>
            <p class="mt-2">{{ $event->description }}</p>

            <hr class="my-4">

            {{-- LISTA DE TICKETS --}}
            <div class="d-flex justify-content-between mb-2">
                <h4>Tickets do Evento</h4>

                <a href="{{ route('tickets.create', $event->id) }}" class="btn btn-primary">
                    + Criar Ticket
                </a>
            </div>

            @if($event->tickets->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($event->tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->name }}</td>
                            <td>R$ {{ number_format($ticket->price, 2, ',', '.') }}</td>
                            <td>{{ $ticket->quantity_total }}</td>

                            <td>
                                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>

                                <form action="{{ route('tickets.destroy', $ticket->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Excluir este ticket?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            @else
                <p class="text-muted">Nenhum ticket criado ainda.</p>
            @endif

        </div>

        <div class="card-footer d-flex justify-content-between">

            <a href="#" class="btn btn-outline-primary">Editar</a>

            <form action="#" method="POST"
                  onsubmit="return confirm('Tem certeza que deseja excluir este evento?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-outline-danger">
                    Excluir
                </button>
            </form>

        </div>

    </div>

</div>
@endsection
