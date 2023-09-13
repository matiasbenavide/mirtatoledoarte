@extends('layouts.cartMain')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shoppingCart.css') }}">
@endsection

@section('mainContent')
    {{-- @php
        // SDK de Mercado Pago
        require base_path('vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => url('detalle-compra'),
            "failure" => url('home'),
            "pending" => url('home'),
        );

        // Crea un ítem en la preferencia
        foreach ($products as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product['product']->name;
            $item->quantity = $product['quantity'];
            $item->unit_price = $product['product']->price;

            $productsList[] = $item;
        }
        $preference->items = $productsList;
        $preference->save();
    @endphp --}}
    <div class="main-container">
        <div class="main">
            <p class="title">Carrito</p>
            @if ($products)
                @foreach ($products as $product)
                    <div class="product">
                        <div class="img-container">
                            <img class="product-img" src="@if ($product['product']->main_image) {{ asset('images/main-images/' . $product['product']->main_image) }} @endif" alt="">
                        </div>
                        <div class="product-detail">
                            <p class="name">{{ $product['product']->name }}</p>
                            <div class="quantity-price">
                                <div class="" style="width: 100%">
                                    <div class="quantity-div">
                                        @if ($product['quantity'] > 1)
                                            <a class="quantity" style="margin-right: 0.5rem" href="{{ url('remover-carrito/' . $product['product']->category_id . '/' . $product['product']->id) }}"> - </a>
                                        @else
                                            <p class="quantity" style="margin-right: 0.5rem"> - </p>
                                        @endif
                                        <p class="quantity">{{ $product['quantity'] }} @if ($product['quantity'] > 1) unidades @else unidad @endif</p>
                                        <a class="quantity" style="margin-left: 0.5rem" href="{{ url('agregar-carrito/' . $product['product']->category_id . '/' . $product['product']->id) }}"> + </a>
                                    </div>
                                    <p class="quantity">(AR$ {{ number_format($product['product']->price, 2, ',', '.') }})</p>
                                </div>
                                <div class="price-delete-container">
                                    <p class="price">AR$ {{ number_format($product['product']->price * $product['quantity'], 2, ',', '.') }}</p>
                                    <a class="delete" href="{{ url('eliminar-carrito/' . $product['product']->category_id . '/' . $product['product']->id) }}">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="color: rgba(21, 65, 147, 0.25)">
                @endforeach
            @endif
            @if ($combos)
                @foreach ($combos as $product)
                    <div class="product">
                        <div class="img-container">
                            <img class="product-img" src="@if ($product['product']->main_image) {{ asset('images/main-images/' . $product['product']->main_image) }} @endif" alt="">
                        </div>
                        <div class="product-detail">
                            <p class="name">{{ $product['product']->name }}</p>
                            <div class="quantity-price">
                                <div class="" style="width: 100%">
                                    <div class="quantity-div">
                                        @if ($product['quantity'] > 1)
                                            <a class="quantity" style="margin-right: 0.5rem" href="{{ url('remover-carrito/' . $product['product']->category_id . '/' . $product['product']->id) }}"> - </a>
                                        @else
                                            <p class="quantity" style="margin-right: 0.5rem"> - </p>
                                        @endif
                                        <p class="quantity">{{ $product['quantity'] }} @if ($product['quantity'] > 1) unidades @else unidad @endif</p>
                                        <a class="quantity" style="margin-left: 0.5rem" href="{{ url('agregar-carrito/' . $product['product']->category_id . '/' . $product['product']->id) }}"> + </a>
                                    </div>
                                    <p class="quantity">(AR$ {{ number_format($product['product']->price, 2, ',', '.') }})</p>
                                </div>
                                <div class="price-delete-container">
                                    <p class="price">AR$ {{ number_format($product['product']->price * $product['quantity'], 2, ',', '.') }}</p>
                                    <a class="delete" href="{{ url('eliminar-carrito/' . $product['product']->category_id . '/' . $product['product']->id) }}">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="color: rgba(21, 65, 147, 0.25)">
                @endforeach
            @endif
        </div>
        <div class="total-pay">
            <div class="total">
                <p class="total-text">Total</p>
                {{-- <p class="" value>{{ $totalPrice }}</p> --}}
                <input class="total-text total-price-input" type="text" id="totalPrice" value="" readonly>
            </div>
            {{-- <div id="wallet_container">
            </div> --}}
            <a href="{{ url('detalle-compra') }}" class="button pay-button" id="payBtn">Proceder al pago</a>
            <div class="protected-pay">
                <hr style="width: 30%">
                <p class="protected-text">
                    <img src="{{ asset('admin/assets/icons/lock.svg') }}" alt="">
                    Compra asegurada
                </p>
                <hr style="width: 30%">
            </div>
            <div class="cards">
                <img style="margin-right: 2rem" src="{{ asset('admin/assets/icons/Visa.svg') }}" alt="">
                <img src="{{ asset('admin/assets/icons/Mastercard.svg') }}" alt="">
            </div>
        </div>
        <hr class="bottom-line">
    </div>

    <script type="module">
        let products = {!! json_encode($products) !!};
        let combos = {!! json_encode($combos) !!};

        import { main } from "{{ asset(mix('js/shoppingCart.js')) }}";
        import { mainNavbar } from "{{ asset(mix('js/admin/navBar.js')) }}";
        import { mainFooter } from "{{ asset(mix('js/admin/footer.js')) }}";

        window.onload = function() {
            main({
                products: products,
                combos: combos,
            })
            mainNavbar()
            mainFooter()
        }
    </script>
    {{-- SDK MercadoPago.js --}}
    {{-- <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script type="text/javascript">
        const mp = new MercadoPago("{{ config('services.mercadopago.key') }}");
        const bricksBuilder = mp.bricks();

        mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "{{ $preference->id }}",
            redirectMode: "modal",
        },
        });
    </script> --}}
@endsection
