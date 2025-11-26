@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
    <div class="container">

        <h1 class="mb-4">Lista de Eventos</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('events.create') }}" class="btn btn-primary mb-4">
            Criar Novo Evento
        </a>

        @if ($events->count() > 0)

            <div class="row g-4">
                @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">

                            {{-- Banner do evento --}}
                            @if ($event->banner_image_url)
                                <img src="{{ $event->banner_image_url }}" class="card-img-top" alt="Banner">
                            @else
                                <div class="bg-secondary text-white text-center py-4">
                                    Sem imagem
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>

                                <p class="card-text text-muted mb-1">
                                    {{ $event->location }}
                                </p>

                                <p class="card-text">
                                    <strong>Data:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y') }}
                                </p>

                                {{-- Badge para status --}}
                                @php
                                    $colors = [
                                        'scheduled' => 'primary',
                                        'on going' => 'warning',
                                        'done' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                @endphp

                                <span class="badge bg-{{ $colors[$event->status] }}">
                                    {{ ucfirst($event->status) }}
                                </span>

                                <p class="mt-3 text-truncate" style="max-width: 100%;">
                                    {{ $event->description }}
                                </p>
                            </div>

                            <div class="card-footer text-end">
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-secondary">Ver
                                    detalhes</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Nenhum evento cadastrado.</p>
        @endif

    </div>
@endsection
