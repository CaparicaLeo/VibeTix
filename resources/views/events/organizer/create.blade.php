@extends('layouts.app')

@section('title', 'Criar Evento')

@section('content')
<div class="container">

    <h1 class="mb-4">Criar Evento</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Data</label>
                    <input type="date" name="date_time" class="form-control" value="{{ old('date_time') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Local</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">URL do Banner (opcional)</label>
                    <input type="text" name="banner_image_url" class="form-control" value="{{ old('banner_image_url') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Agendado</option>
                        <option value="on going" {{ old('status') == 'on going' ? 'selected' : '' }}>Em andamento</option>
                        <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Finalizado</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Salvar Evento</button>
            </form>

        </div>
    </div>

</div>
@endsection
