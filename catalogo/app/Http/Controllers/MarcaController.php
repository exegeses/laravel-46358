<?php

namespace App\Http\Controllers;

use App\Models\Marca;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validación
        $request->validate(
            [ 'mkNombre'=>'required|min:2|max:50' ],
            [
              'mkNombre.required'=>'El nombre de la marca es oblicatorio.',
              'mkNombre.min'=>'El campo Nombre debe tener al menos 2 caractéres',
              'mkNombre.max'=>'El campo Nombre debe tener 50 caractéres como máximo'
            ]
        );

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
