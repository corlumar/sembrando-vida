<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sembrando Vida - Panel</title>

    <!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/css/adminlte.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Google Fonts: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="hold-transition sidebar-mini">
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">

            <div class="row">

                <!-- Tarjeta 1 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Técnicos Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>3200</h3>
                            <p>Sembradores Activos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Tarjeta 3 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>120</h3>
                            <p>CAC Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <a href="#" class="small-box-footer text-dark">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Tarjeta 4 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>85%</h3>
                            <p>Avance Productivo</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

        </div>
    </section>
</div>



  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>Sembrando Vida © {{ date('Y') }}</strong>
  </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/js/adminlte.min.js') }}"></script>
</body>

</html>
