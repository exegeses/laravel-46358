<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de marcas
        $marcas = Marca::paginate(7);
        //retornamos vista pasandole datos
        return view('adminMarcas', [ 'marcas'=>$marcas ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
    }


    /**
     * Método para validar nombre de una marca
     * @param Request $request
     */
    private function validar(Request $request): void
    {
        $request->validate(
            ['mkNombre' => 'required|min:2|max:50'],
            [
                'mkNombre.required' => 'El nombre de la marca es oblicatorio.',
                'mkNombre.min' => 'El campo Nombre debe tener al menos 2 caractéres',
                'mkNombre.max' => 'El campo Nombre debe tener 50 caractéres como máximo'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validación
        $this->validar($request);

        //Instanciamos, asignamos atributos  y guardamos
        $Marca = new Marca;
        $Marca->mkNombre = $request->mkNombre;
        $Marca->save();

        return redirect('/adminMarcas')
                    ->with('mensaje', 'Marca: '.$request->mkNombre.' agregada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos datos de una marca
        $Marca = Marca::find($id);
        //retornamos vista con los datos
        return view('modificarMarca',
                            [
                                'marca'=>$Marca
                            ]
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validacion
        $this->validar($request);
        //obtenemos datos de una marca
        $Marca = Marca::find( $request->idMarca );
        //asignamos cambios y guardamos
        $Marca->mkNombre = $request->mkNombre;
        $Marca->save();
        //retornamos a panel con mensaje
        return redirect('/adminMarcas')
            ->with('mensaje', 'Marca: '.$request->mkNombre.' modificada correctamente');

    }

    public function confirm($id)
    {
        //saber si hay productos de ese marca
        $productos = Producto::where('idMarca', $id)->get()->count();

        //obtener datos de la marca para confirmar baja
        $Marca = Marca::find($id);
        //retornamos vista con datos
        return view('eliminarMarca',
            [
                'productos'=>$productos,
                'marca'=>$Marca
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $idMarca = $request->idMarca;
        $mkNombre = $request->mkNombre;
        //eliminamos marca
        Marca::destroy($idMarca);
        //retornamos a panel con mensaje
        return redirect('/adminMarcas')
            ->with('mensaje', 'Marca: '.$mkNombre.' eliminada correctamente');


    }

}
