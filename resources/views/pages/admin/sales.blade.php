@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-section.css') }}">
@endsection
@section('content')
    <div class="admin-section">
        <div>
            <h1 class="title">VENTAS</h1>
            <p class="sub-title">En esta sección podés consultar las ventas registradas y los datos de tus clientes.</p>
        </div>
        <div class="row col-12">
            <div class="col-12 mt-4">
                <form id="productConsult" action="POST">
                    <div class="row col-12 align-items-center">
                        <div class="input-div col-6 col-xxl-7">
                            <input class="form-consult-search" type="text" placeholder="Buscar por nombre, documento o código">
                            <span class="input-icon">
                                <img src="{{ asset('admin/assets/icons/search.svg') }}" alt="">
                            </span>
                        </div>
                    </div>
                </form>
                <table class="products-table">
                    <t-head>
                        <tr>
                            <td class="table-content"><p class="table-title">Nombre</p></td>
                            <td class="table-content"><p class="table-title">Documento</p></td>
                            <td class="table-content"><p class="table-title">Código de referencia</p></td>
                            <td class="table-content"><p class="table-title">Email</p></td>
                            <td class="table-content"><p class="table-title">Teléfono</p></td>
                            <td class="table-content"><p class="table-title">Envío</p></td>
                            <td class="table-content"><p class="table-title">Detalle</p></td>
                        </tr>
                    </t-head>
                    <t-body>
                        @foreach ($sales as $sale)
                            <tr class="products-table-item">
                                <td class="table-content"><p class="table-product-info">{{ $sale->name }}</p></td>
                                <td class="table-content"><p class="table-product-info">{{ $sale->document_number }}</p></td>
                                <td class="table-content"><p class="table-product-info">{{ $sale->reference_code }}</p></td>
                                <td class="table-content"><p class="table-product-info">{{ $sale->email }}</p></td>
                                <td class="table-content"><p class="table-product-info">{{ $sale->phone_number }}</p></td>
                                <td class="table-content"><p class="table-product-info">{{ $sale->shipping }}</p></td>
                                <td class="table-content"><p class="table-product-info table-product-detail" id="saleDetail{{$sale->id}}">Ver detalle</p></td>
                            </tr>
                        @endforeach
                    </t-body>
                </table>
                <div class="paginator-container">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
        <dialog id="popUp">
            <div class="popup-container">
                <div class="popup-container person-shipping">
                    <div class="person-data">
                        <div>
                            <label class="label" for="name">Nombre</label>
                            <p id="name"></p>
                        </div>
                        <div>
                            <label class="label" for="phoneNumber">Teléfono</label>
                            <p id="phoneNumber"></p>
                        </div>
                        <div>
                            <label class="label" for="email">Email</label>
                            <p id="email"></p>
                        </div>
                    </div>
                    <div class="shipping-data">
                        <div>
                            <label class="label" for="shippingOption">Tipo de envío</label>
                            <p id="shippingOption"></p>
                        </div>
                        <div id="directionDiv" hidden>
                            <label class="label" for="direction">Dirección</label>
                            <p id="direction"></p>
                        </div>
                        <div id="provinceDiv" hidden>
                            <label class="label" for="province">Provincia</label>
                            <p id="province"></p>
                        </div>
                        <div id="localityDiv" hidden>
                            <label class="label" for="locality">Localidad</label>
                            <p id="locality"></p>
                        </div>
                        <div id="zipCodeDiv" hidden>
                            <label class="label" for="zipCode">Código postal</label>
                            <p id="zipCode"></p>
                        </div>
                    </div>
                </div>
                <div class="sale-products-container">
                    <table class="products-table">
                        <t-head>
                            <tr>
                                <td class="table-content"></td>
                                <td class="table-content"><p class="table-title">Nombre</p></td>
                                <td class="table-content"><p class="table-title">Precio</p></td>
                                <td class="table-content"><p class="table-title">Cantidad</p></td>
                            </tr>
                        </t-head>
                        <t-body>
                            <tr class="products-table-item" id="productsContainer">
                            </tr>
                        </t-body>
                    </table>
                    <div>
                        <label class="label" for="referenceCode">Código de referencia</label>
                        <p id="referenceCode"></p>
                    </div>
                </div>
            </div>
            <a id="close">Volver</a>
        </dialog>
    </div>
    <script type="module">
        let url = {!! json_encode(url('/images/main-images')) !!};
        let ship = {!! json_encode(App\Models\Admin\ShippingOption::SHIP) !!};
        let sales = {!! json_encode($allSales) !!};

        import { main } from "{{ asset(mix('js/admin/sales.js')) }}";

        window.onload = function() {
            main({
                url: url,
                sales: sales,
            })
        }
    </script>
@endsection
