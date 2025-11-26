@extends('layouts.app')

@section('title', 'Criar Ticket')

@section('content')
    <div class="container">

        <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary mb-4">
            ← Voltar para o evento
        </a>

        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="mb-0">Criar Ticket para: <strong>{{ $event->title }}</strong></h3>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tickets.store', $event->id) }}" method="POST">
                    @csrf

                    {{-- Tipo do Ticket --}}
                    <div class="mb-3">
                        <label class="form-label">Tipo do Ticket</label>
                        <input type="text" name="name" class="form-control"
                            placeholder="Ex: Inteira, Meia, VIP, Camarote" value="{{ old('name') }}" required>
                    </div>

                    {{-- Preço --}}
                    <div class="mb-3">
                        <label class="form-label">Preço (R$)</label>
                        <input type="number" step="0.01" min="0" name="price" class="form-control"
                            placeholder="Ex: 50.00" value="{{ old('price') }}" required>
                    </div>

                    {{-- Quantidade --}}
                    <div class="mb-3">
                        <label class="form-label">Quantidade disponível</label>
                        <input type="number" min="1" name="quantity_total" class="form-control" placeholder="Ex: 100"
                            value="{{ old('quantity_total') }}" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Criar Ticket
                    </button>

                </form>
            </div>
        </div>

    </div>
@endsection
