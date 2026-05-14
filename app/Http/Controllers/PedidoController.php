<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

/**
 * Class PedidoController
 * @package App\Http\Controllers
 */
class PedidoController extends Controller
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
        $pedidos = Pedido::paginate();

        return view('pedido.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $pedidos->perPage());
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
        $pedido = new Pedido();
        $clientes = Cliente::pluck('name', 'id');
        return view('pedido.create', compact('pedido', 'clientes'));
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
        request()->validate(Pedido::$rules);

        $pedido = Pedido::create($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido created successfully.');
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
        $pedido = Pedido::find($id);

        return view('pedido.show', compact('pedido'));
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
        $pedido = Pedido::find($id);
        $clientes = Cliente::pluck('name', 'id');
        return view('pedido.edit', compact('pedido', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Acceso no autorizado');
        }
        request()->validate(Pedido::$rules);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido updated successfully');
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
        $pedido = Pedido::find($id)->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido deleted successfully');
    }
}
