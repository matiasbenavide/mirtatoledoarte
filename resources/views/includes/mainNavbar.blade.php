<div class="nav-bar">
    <div class="nav">
        <img id="navBarToggle" class="nav-toggle-icon" src="{{ asset('admin/assets/icons/bars.svg') }}" alt="">
        <a href="{{ url('/') }}">
            <img class="logo" src="{{asset('admin/assets/icons/logo.svg')}}" alt="">
        </a>
        <div>
            <img class="nav-icon" id="searchIcon" style="margin-right: 5px" src="{{ asset('admin/assets/icons/searchWhite.svg') }}" alt="">
            <a href="#">
                <img class="nav-icon" src="{{ asset('admin/assets/icons/cart.svg') }}" alt="">
            </a>
        </div>
    </div>
    <div id="searchSection" class="active search-section">
        <div class="search-divs">
            <form id="searchForm" class="input-div search-divs products" action="{{ url('/productos') }}" method="GET">
                <input id="productSearchInput" class="form-consult-search" type="text" name="productName" placeholder="Buscar Juegos y Plazas">
                <span class="input-icon">
                    <img id="submitInput" class="input-img" src="{{ asset('admin/assets/icons/search.svg') }}" alt="">
                </span>
            </form>
        </div>
        <hr/>
        <div class="search-divs">
            <p class="nav-title">Tienda</p>
            <div>
                <a href="#">
                    <p class="nav-bar-link">Juegos Individuales</p>
                </a>
                <a href="#">
                    <p class="nav-bar-link">Plazas</p>
                </a>
                <a href="#">
                    <p class="nav-bar-link">Ver Todos</p>
                </a>
            </div>
        </div>
        <hr/>
        <div class="search-divs">
            <p class="nav-title">Nosotros</p>
            <p class="nav-title">Contacto</p>
        </div>
        <hr/>
        <div class="search-divs products">
            <div>
                <img src="" alt="">
                <p class="recommended-products-title">Nuevo</p>
                <p class="recommended-products-text"></p>
            </div>
            <div>
                <img src="" alt="">
                <p class="recommended-products-title">Más Vendido</p>
                <p class="recommended-products-text"></p>
            </div>
        </div>
    </div>
</div>
