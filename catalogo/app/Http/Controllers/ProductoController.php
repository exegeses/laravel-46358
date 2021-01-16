<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('relMarca', 'relCategoria')->paginate(5);

        //retornamos vista pasando datos
        return view('adminProductos', [ 'productos'=>$productos ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtenemos listados de marcas y categorías
        $marcas = Marca::all();
        $categorias = Categoria::all();
        //retornamos vista
        return view('agregarProducto',
            [
                'marcas'=>$marcas,
                'categorias'=>$categorias
            ]
        );
    }

    private function validar(Request $request)
    {
        $request->validate(
            [
                'prdNombre'=>'required|min:3|max:70',
                'prdPrecio'=>'required|numeric|min:0',
                'prdPresentacion'=>'required|min:3|max:150',
                'prdStock'=>'required|integer|min:1',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required'=>'Complete el campo Nombre',
                'prdNombre.min'=>'Complete el campo Nombre con al menos 3 caractéres',
                'prdNombre.max'=>'Complete el campo Nombre con 70 caractéres como máxino',
                'prdPrecio.required'=>'Complete el campo Precio',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número',
                'prdPrecio.min'=>'Complete el campo Precio con un número positivo',
                'prdPresentacion.required'=>'Complete el campo Presentación',
                'prdPresentacion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                'prdPresentacion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino',
                'prdStock.required'=>'Complete el campo Stock',
                'prdStock.integer'=>'Complete el campo Stock con un número entero',
                'prdStock.min'=>'Complete el campo Stock con un número positivo',
                'prdImagen.mimes'=>'Debe ser una imagen',
                'prdImagen.max'=>'Debe ser una imagen de 2MB como máximo'
            ]
        );
    }

    private function subirImagen(Request $request)
    {
        //si no enviaron imagen - store()
        $prdImagen = 'noDisponible.jpg';

        //si no enviaron imagen - update()
        if( $request->has('imgActual') ){
            $prdImagen = $request->imgActual;
        }

        //si enviaron imagen
        if( $request->file('prdImagen') ){
            //renombrar
                #nombre original
                //$request->file('prdImagen')->getClientOriginalName();
                #time().'.'.extension
                $prdImagen = time().'.'.$request->file('prdImagen')->clientExtension();
            //subir archivo en directorio 'productos'
            $request->file('prdImagen')
                            ->move( public_path('productos/'), $prdImagen );
        }
        return $prdImagen;
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
        $prdImagen = $this->subirImagen($request);

        //instanciamos
        $Producto = new Producto;
        //asignamos atributos
        $Producto->prdNombre = $request->prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        $Producto->prdImagen = $prdImagen;
        //guardar
        $Producto->save();
        //redirección con mensaje de ok
        return redirect('/adminProductos')
                    ->with('mensaje', 'Producto: '.$Producto->prdNombre.' agregado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($idProducto)
    {
        //obtenemos listados de marcas y categorías
        $marcas = Marca::all();
        $categorias = Categoria::all();
        //obtenemos datos del producto
        $Producto = Producto::with('relMarca', 'relCategoria')
                                ->find($idProducto);

        return view('modificarProducto',
                    [
                        'marcas'=>$marcas,
                        'categorias'=>$categorias,
                        'Producto'=>$Producto
                    ]
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validación
        $this->validar($request);
        //obtenemos datos de producto
        $Producto = Producto::find($request->idProducto);
        //sobreescritura de atributos
        $Producto->prdNombre = $request->prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
            //subir imagen si enviaron
        $Producto->prdImagen = $this->subirImagen($request);
        //guardamos
        $Producto->save();
        //redirección con mensaje de ok
        return redirect('/adminProductos')
            ->with('mensaje', 'Producto: '.$Producto->prdNombre.' modificado correctamente.');
    }

    public function confirmar($idProducto)
    {
        //obtenemos datos de producto
        $Producto = Producto::with('relMarca', 'relCategoria')
                                ->find($idProducto);
        //retornamos vista de confirmación
        return view('eliminarProducto',
                    [
                        'Producto'=>$Producto
                    ]
                );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $idProducto = $request->idProducto;
        $prdNombre = $request->prdNombre;
        Producto::destroy($idProducto);
        /*
         * si quisieramos eliminar archivo
         * 1º obtener datos de Producto
         * 2º chequear SI NO ES == 'noDisponible.jpg'
         *      eliminar usando:
         *      Storage::delete( public_path('productos/'.Producto->prdImagen) );
         * */

        //redirección con mensaje de ok
        return redirect('/adminProductos')
            ->with('mensaje', 'Producto: '.$prdNombre.' eliminado correctamente.');

    }
}
