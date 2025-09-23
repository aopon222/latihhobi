<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <div class="logo-container">
                <span class="logo-ai">ai</span>
                <span class="logo-text">LatihHobi</span>
                <small class="logo-subtext">Pusat Bakat dan Hobi Indonesia</small>
            </div>
        </a>

        <!-- Toggle (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link nav-home active" href="{{ url('/') }}">
                        <i class="bi bi-house-door-fill me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-regular" href="#program">Ekskul Reguler</a>
                </li>

                <!-- Dropdown Ecourse -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-ecourse" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-play-fill me-1"></i> Ecourse
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/ecourse') }}">Ecourse Robotik</a></li>
                        <li><a class="dropdown-item" href="{{ url('/course-film-konten-kreator') }}">Ecourse Film & Konten Kreator</a></li>
                    </ul>
                </li>

                <!-- Dropdown Event -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-event" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-calendar-event me-1"></i> Event
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Event A</a></li>
                        <li><a class="dropdown-item" href="#">Event B</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <a class="nav-link nav-search" href="#"><i class="fas fa-magnifying-glass fs-5"></i></a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link nav-cart" href="#"><i class="fas fa-basket-shopping fs-5"></i></a>
                </li>
                @php
                    $hasLoginRoute = \Illuminate\Support\Facades\Route::has('login');
                    $hasRegisterRoute = \Illuminate\Support\Facades\Route::has('register');
                    $hasLogoutRoute = \Illuminate\Support\Facades\Route::has('logout');
                @endphp
                @auth
                    <li class="nav-item me-3">
                        <span class="nav-link">{{ auth()->user()->name }}</span>
                    </li>
                    @if($hasLogoutRoute)
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-signup" type="submit">Logout</button>
                        </form>
                    </li>
                    @endif
                @else
                    @if($hasLoginRoute)
                    <li class="nav-item me-3">
                        <a class="nav-link nav-signin" href="{{ route('login') }}">Sign in</a>
                    </li>
                    @endif
                    @if($hasRegisterRoute)
                    <li class="nav-item">
                        <a class="btn btn-signup" href="{{ route('register') }}">Sign up</a>
                    </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>