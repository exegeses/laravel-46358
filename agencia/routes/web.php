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
    return view('agregarRegion');
});
Route::post('/agregarRegion', function () {
    //capturamos dato enviado por el form
    $regNombre = $_POST['regNombre'];
    //guardamos
    /*
    DB::insert(
                'INSERT INTO regiones
                    VALUE ( :regNombre ),
                           [ $regNombre ]'
            );
    */
    DB::table('regiones')
            ->insert( [ 'regNombre'=>$regNombre ] );
    //redirigir a una petición con mensaje de ok
    return redirect('/adminRegiones')
                ->with('mensaje', 'Región: '.$regNombre.' agregada correctamente');
});
Route::get('/modificarRegion/{regID}', function ($regID) {
    //obtenenos datos de la región por su id
    /*
    $region = DB::select(
            'SELECT regID, regNombre
                FROM regiones
                WHERE regID = :regID', [$regID]
            );
    */
    $region = DB::table('regiones')
                    ->where('regID', $regID)
                    ->first();

    //retornamos vista pasando datos
    return view('modificarRegion', [ 'region'=>$region ]);
});
Route::post('/modificarRegion', function() {
    //capturamos datos enviados
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    //modificamos
    /*
    DB::update(
            'UPDATE regiones
                SET regNombre = :regNombre
                WHERE regID = :regID', [ $regNombre, $regID]
        );
    */
    DB::table('regiones')
            ->where('regID', $regID)
            ->update( [ 'regNombre'=>$regNombre ] );
    //redirigimos con mensaje
    return redirect('/adminRegiones')
        ->with('mensaje', 'Región: '.$regNombre.' modificada correctamente');
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
Route::get('/agregarDestino', function () {
    return view('agregarDestino');
});



