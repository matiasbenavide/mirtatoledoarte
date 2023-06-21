@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-section.css') }}">
@endsection
@section('content')
    <form class="admin-section" id="productForm" action="{{ url('/administracion/productos/creacion-edicion') }}" method="POST">
        @csrf
        <div>
            <h1 class="title">NUEVO PRODUCTO</h1>
            <p class="sub-title">Desde acá podés añadir productos nuevos a la tienda</p>
        </div>
        <div class="row col-12">

            @isset($product)
                <div class="col-12">
                    <label class="label" for="productId"></label>
                    <input class="form-input" name="productId" id="productId" value="{{ $product->id }}" hidden/>
                </div>
            @endisset

            <div class="col-5">
                <label class="label" for="category_id">Tipo de Producto</label>
                <select class="form-input" name="category_id" id="category_id">
                    @if ($categories->count() > 1)
                        <option class="form-input" value="">Seleccioná un tipo de producto</option>
                    @endif
                    @foreach ($categories as $category)
                        <option class="form-input" value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-5">
                <label class="label" for="name"></label>
                <input class="form-input" name="name" id="name" type="text" placeholder="Nombre"/>
            </div>

            <div class="col-2">
                <label class="label" for="price"></label>
                <input class="form-input" name="price" id="price" type="number" placeholder="Precio"/>
            </div>

            <div class="col-12">
                <label class="label" for="description"></label>
                <textarea class="form-textarea" name="description" id="description" rows="5" placeholder="Descripción"></textarea>
            </div>

            <div class="col-5 mt-2">
                <label class="label" for="material">Material</label>
                <input class="form-input" name="material" id="material" type="text" placeholder="Ej: MDF Laqueado de 20mm"/>
            </div>

            <div class="col-4 mt-2">
                <label class="label" for="size">Medidas (cm.)</label>
                <input class="form-input" name="size" id="size" type="text" placeholder="Ej: 24 x 32 x 50"/>
            </div>

            <div class="col-3 mt-2">
                <label class="label" for="max_weight">Peso Máximo (Kg.)</label>
                <input class="form-input" name="max_weight" id="max_weight" type="number" placeholder="Ej: 4.5"/>
            </div>

            <div class="col-4 mt-2 mb-4">
                <label class="label" for="color_id">Color</label>
                <select class="decorated form-input input-div" name="color_id" id="color_id">
                    @if ($categories->count() > 1)
                        <option class="form-input" value="">Seleccioná un tipo de color</option>
                    @endif
                    @foreach ($colors as $color)
                        <option class="form-input" value="{{ $color->id }}">
                            {{ $color->color }}
                            @if ($color->id == 1)
                                    <img src="{{ asset('admin/assets/colors/blue.svg') }}" alt="">
                            @else

                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex col-8 mt-2 mb-4">
                <div>
                    <label class="label" for="">Imágenes</label>
                    <label class="add-icon-div" for="images">
                        <img class="add-icon" src="{{ asset('admin/assets/icons/plus_blue.svg') }}" alt="">
                    </label>
                    <input id="images" name="images" class="image-input" type="file" multiple onchange="imageSelect()">
                </div>
                <div id="displayImage" class="images-div"></div>
            </div>

            <div class="col-12 create-button-div">
                <button class="btn button-filter w-100" style="margin-top: 15px; max-width: 879px;" type="submit">Listar Producto</button>
            </div>
        </div>
    </form>
    <script type="module">
        let product = {!! json_encode($product) !!};

        import { main } from "{{ asset(mix('js/admin/product.js')) }}"

        window.onload = function() {
            main({
                product: product
            })
        }
    </script>
    <script type="text/javascript">
        let form = document.getElementById('productForm');
        let images = document.getElementById('images');

        //***** IMAGES *****//
        let imagesDiv = document.getElementById('displayImage');
        let allImages = [];

        function imageSelect() {
            let files = images.files;

            for (let i = 0; i < files.length; i++) {
                allImages.push({
                    "name": files[i].name,
                    "url": URL.createObjectURL(files[i]),
                    "file": files[i],
                });
            }

            form.reset();
            imagesDiv.innerHTML = showImages();

        }

        function showImages() {
            var image = `<label class="col-12 label" style="margin-top: 4px; margin-bottom: 4px;" for="">:</label>`;

            allImages.forEach((file) => {
                image += `<div class="img-div d-flex justify-content-center position-relative" style="max-width: 100%;"><img class="form-image" src="`+ file.url +`" alt="image" onclick="deleteImage(`+ allImages.indexOf(file) +`)"></div>`;
            });

            return image;
        }

        function deleteImage(e) {
            allImages.splice(e, 1);
            imagesDiv.innerHTML = showImages();
        }
    </script>
@endsection
