@extends('layouts.app')

@section('title', ($unidad->exists ? 'Editar' : 'Nueva') . ' unidad didáctica | SIGA-AE')

@section('content')
<div class="mb-4">
    <a href="{{ route('unidades-didacticas.index') }}" class="text-decoration-none">← Volver a unidades didácticas</a>
    <h2 class="mt-2">{{ $unidad->exists ? 'Editar asignatura' : 'Registrar asignatura' }}</h2>
</div>

<div class="card p-4" style="max-width: 850px">
    <form method="POST" action="{{ $unidad->exists ? route('unidades-didacticas.update', $unidad) : route('unidades-didacticas.store') }}">
        @csrf
        @if($unidad->exists) @method('PUT') @endif

        <div class="mb-3">
            <label for="modulo_formativo_id" class="form-label">Módulo formativo *</label>
            <select id="modulo_formativo_id" name="modulo_formativo_id" class="form-select @error('modulo_formativo_id') is-invalid @enderror" required>
                <option value="">Selecciona un módulo</option>
                @foreach($modulos as $modulo)
                    <option value="{{ $modulo->id }}" @selected(old('modulo_formativo_id', $unidad->modulo_formativo_id) == $modulo->id)>
                        {{ $modulo->programa?->nombre }} — {{ $modulo->nombre }}
                    </option>
                @endforeach
            </select>
            @error('modulo_formativo_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la asignatura *</label>
            <input id="nombre" name="nombre" maxlength="150" value="{{ old('nombre', $unidad->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" required>
            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="horas_totales" class="form-label">Horas totales</label>
                <input type="number" min="0" max="65535" id="horas_totales" name="horas_totales" value="{{ old('horas_totales', $unidad->horas_totales ?? 0) }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="creditos" class="form-label">Créditos</label>
                <input type="number" min="0" max="65535" id="creditos" name="creditos" value="{{ old('creditos', $unidad->creditos ?? 0) }}" class="form-control" required>
            </div>
        </div>

        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" value="1" @checked(old('estado', $unidad->exists ? $unidad->estado : true))>
            <label class="form-check-label" for="estado">Asignatura activa</label>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">{{ $unidad->exists ? 'Guardar cambios' : 'Registrar asignatura' }}</button>
            <a href="{{ route('unidades-didacticas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
