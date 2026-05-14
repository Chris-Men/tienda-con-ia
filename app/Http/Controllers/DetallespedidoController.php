<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Detallespedido;

/**
 * Class DetallespedidoController
 * @package App\Http\Controllers
 */
class DetallespedidoController extends Controller
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
        $detallespedidos = Detallespedido::paginate();

        return view('detallespedido.index', compact('detallespedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $detallespedidos->perPage());
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
        $detallespedido = new Detallespedido();
        $pedidos = Pedido::pluck('id', 'id');
        $productos = Producto::pluck('nombre', 'id');

        return view('detallespedido.create', compact('detallespedido', 'pedidos', 'productos'));
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
        request()->validate(Detallespedido::$rules);

        $detallespedido = Detallespedido::create($request->all());

        return redirect()->route('detallespedidos.index')
            ->with('success', 'Detallespedido created successfully.');
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
        $detallespedido = Detallespedido::find($id);

        return view('detallespedido.show', compact('detallespedido'));
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
        $detallespedido = Detallespedido::find($id);
        $pedidos = Pedido::pluck('id', 'id');
        $productos = Producto::pluck('nombre', 'id');

        return view('detallespedido.edit', compact('detallespedido', 'pedidos', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallespedido $detallespedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallespedido $detallespedido)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        request()->validate(Detallespedido::$rules);

        $detallespedido->update($request->all());

        return redirect()->route('detallespedidos.index')
            ->with('success', 'Detallespedido updated successfully');
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
        $detallespedido = Detallespedido::find($id)->delete();

        return redirect()->route('detallespedidos.index')
            ->with('success', 'Detallespedido deleted successfully');
    }
}
