<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sembrando Vida - Panel</title>

    <!-- ✅ AdminLTE CSS desde CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- ✅ Font Awesome desde CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- ✅ Fuente Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <style>
    body, .nav-link, .brand-text, .sidebar .nav-link p, footer {
        font-size: 1.1rem; /* Aumenta 20% aprox */
    }

    h1, h2, h3 {
        font-size: 1.5rem;
    }
</style>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- ✅ Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Inicio</a>
            </li>
        </ul>
    </nav>

    <!-- ✅ Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ url('/dashboard') }}" class="brand-link">
            <span class="brand-text font-weight-light">🌱 Sembrando Vida</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/mapa') }}" class="nav-link">
                            <i class="nav-icon fas fa-map"></i>
                            <p>Mapa CAC</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/usuarios') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-left">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Salir</p>
                            </button>
                        </form>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- ✅ Contenido -->
    <div class="content-wrapper p-4">
        @yield('content')
    </div>

    <!-- ✅ Footer -->
    <footer class="main-footer text-center">
        <strong>Sembrando Vida © {{ date('Y') }}</strong>
    </footer>
</div>

<!-- ✅ Scripts desde CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
