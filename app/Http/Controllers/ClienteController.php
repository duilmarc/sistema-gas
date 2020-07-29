<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function __construct(){
        $this->middleware('auth');
    }*/

        public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $clientes = Cliente::all()->sortByDesc('balon_prestado');
        return view('Clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Clientes.ClientesCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->input('nombre');
        $telefono  = $request->input('telefono');
        $user = Cliente::find($telefono);
        if($user){
            return redirect()->back()->with('notificacion_cross','Error, el numero de telefono ya esta registrado');;;
        }
        else{

            $cliente = new Cliente();
            $cliente->telefono = $request->input('telefono');
            $cliente->apellidos = $request->input('apellido');
            $cliente->nombres = $request->input('nombre');
            $cliente->direccion = $request->input('direccion');
            $cliente->balon_prestado = $request->input('balon_prestado');
            $cliente->deuda = $request->input('deuda');
            $cliente->frecuencia = 0;
            $cliente->latitud = $request->input('latitud');
            $cliente->longitud = $request->input('longitud');
            $cliente->save();
        }
        return redirect()->back()->with('notificacion','Se Registro un cliente correctamente');;;
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //return 'pvto'.$cliente->telefono;
       return view('Clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('Clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->fill($request->all());
        $cliente->save();
        $clientes = Cliente::all();
        return view('Clientes.index', compact('clientes'))->with('notificacion','Se Registro un cliente correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

}
