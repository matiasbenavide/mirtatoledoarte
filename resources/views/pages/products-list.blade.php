@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productList.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('mainContent')
    <div class="main">
        <div class="title-description-container">
            <div class="title-container">
                <img src="{{ asset('admin/assets/images/HomeShineLeft.svg') }}" class="title-shine" alt="">
                <p class="title">TIENDA</p>
            </div>
            <p class="title-description">Acá vas a poder encontrar todos nuestros productos.</p>
        </div>
        <div>
            <img src="{{ asset('admin/assets/images/shop-list/ShopListCloud.svg') }}" class="image-to-overlap cloud-top" alt="">
            <img src="{{ asset('admin/assets/images/ListMainImage.svg') }}" class="list-main-img" alt="">
            <img src="{{ asset('admin/assets/images/shop-list/ShopListCloud.svg') }}" class="image-to-overlap cloud-bottom" alt="">
        </div>
    </div>
    <div class="list-container">
        <p class="list-title" id="mobileTitle">{{ $title }}</p>
        <div class="filter-products">
            <div class="filter-buttons-container">
                {{-- <button class="filter-button button-2" id="orderByToggle">
                    <img src="{{ asset('admin/assets/icons/order.svg') }}" alt="">
                    Ordenar por
                </button> --}}
                <button class="filter-button button-2" id="filterToggle">
                    <img src="{{ asset('admin/assets/icons/filter.svg') }}" alt="">
                    Filtrar
                </button>
                <div class="filter-forms-container" id="filterForm">
                    <form class="filter-form" action="{{ url('/productos') }}" method="GET">
                        <p class="filter-title">Filtrar resultados</p>
                        <div class="filter-divs">
                            <p class="filters-sub-title">Nombre</p>
                            <input class="form-input" name="productName" id="productName" type="text" placeholder="Buscar por nombre de producto">
                        </div>
                        <div class="filter-divs">
                            <p class="filters-sub-title">Categoría</p>
                            <select class="form-input" name="categorySelector" id="categorySelector" style="max-height: 100%">
                                <option class="form-input" value="">Todos</option>
                                <option class="form-input" value="{{ App\Models\Admin\Category::INDIVIDUAL }}">Individuales</option>
                                <option class="form-input" value="{{ App\Models\Admin\Category::COMBO }}">Plazas y combos</option>
                            </select>
                        </div>
                        <div class="filter-divs">
                            <p class="filters-sub-title">Precio</p>
                            <div class="price-inputs-container">
                                <input class="form-input price-input" type="number" name="lowerPrice" id="lowerPrice" placeholder="Desde">
                                <p class="filters-sub-title price-separation"> - </p>
                                <input class="form-input price-input" type="number" name="highestPrice" id="highestPrice" placeholder="Hasta">
                            </div>
                        </div>
                        <div class="filter-divs colors-checkbox-container">
                            <div class="checkbox-container">
                                <input class="form-input colors-checkbox" name="withColor" id="withColor" type="checkbox" value="{{ App\Models\Admin\Color::WITH_COLOR }}">
                                <p class="colors-text">Pintado</p>
                            </div>
                            <div class="checkbox-container">
                                <input class="form-input colors-checkbox" name="withoutColor" id="withoutColor" type="checkbox" value="{{ App\Models\Admin\Color::WITHOUT_COLOR }}">
                                <p class="colors-text">Sin pintar</p>
                            </div>
                        </div>
                        <button class="main-filter-btn filter-button button-2" type="submit">Aplicar filtros</button>
                    </form>
                </div>
            </div>
            <div class="title-products">
                <p class="list-title" id="desktopTitle">{{ $title }}</p>
                <div class="products-container">
                    @foreach ($combosAndProducts as $product)
                        <a href="{{ url('/productos/detalle/' . $product->category_id . '/' . $product->id) }}" class="noted-products" style="margin-bottom: 15px">
                            <div class="images-overlap product">
                                @if ($product->color_id == App\Models\Admin\Category::INDIVIDUAL)
                                    <p class="image-to-overlap noted with-color">Pintada</p>
                                @else
                                    <p class="image-to-overlap noted without-color">Sin Pintar</p>
                                @endif
                                <img class="image-to-overlap noted-image" @if ($product->main_image) src="{{ asset('images/main-images/' . $product->main_image) }}" @endif alt="">
                                <div class="image-to-overlap cart-bag-div">
                                    <img class="cart-bag" src="{{ asset('admin/assets/images/HomeCartBag.svg') }}" alt="">
                                </div>
                            </div>
                            <p class="product-name">{{ $product->name }}</p>
                            <p class="product-price">AR$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        </a>
                    @endforeach
                </div>
                <div class="paginator-container">
                    {{ $combosAndProducts->links() }}
                </div>
            </div>
        </div>
    </div>
    <script type="module">
        let productName = {!! json_encode($productName) !!};
        let categorySelector = {!! json_encode($categorySelector) !!};
        let lowerPrice = {!! json_encode($lowerPrice) !!};
        let highestPrice = {!! json_encode($highestPrice) !!};
        let withColor = {!! json_encode($withColor) !!};
        let withoutColor = {!! json_encode($withoutColor) !!};

        import { showSuccess, showErrors } from "{{ asset(mix('js/module/sweetAlert.js')) }}";
        import { main } from "{{ asset(mix('js/clientProductsList.js')) }}";
        import { mainNavbar } from "{{ asset(mix('js/admin/navBar.js')) }}";
        import { mainFooter } from "{{ asset(mix('js/admin/footer.js')) }}";

        let url = {!! json_encode(url('/productos')) !!};

        window.onload = function() {
            main({
                productName: productName,
                categorySelector: categorySelector,
                lowerPrice: lowerPrice,
                highestPrice: highestPrice,
                withColor: withColor,
                withoutColor: withoutColor,
            })
            mainNavbar({
                url: url
            })
            mainFooter()
        }
    </script>
@endsection
