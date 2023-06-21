@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-section.css') }}">
@endsection
@section('content')
    <div class="admin-section">
        <div>
            <h1 class="title">PRODUCTOS</h1>
            <p class="sub-title">En esta sección podés dar de alta, baja y modificar tus productos y combos publicados.</p>
        </div>
        <div class="row col-12">
            <div class="pops-div p-0">
                <div class="pops blue">
                    <h3 class="pops-title">{{ $total }}</h3>
                    <p class="pops-text">Productos listados</p>
                </div>
                <div class="pops orange">
                    <h3 class="pops-title">{{ $totalCombos }}</h3>
                    <p class="pops-text">Plazas y combos</p>
                </div>
                <div class="pops yellow">
                    <h3 class="pops-title">{{ $totalProducts }}</h3>
                    <p class="pops-text">Individuales</p>
                </div>
            </div>
            <div class="col-12 mt-4">
                <form id="productConsult" action="POST">
                    <div class="row col-12 align-items-center">
                        <div class="input-div col-6 col-xxl-7">
                            <input class="form-consult-search" type="text" placeholder="Buscar productos">
                            <span class="input-icon">
                                <img src="{{ asset('admin/assets/icons/search.svg') }}" alt="">
                            </span>
                        </div>
                        <div class="col-3 col-xxl-3 d-flex justify-content-end">
                            <button class="btn button-filter w-100"> <img src="{{ asset('admin/assets/icons/order.svg') }}" alt=""> Ordenar por</button>
                        </div>
                        <div class="col-3 col-xxl-2 d-flex justify-content-end">
                            <button class="btn button-filter w-100" type="submit">Filtrar</button>
                        </div>
                    </div>
                </form>
                <table class="products-table">
                    <t-head>
                        <tr>
                            <td class="table-content"><p class="table-title">Producto</p></td>
                            <td class="table-content"><p class="table-title">Tipo</p></td>
                            <td class="table-content"><p class="table-title">Color</p></td>
                            <td class="table-content"><p class="table-title">Precio</p></td>
                            <td class="table-content"><p class="table-title">Estado</p></td>
                        </tr>
                    </t-head>
                    <t-body>
                        @foreach ($products as $product)
                            <tr class="products-table-item">
                                <td class="table-content"><p class="table-product-info">{{ $product->name }}</p></td>
                                <td class="table-content"><p class="table-product-info @if($product->category_id == 1) ind-color @else combo-color @endif">{{ $product->category }}</p></td>
                                <td class="table-content">
                                    <p>
                                        @if ($product->color_id == 1)
                                            <p class="table-product-info mb-2 py-0">
                                                <img class="table-colors" src="{{ asset('admin/assets/colors/red.svg') }}" alt="">
                                                <img class="table-colors" src="{{ asset('admin/assets/colors/yellow.svg') }}" alt="">
                                                <img class="table-colors" src="{{ asset('admin/assets/colors/green.svg') }}" alt="">
                                                <img class="table-colors" src="{{ asset('admin/assets/colors/blue.svg') }}" alt="">
                                            </p>
                                            <p class="table-product-info color-text mt-0 py-0">Arcoíris</p>
                                        @else
                                            <p class="table-product-info mb-2 py-0">
                                                <img class="table-colors" src="{{ asset('admin/assets/colors/no_color.svg') }}" alt="">
                                            </p>
                                            <p class="table-product-info color-text mt-0 py-0">Sin pintar</p>
                                        @endif
                                    </p>
                                </td class="table-content">
                                <td class="table-content"><p class="table-product-info">$ {{ $product->price }}</p></td>
                                <td class="table-content"><p class="table-product-info" id="status">Habilitado</p></td>
                                <td class="table-content">
                                    <p class="table-product-info">
                                        <a href="{{ url('/administracion/productos/crear-editar/' . $product->id) }}">Editar</a>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </t-body>
                </table>
            </div>
        </div>
    </div>
@endsection

