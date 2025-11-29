@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Inscrição</h2>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $inscription->id }}</p>
            <p><strong>Evento:</strong> {{ $inscription->event->name ?? '—' }}</p>
            <p><strong>Ticket:</strong> {{ $inscription->ticket->name ?? '—' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($inscription->status) }}</p>

            <p><strong>QR Code:</strong> {{ $inscription->qr_code }}</p>

            <a href="{{ route('inscriptions.index', $inscription->user_id) }}" class="btn btn-secondary mt-2">
                Voltar
            </a>
        </div>
    </div>
</div>
@endsection
