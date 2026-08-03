<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Plataforma Sembrando Vida')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    @include('layouts.partials.navbar')

    @include('layouts.partials.sidebar')

    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">

                <div class="row align-items-center">

                    <div class="col-sm-6">
                        <h1 class="mb-0">
                            @yield('page-title', 'Dashboard')
                        </h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end mb-0">

                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    Inicio
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                @yield('page-title', 'Dashboard')
                            </li>

                        </ol>
                    </div>

                </div>

            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>
                    </div>
                @endif

                @yield('content')

            </div>
        </div>

    </main>

    @include('layouts.partials.footer')

</div>

@stack('scripts')

</body>
</html>