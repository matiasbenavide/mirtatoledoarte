@extends('layouts.payMain')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pay.css') }}">
@endsection

@section('mainContent')
    <div class="main">
        <div class="logo-details">
            <a href="{{ url('home') }}">
                <img class="logo" src="{{ asset('admin/assets/icons/logo.svg') }}" alt="">
            </a>
            <div class="buy-details">
                <div class="dropdown" id="detailDropdown" onclick="toggle(null, 'shoppingDetail')">
                    <p class="dropdown-text">
                        <img class="dropdown-cart" src="{{ asset('admin/assets/icons/cartBlue.svg') }}" alt="">
                        Ver detalle de compra
                        <img class="dropdown-arrow" src="{{ asset('admin/assets/icons/arrowDown.svg') }}" alt="">
                    </p>
                    <p class="dropdown-price">AR$ {{ number_format($cart->totalPrice, 2, ',', '.') }}</p>
                </div>
                <div class="products active" id="shoppingDetail">
                    @if ($products)
                        @foreach ($products as $product)
                        <div class="product">
                            <img class="product-img" src="@if ($product['product']->main_image) {{ asset('images/main-images/' . $product['product']->main_image) }} @else {{ asset('admin/assets/images/ImageNotFound.svg') }} @endif" alt="">
                            <div class="product-detail">
                                <p class="name">{{ $product['product']->name }}</p>
                                <div class="quantity-price">
                                    <div class="quantity-div">
                                        <p class="quantity">{{ $product['quantity'] }} @if ($product['quantity'] > 1) unidades @else unidad @endif</p>
                                    </div>
                                    <p class="price">AR$ {{ number_format($product['product']->price * $product['quantity'], 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <hr style="color: rgba(21, 65, 147, 0.25)">
                        @endforeach
                    @endif
                    @if ($combos)
                        @foreach ($combos as $product)
                        <div class="product">
                            <img class="product-img" src="@if ($product['product']->main_image) {{ asset('images/main-images/' . $product['product']->main_image) }} @else {{ asset('admin/assets/images/ImageNotFound.svg') }} @endif" alt="">
                            <div class="product-detail">
                                <p class="name">{{ $product['product']->name }}</p>
                                <div class="quantity-price">
                                    <div class="quantity-div">
                                        <p class="quantity">{{ $product['quantity'] }} @if ($product['quantity'] > 1) unidades @else unidad @endif</p>
                                    </div>
                                    <p class="price">AR$ {{ number_format($product['product']->price * $product['quantity'], 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <hr style="color: rgba(21, 65, 147, 0.25)">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <form class="form" action="{{ url('guardar-compra') }}" method="POST" id="payForm" enctype="multipart/form-data">
            @csrf
            <input name="totalAmount" type="number" value="{{ $cart->totalPrice }}" hidden>
            <input name="products" id="products" hidden>
            <div class="inputs-container" id="container1">
                <div class="number-title" id="numberTitle0">
                    <p class="form-number">1</p>
                    <p class="form-title">Información del comprador</p>
                </div>
                <div class="inputs-div" id="inputsDiv0">
                    <div class="inputs">
                        <label class="label" for="name">Nombre y apellido</label>
                        <input class="form-input" type="text" name="name" id="name" placeholder="Ingresá acá tu nombre y apellido">
                        <p class="input-error active"></p>
                    </div>
                    <div class="inputs">
                        <label class="label" for="phoneNumber">Número de teléfono</label>
                        <input class="form-input" type="text" name="phoneNumber" id="phoneNumber" placeholder="Ingresá acá tu teléfono">
                        <p class="input-error active"></p>
                    </div>
                    <div class="inputs">
                        <label class="label" for="email">Dirección de e-mail</label>
                        <input class="form-input" type="text" name="email" id="email" placeholder="Ingresá acá tu e-mail">
                        <p class="input-error active"></p>
                    </div>
                    <div class="inputs">
                        <label class="label" for="documentNumber">DNI - CUIT</label>
                        <input class="form-input" type="text" name="documentNumber" id="documentNumber" placeholder="Ingresá acá tu DNI o CUIT">
                        <p class="input-error active"></p>
                    </div>
                    <button type="button" id="firstForm" class="button form-btn">Continuar a envío</button>
                </div>
            </div>
            <div class="inputs-container padding" id="container2">
                <div class="number-title" id="numberTitle1">
                    <p class="form-number">2</p>
                    <p class="form-title">Información de envío</p>
                </div>
                <div class="inputs-div active" id="inputsDiv1">
                    <div class="inputs">
                        <label class="label" for="province">Forma de envío</label>
                        <select class="form-input" name="shippingSelect" id="shippingSelect">
                            <option value="">Seleccione una forma de Envío</option>
                            @foreach ($shippingOptions as $shippingOption)
                                <option value="{{ $shippingOption->id }}">{{ $shippingOption->name }}</option>
                            @endforeach
                        </select>
                        <p class="input-error active"></p>
                    </div>
                    <div id="shippingInfo" hidden>
                        <div class="inputs">
                            <label class="label" for="province">Dirección</label>
                            <input class="form-input" type="text" name="dirección" id="dirección" placeholder="Ingresá acá tu dirección">
                            <p class="input-error active"></p>
                        </div>
                        <div class="inputs">
                            <label class="label" for="province">Provincia</label>
                            <input class="form-input" type="text" name="province" id="province" placeholder="Ingresá acá tu provincia">
                            <p class="input-error active"></p>
                        </div>
                        <div class="inputs">
                            <label class="label" for="locality">Localidad</label>
                            <input class="form-input" type="text" name="locality" id="locality" placeholder="Ingresá acá tu localidad">
                            <p class="input-error active"></p>
                        </div>
                        <div class="inputs">
                            <label class="label" for="zipCode">Código postal</label>
                            <input class="form-input" type="text" name="zipCode" id="zipCode" placeholder="Ingresá acá tu Código postal">
                            <p class="input-error active"></p>
                        </div>
                    </div>
                    <button type="button" id="secondForm" class="button form-btn">Continuar a pago</button>
                </div>
            </div>
            <div class="inputs-container padding" id="container3">
                <div class="number-title" id="numberTitle2">
                    <p class="form-number">3</p>
                    <p class="form-title">Pago</p>
                </div>
                <div class="inputs-div active" id="inputsDiv2">
                    <div class="inputs">
                        <p>CBU</p>
                        <p>000000000000000</p>
                        <p>ALIAS</p>
                        <p>ALIAS.ALIAS</p>
                    </div>
                    <div class="inputs">
                        <label class="label" for="receipt">Comprobante</label>
                        <input class="file-input" type="file" name="receipt" id="receipt">
                        <p class="input-error active"></p>
                    </div>
                    <div class="inputs">
                        <label class="label" for="referenceCode">Código de referencia</label>
                        <input class="form-input" type="text" name="referenceCode" id="referenceCode">
                        <p class="input-error active"></p>
                    </div>
                    <button type="button" id="thirdForm" class="button form-btn">Enviar Pago</button>
                </div>
            </div>
        </form>
    </div>

    <script type="module">
        let products = {!! json_encode($products) !!};
        let combos = {!! json_encode($combos) !!};
        let withdraw = {!! json_encode(App\Models\Admin\ShippingOption::WITHDRAW) !!}

        import { main } from "{{ asset(mix('js/payment.js')) }}"

        window.onload = function() {
            main({
                products: products,
                combos: combos,
                withdraw: withdraw,
            });
        };
    </script>

    <script type="text/javascript">
        let shippingOption = $('#shippingSelect');
        let shipingInfo = $('#shippingInfo');

        shippingOption.on('change', function() {
            console.log(shippingOption[0].value);
            if (shippingOption[0].value == 1) {
                shippingInfo.hidden = false;
            }
            else {
                shippingInfo.hidden = true;
            }
        })

        function toggle(clickId, id)
        {
            if (clickId != null) {
                document.getElementById(clickId).classList.toggle('padding');
            }
            document.getElementById(id).classList.toggle('active');
        }
    </script>
@endsection
