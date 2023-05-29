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
            <div class="pops-div">
                <div class="pops blue" style="margin-right: 20px">
                    <div class="pops-pad">
                        <h3 class="pops-title">{{ $total }}</h3>
                        <p class="pops-text">Productos listados</p>
                    </div>
                </div>
                <div class="pops orange" style="margin-right: 20px">
                    <div class="pops-pad">
                        <h3 class="pops-title">{{ $totalCombos }}</h3>
                        <p class="pops-text">Plazas y combos</p>
                    </div>
                </div>
                <div class="pops yellow">
                    <div class="pops-pad">
                        <h3 class="pops-title">{{ $totalProducts }}</h3>
                        <p class="pops-text">Individuales</p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <form id="productConsult" action="POST">
                    <div class="row col-12">
                        <div class="col-6">
                            <input class="form-consult-search" type="text">
                            <img class="icon form-consult-search-icon" src="{{ asset('admin/assets/icons/search.svg') }}" alt="">
                        </div>
                        <div class="col-3">
                            <button class="btn button-filter w-100"> <img src="{{ asset('admin/assets/icons/order.svg') }}" alt=""> Ordenar por</button>
                        </div>
                        <div class="col-3">
                            <button class="btn button-filter w-100" type="submit">Filtrar</button>
                        </div>
                    </div>
                </form>
                <table class="products-table">
                    <tr>
                        <td class="table-titles">Producto</td>
                        <td class="table-titles">Tipo</td>
                        <td class="table-titles">Color</td>
                        <td class="table-titles">Precio</td>
                        <td class="table-titles">Estado</td>
                    </tr>
                    @foreach ($products as $product)
                        <tr class="products-table-item">
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>
                                @if ($product->color_id == 1)
                                    <img class="table-colors" src="{{ asset('admin/assets/colors/red.svg') }}" alt="">
                                    <img class="table-colors" src="{{ asset('admin/assets/colors/yellow.svg') }}" alt="">
                                    <img class="table-colors" src="{{ asset('admin/assets/colors/green.svg') }}" alt="">
                                    <img class="table-colors" src="{{ asset('admin/assets/colors/blue.svg') }}" alt="">
                                @else

                                @endif
                            </td>
                            <td>$ {{ $product->price }}</td>
                            <td><p class="status">Habilitado</p></td>
                            <td class="table-titles">
                                <a href="{{ url('/administracion/productos/crear-editar/' . $product->id) }}">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

