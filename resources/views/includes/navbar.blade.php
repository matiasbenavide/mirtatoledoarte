<div class="nav-bar">
    <div class="nav">
        <img id="navBarToggle" class="nav-toggle-icon" src="{{ asset('admin/assets/icons/bars.svg') }}" alt="">
        <a href="{{ url('/') }}">
            <img class="logo" src="{{asset('admin/assets/icons/logo.svg')}}" alt="">
        </a>
        <div class="search-cart-container">
            <a href="{{ url('productos') }}">
                <img class="nav-icon" id="searchIcon" style="margin-right: 5px" src="{{ asset('admin/assets/icons/searchWhite.svg') }}" alt="">
            </a>
            <a class="cart-container" href="{{ url('/carrito') }}">
                <img class="nav-icon" src="{{ asset('admin/assets/icons/cart.svg') }}" alt="">
                @if (Session::has('cart') && Session::get('cart')->totalQuantity > 0)
                    <p class="cart-items">{{ Session::get('cart')->totalQuantity }}</p>
                @endif
            </a>
        </div>
    </div>
    <div id="searchSection" class="active search-section">
        {{-- <div class="search-divs">
            <form id="searchForm" class="input-div search-divs products" action="{{ url('/productos') }}" method="GET">
                <input id="productSearchInput" class="form-consult-search" type="text" name="productName" placeholder="Buscar Juegos y Plazas">
                <span class="input-icon">
                    <img id="submitInput" class="input-img" src="{{ asset('admin/assets/icons/search.svg') }}" alt="">
                </span>
            </form>
        </div> --}}
        <hr/>
        <div class="search-divs">
            <p class="nav-title">Tienda</p>
            <div>
                <a href="{{ url('/productos?categorySelector=' . App\Models\Admin\Category::INDIVIDUAL) }}">
                    <p class="nav-bar-link">Juegos Individuales</p>
                </a>
                <a href="{{ url('/productos?categorySelector=' . App\Models\Admin\Category::COMBO) }}">
                    <p class="nav-bar-link">Plazas</p>
                </a>
                <a href="{{ url('/productos')}}">
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
            <a href="{{ url('productos/detalle/' . $newProduct->category_id . '/' . $newProduct->id) }}" class="products-div">
                <img class="new-product-img" src="{{ asset('images/main-images/' . $newProduct->main_image) }}" alt="">
                <p class="recommended-products-title">Nuevo</p>
                <p class="recommended-products-text">{{ $newProduct->name }}</p>
            </a>
            {{-- <div>
                <img src="" alt="">
                <p class="recommended-products-title">Más Vendido</p>
                <p class="recommended-products-text"></p>
            </div> --}}
        </div>
    </div>
</div>
