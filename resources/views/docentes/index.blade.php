
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Gestión de Docentes</h2>
        <p class="text-muted mb-0">Administración de los docentes registrados.</p>
    </div>

    @if(auth()->user()->tienePermiso('O12', 'modificar'))
        <a href="{{ route('docentes.create') }}" class="btn btn-primary">
            + Nuevo docente
        </a>
    @endif
</div>

@if(session('ok'))
    <div class="alert alert-success">
        {{ session('ok') }}
    </div>
@endif

<div class="card p-3 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Código</th>
                    <th>Apellidos y nombres</th>
                    <th>Especialidad</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    @if(auth()->user()->tienePermiso('O12', 'modificar'))
                        <th>Acciones</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @forelse($docentes as $docente)
                    <tr>
                        <td>{{ $docente->codigo_docente }}</td>
                        <td>{{ $docente->apellidos }}, {{ $docente->nombres }}</td>
                        <td>{{ $docente->especialidad ?? 'No especificada' }}</td>
                        <td>{{ $docente->telefono ?? 'No registrado' }}</td>
                        <td>
                            @if($docente->estado)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>

                        @if(auth()->user()->tienePermiso('O12', 'modificar'))
                            <td>
                                <a href="{{ route('docentes.edit', $docente->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Editar
                                </a>

                                @if($docente->estado)
                                    <form action="{{ route('docentes.destroy', $docente->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Deseas desactivar este docente?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Desactivar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No hay docentes registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $docentes->links() }}
</div>

@endsection
