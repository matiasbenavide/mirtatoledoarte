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
                        <td class="table-content"><p class="table-title"></p></td>
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
                            {{-- <td class="table-content"><p class="table-product-info table-product-detail" onclick="showDetail({{$sale->id}})">Ver detalle</p></td> --}}
                            <td class="table-content">
                                <p class="table-product-info table-product-detail">
                                    @foreach ($sale->products_data as $key => $product)
                                            {{ $product->name }},
                                    @endforeach
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </t-body>
            </table>
            <div class="paginator-container">
                {{ $sales->links() }}
            </div>
        </div>
    </div>
    <section class="bg-light">
        <div class="container">
            <div class="text-center">
                Productos
                @foreach ($sales as $sale)
                    <div id="sale{{$sale->id}}" hidden>
                        <div class="images">
                            @foreach ($sale->products_data as $product)
                                <img src="{{ asset('images/main-images/' . $product->main_image) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
<script>

    function showDetail(saleId)
    {

        let detailDiv = $('#sale'+saleId);

        if (detailDiv[0].hidden)
        {
            detailDiv[0].hidden = false;
        }
        else
        {
            detailDiv[0].hidden = true;
        }
    }
</script>
@endsection
