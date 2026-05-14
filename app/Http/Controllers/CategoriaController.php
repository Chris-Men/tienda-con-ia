<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Categoria;
use Illuminate\Http\Request;

/**
 * Class CategoriaController
 * @package App\Http\Controllers
 */
class CategoriaController extends Controller
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
        $categorias = Categoria::paginate();

        return view('categoria.index', compact('categorias'))
            ->with('i', (request()->input('page', 1) - 1) * $categorias->perPage());
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
        $categoria = new Categoria();
        return view('categoria.create', compact('categoria'));
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
        request()->validate(Categoria::$rules);

        $categoria = Categoria::create($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        $categoria = Categoria::find($id);

        return view('categoria.show', compact('categoria'));
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
        $categoria = Categoria::find($id);

        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        request()->validate(Categoria::$rules);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria updated successfully');
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
        $categoria = Categoria::find($id)->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria deleted successfully');
    }

    public function pdf()
    {
        $categoria = Categoria::paginate();

        $pdf = PDF::loadView('categoria.pdf',['categorias'=>$categoria]);
        return $pdf->stream();
    }
}
