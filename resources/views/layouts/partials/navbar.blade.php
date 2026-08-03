<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <ul class="navbar-nav">
            <li class="nav-item">
                <button
                    type="button"
                    class="nav-link btn btn-link"
                    data-lte-toggle="sidebar"
                    aria-label="Abrir o cerrar menú lateral"
                >
                    <i class="bi bi-list fs-5"></i>
                </button>
            </li>

            <li class="nav-item d-none d-md-block">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    Inicio
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                    href="#"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <i class="bi bi-person-circle fs-5"></i>

                    <span>
                        {{ auth()->user()->name ?? 'Usuario' }}
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <span class="dropdown-item-text">
                            <strong>{{ auth()->user()->name ?? 'Usuario' }}</strong>
                            <br>
                            <small class="text-muted">
                                {{ auth()->user()->email ?? '' }}
                            </small>
                        </span>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>