
@extends('layouts.app')

@section('title', 'Mis boletas de notas')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">
                Mis boletas de notas
            </h2>
            <p class="text-muted mb-0">
                Consulta tus calificaciones y descarga tus boletas académicas.
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">
                Unidades didácticas matriculadas
            </h5>

            @forelse($matriculas as $matricula)

                <div class="border rounded-3 p-3 mb-3">

                    <div class="row align-items-center">

                        <div class="col-md-8">

                            <h5 class="fw-bold mb-2">
                                {{ $matricula->unidad_didactica }}
                            </h5>

                            <p class="text-muted mb-0">
                                <strong>Periodo académico:</strong>
                                {{ $matricula->periodo }}
                            </p>

                            <p class="text-muted mb-0">
                                <strong>Matrícula:</strong>
                                {{ $matricula->matricula_id }}
                            </p>

                        </div>

                        <div class="col-md-4 text-md-end mt-3 mt-md-0">

                            <a href="{{ route('reportes.boleta', $matricula->matricula_id) }}"
                               class="btn btn-primary">

                                Descargar boleta PDF

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="alert alert-info mb-0">
                    <h5 class="alert-heading">
                        No tienes matrículas registradas
                    </h5>

                    <p class="mb-0">
                        Actualmente no se encontraron unidades didácticas
                        matriculadas para tu usuario.
                    </p>
                </div>

            @endforelse

        </div>
    </div>

</div>

@endsection
