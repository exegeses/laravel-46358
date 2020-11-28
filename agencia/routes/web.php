<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba1', function () {
    return 'Funciona';
});

Route::get('/prueba2', function() {
    return view('prueba2');
});

Route::get('/prueba3', function () {
    $nombre = 'marcos';
    $marcas = [
                'Nike', 'Ford', 'Sony',
                'Apple', 'Aston Martin',
                'Audiotechnica', 'Marshall'
            ];
    // pasamos datos a la vista
    return view('estructuras',
                    [
                        'nombre'=>$nombre,
                        'marcas'=>$marcas
                    ]);
});
