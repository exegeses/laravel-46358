@extends('layouts.plantilla')

    @section('contenido')
        <h1>Panel de administración de regiones</h1>

        <table class="table table-borderless table-stripped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th colspan="2">
                        <a href="" class="btn btn-outline-secondary">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>region</td>
                    <td>
                        <a href="" class="btn btn-outline-secondary">
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="" class="btn btn-outline-secondary">
                            Eliminar
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>


    @endsection
