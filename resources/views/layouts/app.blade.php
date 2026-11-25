<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIGA-AE')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{background:#f4f6fa}.sidebar{width:255px;min-height:100vh;background:#15365b;flex-shrink:0}
        .sidebar a{display:block;color:#eaf2fa;text-decoration:none;padding:9px 13px;border-radius:7px}
        .sidebar a:hover{background:#24517d}.brand{color:#fff;font-weight:800;padding:20px 13px;font-size:19px}
        .content{padding:28px}.card{border:0;border-radius:13px;box-shadow:0 4px 18px #1c355015}
        .table thead th{background:#eaf0f7}.form-label{font-weight:600}.menu-label{color:#9fb5ca;font-size:11px;font-weight:700;padding:14px 13px 5px;text-transform:uppercase}
    </style>
</head>
<body>
<div class="d-flex">
    <aside class="sidebar p-2">
        <div class="brand">SIGA-AE</div>
        <div class="menu-label">General</div>
        <a href="{{ route('dashboard') }}">Panel principal</a>

        @php($usuarioMenu = auth()->user())
        @if($usuarioMenu->tienePermiso('O11', 'visualizar') || $usuarioMenu->tienePermiso('O11', 'modificar'))
            <div class="menu-label">Archivos</div>
            <a href="{{ route('estudiantes.index') }}">Estudiantes</a>
        @endif
        @if($usuarioMenu->tienePermiso('O15', 'visualizar') || $usuarioMenu->tienePermiso('O15', 'modificar'))
            <a href="{{ route('unidades-didacticas.index') }}">Itinerarios / Unidades didácticas</a>
        @endif

        @if($usuarioMenu->tienePermiso('O32', 'visualizar') || $usuarioMenu->tienePermiso('O32', 'modificar'))
            <div class="menu-label">Consultas</div>
            <a href="{{ route('asistencias.index') }}">Asistencia de estudiantes</a>
        @endif
        @if($usuarioMenu->tienePermiso('O24', 'visualizar') || $usuarioMenu->tienePermiso('O24', 'modificar') || $usuarioMenu->tienePermiso('O33', 'visualizar') || $usuarioMenu->tienePermiso('O33', 'modificar'))
            <a href="{{ route('evaluaciones.index') }}">Evaluaciones</a>
        @endif
        @if($usuarioMenu->tienePermiso('O32', 'visualizar') || $usuarioMenu->tienePermiso('O32', 'modificar'))
            <a href="{{ route('asistencias.resumen') }}">Resumen de inasistencias</a>
        @endif

        <div class="p-3 mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm w-100">Cerrar sesión</button>
            </form>
        </div>
    </aside>
    <main class="flex-grow-1">
        <nav class="navbar bg-white px-4 shadow-sm">
            <strong>Sistema Integrado de Gestión Académica</strong>
            <span>{{ auth()->user()->username }}</span>
        </nav>
        <div class="content">
            @if(session('ok'))<div class="alert alert-success">{{ session('ok') }}</div>@endif
            @if($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
