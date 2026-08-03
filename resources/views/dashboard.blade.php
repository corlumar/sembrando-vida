@extends('layouts.app')

@section('title', 'Dashboard Ejecutivo')

@section('page-title', 'Dashboard Ejecutivo')

@section('content')

<div class="row g-4">

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>25</h3>
                <p>Usuarios</p>
            </div>

            <div class="small-box-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <a href="#" class="small-box-footer link-light">
                Ver usuarios
                <i class="bi bi-arrow-right-circle ms-1"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>18</h3>
                <p>Comunidades CAC</p>
            </div>

            <div class="small-box-icon">
                <i class="bi bi-houses-fill"></i>
            </div>

            <a href="#" class="small-box-footer link-light">
                Ver comunidades
                <i class="bi bi-arrow-right-circle ms-1"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>320</h3>
                <p>Sembradores</p>
            </div>

            <div class="small-box-icon">
                <i class="bi bi-person-badge-fill"></i>
            </div>

            <a href="#" class="small-box-footer link-dark">
                Ver sembradores
                <i class="bi bi-arrow-right-circle ms-1"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>56</h3>
                <p>Cultivos</p>
            </div>

            <div class="small-box-icon">
                <i class="bi bi-flower1"></i>
            </div>

            <a href="#" class="small-box-footer link-light">
                Ver cultivos
                <i class="bi bi-arrow-right-circle ms-1"></i>
            </a>
        </div>
    </div>

</div>

<div class="row g-4 mt-1">

    <div class="col-12 col-xl-8">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-bar-chart-line me-2"></i>
                    Resumen de producción
                </h3>
            </div>

            <div class="card-body">

                <div
                    class="d-flex align-items-center justify-content-center text-muted"
                    style="min-height: 280px;"
                >
                    <div class="text-center">
                        <i class="bi bi-bar-chart fs-1"></i>

                        <p class="mt-3 mb-0">
                            Aquí se mostrará la gráfica de producción.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-activity me-2"></i>
                    Actividad reciente
                </h3>
            </div>

            <div class="card-body p-0">

                <div class="list-group list-group-flush">

                    <div class="list-group-item">
                        <div class="d-flex gap-3">
                            <i class="bi bi-person-plus text-primary fs-4"></i>

                            <div>
                                <strong>Nuevo usuario</strong>

                                <div class="text-muted small">
                                    Se registró un nuevo usuario.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="d-flex gap-3">
                            <i class="bi bi-house-add text-success fs-4"></i>

                            <div>
                                <strong>Nueva comunidad CAC</strong>

                                <div class="text-muted small">
                                    Se agregó una comunidad.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-group-item">
                        <div class="d-flex gap-3">
                            <i class="bi bi-basket text-warning fs-4"></i>

                            <div>
                                <strong>Registro de cosecha</strong>

                                <div class="text-muted small">
                                    Se actualizó información productiva.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<div class="row g-4 mt-1">

    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-info-circle me-2"></i>
                    Estado de la plataforma
                </h3>
            </div>

            <div class="card-body">
                <p class="mb-1">
                    Bienvenido,
                    <strong>{{ auth()->user()->name ?? 'Usuario' }}</strong>.
                </p>

                <p class="text-muted mb-0">
                    Desde este panel podrás administrar la operación de
                    Sembrando Vida, CRM, proyectos y comercialización.
                </p>
            </div>

        </div>
    </div>

</div>

@endsection