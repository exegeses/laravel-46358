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

##############################
##  Route::metodo( 'peticion', acción );
##############################

##################################
### pantalla de inicio
Route::get('/inicio', function () {
    return view('inicio');
});

##################################
### Regiones
Route::get('/adminRegiones', function () {
    //obtenemos datos de regiones
    //$regiones = DB::select('SELECT regID, regNombre FROM regiones');
    $regiones = DB::table('regiones')->get();
    //pasar dato a la vista
    return view('adminRegiones', [ 'regiones'=>$regiones ]);
});
Route::get('/agregarRegion', function () {
    //mostrar el formulario
    return view();
});

##################################
### Destinos
Route::get('/adminDestinos', function (){
    /*
    $destinos = DB::select('SELECT
                                    destID, destNombre, destPrecio,
                                    d.regID, r.regNombre
                                FROM  destinos as d
                                INNER JOIN regiones as r
                                ON d.regID = r.regID');
    */
    $destinos = DB::table('destinos as d')
                        ->join('regiones as r', 'd.regID', '=', 'r.regID')
                        ->get();
    return view('adminDestinos',[ 'destinos'=>$destinos ]);
});



