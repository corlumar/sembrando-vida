<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Plataforma Sembrando Vida')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    @include('layouts.navbar')

    @include('layouts.sidebar')

    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0">
                            @yield('page-title', 'Inicio')
                        </h3>
                    </div>

                    <div class="col-sm-4">
                        @yield('breadcrumb')
                    </div>
                </div>

            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </div>
        </div>

    </main>

    @include('layouts.footer')

</div>

@stack('scripts')

</body>
</html>