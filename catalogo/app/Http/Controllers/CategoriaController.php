<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de categorias
        $categorias = Categoria::paginate(7);
        //retornamos vista pasando datos
        return view('adminCategorias', [ 'categorias'=>$categorias ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarCategpria');
    }

    /**
     * Método para validar nombre de una categoría
     * @param Request $request
     */
    private function validar(Request $request): void
    {
        $request->validate(
            ['catNombre' => 'required|min:2|max:50'],
            [
                'catNombre.required' => 'El nombre de la categoría es oblicatorio.',
                'catNombre.min' => 'El campo Nombre debe tener al menos 2 caractéres',
                'catNombre.max' => 'El campo Nombre debe tener 50 caractéres como máximo'
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
        $Categoria = new Categoria;
        $Categoria->catNombre = $request->catNombre;
        $Categoria->save();

        return redirect('/adminCategorias')
            ->with('mensaje', 'Categoría: '.$request->catNombre.' agregada correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
