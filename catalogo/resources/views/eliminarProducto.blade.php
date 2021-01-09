@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de un producto</h1>

        <div class="row alert bg-light border-danger col-8 mx-auto p-2">
            <div class="col">
                <img src="/productos/{{ $Producto->prdImagen }}" class="img-thumbnail">
            </div>
            <div class="col text-danger align-self-center">

                <form action="/eliminarProducto" method="post">

                    <h2>{{ $Producto->prdNombre }}</h2>
                    Categoría: {{ $Producto->relCategoria->catNombre }}
                    <br>
                    Marca: {{ $Producto->relMarca->mkNombre }}
                    <br>
                    Presentación: {{ $Producto->prdPresentacion }}
                    <br>
                    Precio: ${{ $Producto->prdPrecio }}

                </form>

            </div>
        </div>

    @endsection

