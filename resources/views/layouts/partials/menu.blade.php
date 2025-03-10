<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo con texto -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
            <img src="{{ asset('assets/img/Logo.png') }}" class="logo me-2" alt="Casa Rural Logo">
            <span class="fw-bold text-uppercase text-light">Casa Rural</span>
        </a>

        <!-- Botón de menú responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                @if (Auth::check() && Auth::user()->admin == true)
                    <li class="nav-item"><a style="color: var(--medium-text);" class="nav-link custom-button"
                            href="#">Admin</a></li>
                @endif
                <li class="nav-item"><a style="color: var(--medium-text);" class="nav-link custom-button"
                        href="{{ route('casa') }}">Casa</a></li>
                <li class="nav-item"><a style="color: var(--medium-text);" class="nav-link custom-button"
                        href="{{ route('habitaciones') }}">Habitaciones</a></li>
                <li class="nav-item"><a style="color: var(--medium-text);" class="nav-link custom-button"
                        href="#">Servicios</a></li>
                <li class="nav-item"><a style="color: var(--medium-text);" class="nav-link custom-button"
                        href="#contacto">Contacto</a></li>
                @auth
                    <li class="nav-item"><a style="color: var(--medium-text);" class="nav-link custom-button"
                            href="{{ route('cuenta') }}">Cuenta</a></li>
                @endauth
                @guest
                    <li class="nav-item"><a style="color: var(--medium-text);" class="nav-link custom-button"
                            href="{{route('login')}}">Iniciar Sesion</a></li>
                @endguest
            </ul>
        </div>

        <!-- Botón de reserva -->
        <a href="{{ route('reservas') }}" class="nav-link custom-button reserve-btn">
            <span>⮕ Reserva Ahora</span>
        </a>
    </div>
</nav>
