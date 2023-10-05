<div class="nav-bar">
    <div class="nav">
        <img id="navBarToggle" class="nav-div nav-toggle-icon" src="{{ asset('admin/assets/icons/bars.svg') }}" alt="">
        <div class="nav-div nav-links">
            <a href="{{ url('/productos') }}" class="nav-link">Tienda</a>
            <a href="{{ url('/nosotros') }}" class="nav-link">Nosotros</a>
            <a href="{{ url('/contacto') }}" class="nav-link">Contacto</a>
        </div>
        <a href="{{ url('/home') }}">
            <img class="nav-div logo" src="{{asset('admin/assets/icons/logo.svg')}}" alt="">
        </a>
        <div class="nav-div search-cart-container">
            <a id="searchLink">
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
    <div id="searchSection" class="wrapper-navbar">
        <div class="search-section wrapper-navbar">
            <div class="search-divs">
                <form id="searchForm" class="input-div search-divs" action="{{ url('/productos') }}" method="GET">
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
                @isset($newProduct)
                    <a href="{{ url('productos/detalle/' . $newProduct->category_id . '/' . $newProduct->id) }}" class="products-div">
                        <img class="new-product-img" src="{{ asset('images/main-images/' . $newProduct->main_image) }}" alt="">
                        <p class="recommended-products-title">Nuevo</p>
                        <p class="recommended-products-text">{{ $newProduct->name }}</p>
                    </a>
                @endisset
                {{-- <div>
                    <img src="" alt="">
                    <p class="recommended-products-title">Más Vendido</p>
                    <p class="recommended-products-text"></p>
                </div> --}}
            </div>
        </div>
    </div>
</div>
