@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de una marca</h1>

        <div class="alert alert-danger col-5 mx-auto p-4">

        @if( $productos > 0 )
            No se pude eliminar la marca {{ $marca->mkNombre }}, ya que tiene productos
            relacionados.

            <a href="/adminMarcas" class="btn btn-light btn-block my-3">
                Volver a panel
            </a>
        @else

            Se eliminará la marca:
            <span class="lead">{{ $marca->mkNombre }}</span>
            <form action="/eliminarMarca" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="idMarca"
                       value="{{ $marca->idMarca }}">
                <input type="hidden" name="mkNombre"
                       value="{{ $marca->mkNombre }}">
                <button class="btn btn-danger btn-block my-3">
                    Confirmar baja
                </button>
                <a href="/adminMarcas" class="btn btn-light btn-block my-3">
                    Volver a panel
                </a>
            </form>

            <script>
                Swal.fire(
                    'Advertencia',
                    'Si pulsa el botón "Confirmar baja", se eliminará la marca.',
                    'warning'
                )
            </script>

        @endif
        </div>

    @endsection

