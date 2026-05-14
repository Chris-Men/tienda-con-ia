<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use PDF;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        $productos = Producto::paginate();

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        $producto = new Producto();
        $categorias = Categoria::pluck('nombre', 'id');

        return view('producto.create', compact('producto', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        request()->validate(Producto::$rules);

        $producto = Producto::create($request->all());

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $producto->imagen = 'images/' . $nombreImagen;
            $producto->save();
        }

        return redirect()->route('productos.index')
            ->with('success', 'Producto created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (!auth()->user()->hasRole('admin')) {
        //     abort(403, 'Acceso no autorizado');
        // }
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        $producto = Producto::find($id);
        $categorias = Categoria::pluck('nombre', 'id');

        return view('producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        request()->validate(Producto::$rules);

        $producto->update($request->all());

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();

            if ($producto->imagen) {
                $rutaImagen = public_path('images/' . $producto->imagen);

                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen);
                }
            }

            $imagen->move(public_path('images'), $nombreImagen);
            $producto->imagen = 'images/' . $nombreImagen;
            $producto->save();
        }

        return redirect()->route('productos.index')
            ->with('success', 'Producto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto deleted successfully');
    }

    public function pdf()
    {
        $producto = Producto::paginate();

        $pdf = PDF::loadView('producto.pdf', ['productos' => $producto]);
        return $pdf->stream();
    }
}
