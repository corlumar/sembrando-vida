<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión — Sembrando Vida</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Opcional: Bootstrap para estilos rápidos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <style>
    html, body {
      height: 100%;
    }
    body {
      margin: 0;
      /* ✅ Fondo repetido */
      background-image: url('{{ asset("img/fondosv.jpg") }}');
      background-repeat: repeat;
      background-size: auto;
      background-position: top left;
      display: flex;
      align-items: center;     /* ✅ Centrar vertical */
      justify-content: center; /* ✅ Centrar horizontal */
      font-size: 16px;
    }
    .login-box {
      width: 100%;
      max-width: 420px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 8px 30px rgba(0,0,0,.2);
      padding: 28px;
    }
    .brand {
      text-align: center;
      margin-bottom: 16px;
    }
    .brand img {
      max-height: 70px;
      width: auto;
    }
    .small-text { font-size: .875rem; }
  </style>
</head>
<body>

  <div class="login-box">
    <div class="brand">
      <img src="{{ asset('img/logosv.png') }}" alt="Sembrando Vida">
      <h5 class="mt-2 mb-0">Sembrando Vida</h5>
      <small class="text-muted">Acceso al sistema</small>
    </div>

    {{-- Mensaje de estado (por ej. password reset) --}}
    @if (session('status'))
      <div class="alert alert-success small-text">
        {{ session('status') }}
      </div>
    @endif

    {{-- Errores de validación --}}
    @if ($errors->any())
      <div class="alert alert-danger small-text">
        <ul class="mb-0 pl-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email') }}"
          class="form-control"
          required
          autofocus
        >
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input
          id="password"
          type="password"
          name="password"
          class="form-control"
          required
          autocomplete="current-password"
        >
      </div>

      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Recordarme</label>
      </div>

      <div class="d-flex justify-content-between align-items-center">
        @if (Route::has('password.request'))
          <a class="small-text" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        @endif>

        <button type="submit" class="btn btn-success">
          Entrar
        </button>
      </div>
    </form>
  </div>

  <!-- Opcional: JS de Bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
