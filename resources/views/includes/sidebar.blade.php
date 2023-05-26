<div class="sidebar shadow bg-sidebar">
    <div class="sidebar-inner d-flex-column">
        <div class="m-6">
            <div class="logo">
                <div class="">
                    <span>
                        <a class="navbar-brand" href="{{ url('/administracion/home') }}">
                            <img src="{{asset('admin/assets/favicon.png')}}" alt="">
                        </a>
                    </span>
                    <div class="mobile-toggle sidebar-toggle d-block d-lg-none">
                        <a href="#" class="text-decoration-none">
                            <i class="fas fa-lg fa-times-circle text-dark"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu position-relative">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('administracion/productos/listado-edicion') }}" id="inicio" role="link">
                    <span class="icon-holder" data-feather="home">
                        <i class="fa-solid fa-boxes-stacked task"></i>
                    </span>
                    <span class="title">
                        <p class="task">Productos</p>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/administracion/ventas') }}" id="perfil" role="link">
                    <span class="icon-holder" data-feather="home">
                        <i class="fa-solid fa-dollar-sign task"></i>
                    </span>
                    <span class="title">
                        <p class="task">Ventas</p>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/administracion/vacaciones') }}" id="perfil" role="link">
                    <span class="icon-holder" data-feather="home">
                        <i class="fa-solid fa-umbrella-beach task"></i>
                    </span>
                    <span class="title">
                        <p class="task">Vacaciones</p>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/administracion/productos/creacion') }}" id="perfil" role="link">
                    <span class="icon-holder" data-feather="home">
                        <i class="fa-solid fa-plus task"></i>
                    </span>
                    <span class="title">
                        <p class="task">Crear Producto</p>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="icon-holder icon">
                        <i class="fa-solid fa-right-from-bracket sign-out"></i>
                    </span>
                    <span class="title">
                        <form class="" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" class="btn sign-out p-0" value="Cerrar Sesión">
                        </form>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
