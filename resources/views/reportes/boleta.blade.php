
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Notas - SIGA-AE</title>

    <style>
        @page {
            margin: 35px 40px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #263238;
        }

        .encabezado {
            text-align: center;
            border-bottom: 3px solid #17365D;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .encabezado h2 {
            color: #17365D;
            font-size: 16px;
            margin: 0 0 5px;
        }

        .encabezado p {
            margin: 3px 0;
            font-size: 9px;
        }

        .titulo {
            text-align: center;
            color: #17365D;
            font-size: 15px;
            margin: 18px 0;
        }

        .seccion {
            background: #17365D;
            color: white;
            padding: 7px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 8px;
        }

        .datos {
            width: 100%;
            border-collapse: collapse;
        }

        .datos td {
            padding: 7px;
            border: 1px solid #D5DDE5;
        }

        .etiqueta {
            background: #EDF2F7;
            font-weight: bold;
            width: 22%;
        }

        .notas {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .notas th {
            background: #DCE6F1;
            color: #17365D;
            padding: 9px;
            border: 1px solid #AAB7C4;
            text-align: center;
        }

        .notas td {
            padding: 8px;
            border: 1px solid #C7D0D9;
        }

        .centrado {
            text-align: center;
        }

        .promedio {
            margin-top: 18px;
            width: 100%;
            border-collapse: collapse;
        }

        .promedio td {
            padding: 10px;
            border: 1px solid #AAB7C4;
        }

        .promedio-titulo {
            background: #17365D;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }

        .promedio-valor {
            background: #E2F0D9;
            color: #215E21;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .observacion {
            margin-top: 18px;
            padding: 9px;
            border: 1px solid #D5DDE5;
            background: #F5F7FA;
            font-size: 9px;
        }

        .firmas {
            width: 100%;
            margin-top: 65px;
        }

        .firmas td {
            width: 50%;
            text-align: center;
            padding-top: 8px;
        }

        .linea {
            border-top: 1px solid #555;
            width: 75%;
            margin: auto;
            padding-top: 5px;
        }

        .pie {
            position: fixed;
            bottom: -15px;
            left: 0;
            right: 0;
            text-align: center;
            color: #777;
            font-size: 8px;
        }
    </style>
</head>

<body>

    <!-- ENCABEZADO INSTITUCIONAL -->
    <div class="encabezado">
        <h2>INSTITUTO DE EDUCACIÓN SUPERIOR PÚBLICO PEDRO P. DÍAZ</h2>
        <p>AREQUIPA - PERÚ</p>
        <p>SISTEMA INTEGRADO DE GESTIÓN ACADÉMICA</p>
    </div>

    <h3 class="titulo">BOLETA DE NOTAS</h3>

    <!-- DATOS DEL ESTUDIANTE -->
    <div class="seccion">I. DATOS DEL ESTUDIANTE</div>

    <table class="datos">
        <tr>
            <td class="etiqueta">Apellidos y nombres</td>
            <td colspan="3">
                {{ $m->apellidos }}, {{ $m->nombres }}
            </td>
        </tr>

        <tr>
            <td class="etiqueta">Código estudiante</td>
            <td>{{ $m->codigo_estudiante }}</td>

            <td class="etiqueta">Periodo académico</td>
            <td>{{ $m->periodo }}</td>
        </tr>

        <tr>
            <td class="etiqueta">Programa de estudios</td>
            <td colspan="3">{{ $m->programa }}</td>
        </tr>

        <tr>
            <td class="etiqueta">Módulo formativo</td>
            <td colspan="3">{{ $m->modulo }}</td>
        </tr>

        <tr>
            <td class="etiqueta">Unidad didáctica</td>
            <td colspan="3">{{ $m->unidad_didactica }}</td>
        </tr>
    </table>

    <!-- REGISTRO DE CALIFICACIONES -->
    <div class="seccion">II. DETALLE DE CALIFICACIONES</div>

    <table class="notas">
        <thead>
            <tr>
                <th width="8%">N.º</th>
                <th width="52%">Criterio de evaluación</th>
                <th width="20%">Ponderación</th>
                <th width="20%">Nota</th>
            </tr>
        </thead>

        <tbody>
            @forelse($notas as $indice => $n)
                <tr>
                    <td class="centrado">{{ $indice + 1 }}</td>
                    <td>{{ $n->nombre }}</td>
                    <td class="centrado">{{ $n->porcentaje }}%</td>
                    <td class="centrado">{{ number_format((float) $n->nota, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="centrado">
                        No existen calificaciones registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- RESULTADO -->
    <div class="seccion">III. RESULTADO ACADÉMICO</div>

    <table class="promedio">
        <tr>
            <td class="promedio-titulo">
                PROMEDIO PONDERADO
            </td>

            <td class="promedio-valor">
                {{ number_format((float) $promedio, 2) }}
            </td>
        </tr>

        <tr>
            <td><strong>Ponderación registrada</strong></td>
            <td class="centrado">
                {{ number_format((float) $porcentajeTotal, 2) }}%
            </td>
        </tr>
    </table>

    <div class="observacion">
        <strong>Observación:</strong>
        El promedio ponderado se calcula utilizando las notas registradas
        y los porcentajes asignados a los criterios de evaluación.
        Si la ponderación aún no alcanza el 100%, el resultado corresponde
        únicamente a los criterios registrados.
    </div>

    <!-- FIRMAS -->
    <table class="firmas">
        <tr>
            <td>
                <div class="linea">
                    Firma del estudiante
                </div>
            </td>

            <td>
                <div class="linea">
                    Firma y sello de la institución
                </div>
            </td>
        </tr>
    </table>

    <div class="pie">
        SIGA-AE | Documento generado electrónicamente
    </div>

</body>
</html>
