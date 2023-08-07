@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('mainContent')
<div class="home relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
    {{-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            @if($isAdmin)
                <a href="{{ url('/administracion') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Administracion</a>
            @else
                <form class="" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" class="btn" value="Cerrar Sesión">
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
        @endauth
    </div> --}}

    <div class="navbar-distance new-product">
        <div class="new-product-image-div">
            <img class="image-to-overlap home-rocket" src="{{ asset('admin/assets/images/HomeRocket.svg') }}" alt="">
            <img class="new-product-image" src="{{ asset('admin/assets/images/HomeNewProduct.svg') }}" alt="">
            <div class="new-product-text-div">
                <p class="new-product-title">ÚLTIMO LANZAMIENTO</p>
                <p class="new-product-name">TRIÁNGULO PINTADO</p>
                <button class="button new-product-button w-50">Ver Producto</button>
            </div>
        </div>
        <div class="images-overlap boat-and-line">
            <img class="image-to-overlap home-boat" src="{{ asset('admin/assets/images/HomeBoat.svg') }}" alt="">
            <img class="image-width home-wave" src="{{ asset('admin/assets/images/HomeBoatBottomLine.svg') }}" alt="">
            <img class="image-to-overlap home-sun" src="{{ asset('admin/assets/images/HomeSun.svg') }}" alt="">
        </div>
    </div>

    <div class="container categories-container">
        <div class="categories-title-div">
            <p class="title main-text">Categorías</p>
            <a href="{{ url('/productos') }}" class="anchor" id="categoriesAnchorDesktop" style="display: none;">Ver todos los productos</a>
        </div>
        <div class="categories-div">
            <div class="images-overlap categories-plaza-div">
                <img class="plaza-image" src="{{ asset('admin/assets/images/HomeCategoriesPlaza.svg') }}" alt="">
                <p class="categories-name main-text image-to-overlap">Plaza</p>
                <button id="plazaCategory" class="image-to-overlap categories-button button-2 w-100">Ver Categoría</button>
            </div>
            <div class="images-overlap categories-singles-div">
                <img class="singles-image" src="{{ asset('admin/assets/images/HomeCategoriesSingles.svg') }}" alt="">
                <p class="categories-name main-text image-to-overlap">Individuales</p>
                <button id="singlesCategory" class="image-to-overlap categories-button button-2 w-100">Ver Categoría</button>
            </div>
        </div>
        <a href="{{ url('/productos') }}" class="anchor" id="categoriesAnchorMobile">Ver todos los productos</a>
    </div>

    <div class="flyer-container">
        <div class="flyer-div">
            <div class="flyer">
                <img src="{{ asset('admin/assets/images/HomeFlyer.png') }}" alt="">
            </div>
            {{-- <div class="flyer">
                <img src="{{ asset('admin/assets/images/HomeFlyer.png') }}" alt="">
            </div> --}}
        </div>
    </div>

    <div class="container">
        <div class="title-div">
            <img class="shine" src="{{ asset('admin/assets/images/HomeShineLeft.svg') }}" alt="">
            <p class="title main-text">Productos Destacados</p>
            <img class="shine" src="{{ asset('admin/assets/images/HomeShineRight.svg') }}" alt="">
        </div>
        <div class="noted-products-div">
            @foreach ($notedProducts as $noted)
                <a href="{{ url('/productos/detalle/' . $noted->id) }}" class="noted-products" style="margin-bottom: 15px">
                    <div class="images-overlap product">
                        @if ($noted->color_id == 1)
                            <p class="image-to-overlap noted with-color">Pintada</p>
                        @else
                            <p class="image-to-overlap noted without-color">Sin Pintar</p>
                        @endif
                        <img class="image-to-overlap noted-image" src="{{ asset('admin/assets/images/HomeCategoriesSingles.svg') }}" alt="">
                        <div class="image-to-overlap cart-bag-div">
                            <img class="cart-bag" src="{{ asset('admin/assets/images/HomeCartBag.svg') }}" alt="">
                        </div>
                    </div>
                    <p class="product-name">{{ $noted->name }}</p>
                    <p class="product-price">AR$ {{ $noted->price }}</p>
                </a>
            @endforeach
        </div>
        <a href="{{ url('/productos') }}" class="anchor">Ver todos los productos</a>
    </div>

    <div class="container know-what-section">
        <img class="img-width" src="{{ asset('admin/assets/images/HomeKnowWhatWave.svg') }}" alt="">
        <div class="container know-what-div">
            <img class="know-what-img" src="{{ asset('admin/assets/images/HomeKnowWhatImage.svg') }}" alt="">
            <div class="know-what-text-div">
                <p class="know-what-title">¿SABÍAS QUE?</p>
                <p class="text know-what-text">Los combos incluidos en las Plazas son modificables, para que puedas armar el combo a tu gusto.</p>
            </div>
        </div>
    </div>


    <div class="container about-us-section">
        <img class="about-us-img" src="{{ asset('admin/assets/images/HomeAboutImage.svg') }}" alt="">
        <div class="about-us-text-div">
            <p class="title main-text">Sobre Jugando Toy</p>
            <p class="about-us-text">
                Bajada descriptiva. El siguiente texto es de relleno para mostrar el tamaño máximo de extensión para el texto “sobre nosotros”: There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure(Tamaño máximo: 7 líneas desktop)
            </p>
            <button id="knowMore" class="button-2 about-us-button">Saber más</button>
        </div>
    </div>

    <div class="container blue-bg images-overlap w-100" style="padding-left: 0; padding-right: 0;">
        <img class="w-100" style="margin-top: -2px" src="{{ asset('admin/assets/images/HomeOpinionsCloudsTop.svg') }}" alt="">
        <img class="image-to-overlap opinions-fish" src="{{ asset('admin/assets/images/HomeOpinionsFish.svg') }}" alt="">
        <img class="image-to-overlap opinions-fish-bubbles" src="{{ asset('admin/assets/images/HomeOpinionsFishBubbles.svg') }}" alt="">
        <p class="opinions-title">Qué opinan nuestros compradores</p>
        <img class="opinions-images" id="homeOpinion1" src="{{ asset('admin/assets/images/HomeOpinionsChat1.svg') }}" alt="">
        <img class="opinions-images" id="homeOpinion2" src="{{ asset('admin/assets/images/HomeOpinionsChat2.svg') }}" alt="">
        <img class="opinions-images" id="homeOpinion3" src="{{ asset('admin/assets/images/HomeOpinionsChat3.svg') }}" alt="">
        <img class="w-100" style="margin-bottom: -5px" src="{{ asset('admin/assets/images/HomeOpinionsCloudsBottom.svg') }}" alt="">
    </div>

    <div class="flyer-container" style="height: 72px">
        <div class="flyer-div">
            <div class="flyer">
                <img src="{{ asset('admin/assets/images/HomeSlider.svg') }}" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
