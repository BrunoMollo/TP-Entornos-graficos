<div class="container mx-0 ">

    <svg xmlns="http://www.w3.org/2000/svg" width="29.4000000pt" height="29.0000000pt"
        viewBox="0 0 184.000000 223.000000" preserveAspectRatio="xMidYMid meet">
        <g transform="translate(0.000000,223.000000) scale(0.100000,-0.100000)" fill="#000000"
            stroke="none">
            <path
                d="M50 2168 c0 -59 20 -212 36 -273 57 -219 190 -421 351 -532 l55 -38 -221 -3 -221 -2 0 -200 0 -200 222 0 222 0 -59 -43 c-67 -49 -167 -152 -215 -222 -96 -140 -170 -393 -170 -585 l0 -30 190 0 190 0 0 38 c0 63 37 189 77 264 37 68 129 175 172 198 l21 11 0 -256 0 -255 200 0 200 0 0 255 c0 157 4 255 10 255 17 0 138 -120 169 -168 43 -68 80 -172 93 -263 l11 -79 186 0 186 0 -6 107 c-13 202 -65 359 -172 518 -51 76 -158 183 -222 224 l-49 31 227 0 227 0 0 200 0 200 -227 0 -228 0 55 37 c70 46 166 144 218 220 107 159 159 321 176 561 l5 62 -189 0 -188 0 -7 -57 c-18 -154 -77 -278 -181 -380 -41 -40 -78 -73 -84 -73 -6 0 -10 88 -10 255 l0 255 -200 0 -200 0 -2 -257 -3 -258 -81 80 c-63 62 -89 97 -118 157 -37 77 -65 184 -66 246 l0 32 -190 0 -190 0 0 -32z" />
        </g>
    </svg>

    <a class="navbar-brand mx-4" href="{{ url('/') }}">
        <!-- {{ config('app.name', 'Laravel') }} -->
        Titulo Página
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">

            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') || Request::is('postulaciones*') ? 'active' : '' }}"  href="/">Vacantes abiertas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('vacantes_cerradas*') ? 'active' : '' }}" href="{{ route('vacantes_cerradas') }}">Vacantes cerradas</a>
            </li>
            @auth
                @role('admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Administracion de usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin*') ? 'active' : '' }}" href="{{ route('admin_llamados') }}">Administracion de llamados</a>
                    </li>
                @endrole

                @role('jefe_catedra')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('vacantes_mi_catedra*') || Request::is('generar_orden_de_merito*') || Request::is('calificar_postulacion*') || Request::is('*/postulaciones*') ? 'active' : '' }}" href="{{ route('vacantes_mi_catedra') }}">Vacantes de mi catedra</a>
                    </li>
                @endrole
            @endauth

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('login*') ? 'active' : '' }}"  href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('register*') ? 'active' : '' }}"  href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                    <i class="fas fa-user"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="text-center dropdown-item  text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        <b>{{ __('Cerrar Sesión') }}</b>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</div>
