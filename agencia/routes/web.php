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
### CRUD Regiones
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
Route::get('/eliminarRegion/{regID}', function($regID) {
    //obtenemos datos de región
    $region = DB::table('regiones')
                ->where('regID', $regID)
                    ->first();
    //retornamos vista con datos de la región
    return view( 'eliminarRegion',
                    [
                        'region'=>$region
                    ]
            );

});
Route::post('/eliminarRegion', function() {
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];

    /*
     * if (DB::table('destinos')->where('regID', $regID)->exists()) {
     *      no se puede borrar porque hay registros
     * }
     * */

    DB::table('regiones')
            ->where('regID', $regID)
            ->delete();
    return redirect('adminRegiones')
                ->with(
                    'mensaje', 'Región: '.$regNombre.' eliminada correctamente.'
                );
});

##################################
### CRUD Destinos
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
    return view('adminDestinos', [ 'destinos'=>$destinos ] );
});
Route::get('/agregarDestino', function () {
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    //retornamos vista pasando datos
    return view('agregarDestino',
                    [ 'regiones'=>$regiones ]
            );
});
Route::post('/agregarDestino', function () {
    //capturar datos
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    //insertar datos en tabla
    DB::table('destinos')
                ->insert(
                    [
                        'destNombre'=>$destNombre,
                        'regID'=>$regID,
                        'destPrecio'=>$destPrecio,
                        'destAsientos'=>$destAsientos,
                        'destDisponibles'=>$destDisponibles
                    ]
                );
    //redireccíon a panel con reporte
    return redirect('/adminDestinos')
                            ->with(
                                [
                                'mensaje'=>'Destino: '.$destNombre.' agregado correctamente'
                                ]
                            );
});
Route::get('/modificarDestino/{destID}', function ($destID) {
    //obtenemos datos de un destino
    $destino = DB::table('destinos as d')
                    ->join('regiones as r', 'd.regID', '=', 'r.regID')
                    ->where('d.destID', $destID)
                    ->first();
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    //retornar a vista de formulario con datos
    return view('modificarDestino',
                        [
                            'destino'=>$destino,
                            'regiones'=>$regiones
                        ]
            );
});
Route::post('/modificarDestino', function (){
    //capturar datos
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    $destID = $_POST['destID'];
    //modificamos
    DB::table('destinos')
                ->where('destID', $destID)
                ->update(
                    [
                        'destNombre'=>$destNombre,
                        'regID'=>$regID,
                        'destPrecio'=>$destPrecio,
                        'destAsientos'=>$destAsientos,
                        'destDisponibles'=>$destDisponibles
                    ]
                );
    //redireccíon a panel con reporte
    return redirect('/adminDestinos')
                ->with(
                        'mensaje', 'Destino: '.$destNombre.' modificado correctamente'
                );
});

