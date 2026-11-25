
@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h2>{{ $docente ? 'Editar docente' : 'Registrar nuevo docente' }}</h2>
    <p class="text-muted">Completa los datos del docente.</p>
</div>

<div class="card shadow-sm p-4">

    <form method="POST"
          action="{{ $docente
              ? route('docentes.update', $docente->id)
              : route('docentes.store') }}">

        @csrf

        @if($docente)
            @method('PUT')
        @endif

        <div class="row g-3">

            @if(!$docente)
                <div class="col-md-6">
                    <label class="form-label">Cuenta de usuario *</label>

                    <select name="usuario_id" class="form-select" required>
                        <option value="">Seleccione una cuenta</option>

                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}"
                                {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->username }} - {{ $usuario->email }}
                            </option>
                        @endforeach
                    </select>

                    <small class="text-muted">
                        Solo aparecen cuentas activas que todavía no tienen ficha docente.
                    </small>
                </div>
            @else
                <div class="col-md-6">
                    <label class="form-label">Cuenta de usuario</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $docente->relacion->username ?? 'Sin usuario' }}"
                           disabled>
                </div>
            @endif

            <div class="col-md-6">
                <label class="form-label">Código docente *</label>
                <input type="text"
                       name="codigo_docente"
                       class="form-control"
                       maxlength="30"
                       value="{{ old('codigo_docente', $docente->codigo_docente ?? '') }}"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Apellidos *</label>
                <input type="text"
                       name="apellidos"
                       class="form-control"
                       maxlength="100"
                       value="{{ old('apellidos', $docente->apellidos ?? '') }}"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nombres *</label>
                <input type="text"
                       name="nombres"
                       class="form-control"
                       maxlength="100"
                       value="{{ old('nombres', $docente->nombres ?? '') }}"
                       required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Especialidad</label>
                <input type="text"
                       name="especialidad"
                       class="form-control"
                       maxlength="120"
                       value="{{ old('especialidad', $docente->especialidad ?? '') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input type="text"
                       name="telefono"
                       class="form-control"
                       maxlength="25"
                       value="{{ old('telefono', $docente->telefono ?? '') }}">
            </div>

        </div>

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <strong>Revisa los siguientes errores:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                Guardar
            </button>

            <a href="{{ route('docentes.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>

    </form>

</div>

@endsection
