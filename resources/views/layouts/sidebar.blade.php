<aside
    class="app-sidebar bg-body-secondary shadow"
    data-bs-theme="dark"
>
    <div class="sidebar-brand">
        <a
            href="{{ route('dashboard') }}"
            class="brand-link d-flex align-items-center"
        >
            <img
                src="{{ asset('img/logosv.png') }}"
                alt="Sembrando Vida"
                class="brand-image opacity-75 shadow"
            >

            <span class="brand-text fw-light">
                Sembrando Vida
            </span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false"
            >
                <li class="nav-item">
                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    >
                        <i class="nav-icon bi bi-speedometer2"></i>

                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">
                    SEMBRANDO VIDA
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Usuarios</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-houses"></i>
                        <p>CAC</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-badge"></i>
                        <p>Sembradores</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-flower1"></i>
                        <p>Cultivos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-basket"></i>
                        <p>Cosechas</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>