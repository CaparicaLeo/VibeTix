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

                {{-- Status com badge colorido --}}
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

            <p class="text-muted">
                <strong>Local:</strong> {{ $event->location }}
            </p>

            <p class="text-muted">
                <strong>Data:</strong>
                {{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y') }}
            </p>

            <hr>

            <h4>Descrição</h4>
            <p class="mt-2">{{ $event->description }}</p>

        </div>

        <div class="card-footer d-flex justify-content-between">

            {{-- Botão de Editar --}}
            <a href="#" class="btn btn-outline-primary">Editar</a>

            {{-- Botão de Excluir --}}
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
