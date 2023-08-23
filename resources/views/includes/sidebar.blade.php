<div class="sidebar shadow bg-sidebar">
    <div class="sidebar-inner d-flex-column">
        <div class="m-6">
            <div class="logo">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span>
                        <img src="{{asset('admin/assets/icons/logo.svg')}}" alt="">
                    </span>
                </a>
                <div class="mobile-toggle sidebar-toggle d-block d-lg-none">
                    <a href="#" class="text-decoration-none">
                        <i class="fas fa-lg fa-times-circle text-dark"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="task-partition">
            <ul class="ul ul-top">
                <li class="nav-item nav-item-div">
                    <a class="nav-link task-div" href="{{ url('administracion/productos/listado') }}" id="inicio" role="link">
                        <span class="icon-holder" data-feather="home">
                            @if (isset($task) && $task === 'products')
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/boxes_selected.svg') }}" alt="">
                            @else
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/boxes.svg') }}" alt="">
                            @endif
                        </span>
                        <span>
                            <p class="task @if(isset($task) && $task === 'products') selected-task @endif">Productos</p>
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-div">
                    <a class="nav-link task-div" href="{{ url('/administracion/ventas') }}" id="perfil" role="link">
                        <span class="icon-holder" data-feather="home">
                            @if (isset($task) && $task === 'sales')
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/dollar_selected.svg') }}" alt="">
                            @else
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/dollar.svg') }}" alt="">
                            @endif
                        </span>
                        <span>
                            <p class="task @if(isset($task) && $task === 'sales') selected-task @endif">Ventas</p>
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-div">
                    <a class="nav-link task-div" href="{{ url('/administracion/vacaciones') }}" id="perfil" role="link">
                        <span class="icon-holder" data-feather="home">
                            @if (isset($task) && $task === 'vacations')
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/vacations_selected.svg') }}" alt="">
                            @else
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/vacations.svg') }}" alt="">
                            @endif
                        </span>
                        <span>
                            <p class="task @if(isset($task) && $task === 'vacations') selected-task @endif">Vacaciones</p>
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-div">
                    <a class="nav-link task-div" href="{{ url('/administracion/productos/crear-editar/0/0') }}" id="perfil" role="link">
                        <span class="icon-holder" data-feather="home">
                            @if (isset($task) && $task === 'product-create')
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/plus_selected.svg') }}" alt="">
                            @else
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/plus.svg') }}" alt="">
                            @endif
                        </span>
                        <span>
                            <p class="task @if(isset($task) && $task === 'product-create') selected-task @endif">Crear Producto</p>
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="ul ul-bottom">
                <li class="nav-item nav-item-div">
                    <a class="nav-link task-div" href="{{ url('/administracion/configuracion') }}" id="perfil" role="link">
                        <span class="icon-holder" data-feather="home">
                            @if (isset($task) && $task === 'configuration')
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/config_selected.svg') }}" alt="">
                            @else
                                <img class="sidebar-icon task" src="{{ asset('admin/assets/icons/config.svg') }}" alt="">
                            @endif
                        </span>
                        <span>
                            <p class="task @if(isset($task) && $task === 'configuration') selected-task @endif">Configuración</p>
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-div">
                    <a class="nav-link task-div sign-out-div" href="#">
                        <span class="icon-holder task">
                            <img class="sidebar-icon sign-out" src="{{ asset('admin/assets/icons/open_door.svg') }}" alt="">
                        </span>
                        <span>
                            <form class="" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit" class="btn sign-out p-0" style="margin-left: 15px;" value="Cerrar Sesión">
                            </form>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
