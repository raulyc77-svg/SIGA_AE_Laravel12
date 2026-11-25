@extends('layouts.app')

@section('title', 'Unidades didácticas | SIGA-AE')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h2 class="mb-1">Unidades didácticas</h2>
        <p class="text-muted mb-0">Administración de asignaturas del programa de estudios.</p>
    </div>
    <a href="{{ route('unidades-didacticas.create') }}" class="btn btn-primary">＋ Nueva asignatura</a>
</div>

<form method="GET" class="card card-body mb-3">
    <div class="row g-2 align-items-end">
        <div class="col-md-7">
            <label for="buscar" class="form-label">Buscar asignatura</label>
            <input id="buscar" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Escribe el nombre de la asignatura">
        </div>
        <div class="col-md-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select">
                <option value="">Todos</option>
                <option value="1" @selected(request('estado') === '1')>Activos</option>
                <option value="0" @selected(request('estado') === '0')>Inactivos</option>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-outline-primary w-100">Buscar</button>
            <a href="{{ route('unidades-didacticas.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </div>
</form>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th><th>Asignatura</th><th>Programa</th><th>Módulo formativo</th>
                    <th class="text-center">Horas</th><th class="text-center">Créditos</th><th>Estado</th><th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($unidades as $unidad)
                <tr>
                    <td>{{ $unidad->id }}</td>
                    <td class="fw-semibold">{{ $unidad->nombre }}</td>
                    <td>{{ $unidad->modulo?->programa?->nombre ?? 'Sin programa' }}</td>
                    <td>{{ $unidad->modulo?->nombre ?? 'Sin módulo' }}</td>
                    <td class="text-center">{{ $unidad->horas_totales }}</td>
                    <td class="text-center">{{ $unidad->creditos }}</td>
                    <td>
                        @if($unidad->estado)
                            <span class="badge text-bg-success">Activo</span>
                        @else
                            <span class="badge text-bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('unidades-didacticas.edit', $unidad) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                        @if($unidad->estado)
                        <form method="POST" action="{{ route('unidades-didacticas.destroy', $unidad) }}" class="d-inline" onsubmit="return confirm('¿Deseas desactivar esta asignatura? No se eliminará su historial.');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Desactivar</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted py-4">No hay asignaturas registradas.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $unidades->links() }}</div>
</div>
@endsection
