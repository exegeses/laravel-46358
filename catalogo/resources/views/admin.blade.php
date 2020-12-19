@extends('layouts.plantilla')

    @section('contenido')

        <h1>Dashboard</h1>

        <div class="list-group">
                <a href="/adminMarcas" class="list-group-item list-group-item-action">
                    Panel de administración de marcas.
                </a>
                <a href="/adminCategorias" class="list-group-item list-group-item-action">
                    Panel de administración de categorías.
                </a>
                <a href="/adminProductos" class="list-group-item list-group-item-action">
                    Panel de administración de productos.
                </a>
        </div>

    @endsection

