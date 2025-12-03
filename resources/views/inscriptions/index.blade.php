@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Minhas Inscrições</h2>

    @if ($inscriptions->isEmpty())
        <p>Nenhuma inscrição encontrada.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Ticket</th>
                    <th>Status</th>
                    <th>QR Code</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inscriptions as $inscription)
                    <tr>
                        <td>{{ $inscription->event->name ?? '—' }}</td>
                        <td>{{ $inscription->ticket->name ?? '—' }}</td>
                        <td>{{ ucfirst($inscription->status) }}</td>
                        <td>{{ $inscription->qr_code }}</td>

                        <td>
                            <a href="{{ route('inscriptions.show', $inscription->id) }}" class="btn btn-primary btn-sm">
                                Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
