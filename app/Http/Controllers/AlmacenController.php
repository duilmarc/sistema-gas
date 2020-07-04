<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $clientes = Cliente::where('balon_prestado','>=','1')->select('balon_prestado')->get();
        $total = 0;
        foreach ($clientes as $cliente) {
            $total += $cliente->balon_prestado;
        }
        $almacenes = Almacen::all()->sortByDesc('fecha');
        return view('Almacen.index', compact('almacenes','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Almacen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $almacenes = Almacen::find($request->input('almacen'));
        if($almacenes == null){ //Si no hay almacenes creados
            $almacen = new Almacen();
            $almacen->almacen = $request->input('almacen');
            $almacen->balon_lleno_normal = $request->input('balon_lleno_normal');
            $almacen->balon_lleno_premiun = $request->input('balon_lleno_premiun');
            $almacen->balon_vacio_normal = $request->input('balon_vacio_normal');
            $almacen->balon_vacio_premiun = $request->input('balon_vacio_premiun');
            $almacen->precioxbalon = $request->input('precioxbalon');
            $almacen->balones_prestados = $request->input('balones_prestados');
            $almacen->fecha = $mytime;
            $almacen->save();
        }
        else
        {
            $this->update($request, $almacenes);
        }
        return redirect()->back()->with('notificacion','Se Registro el almacen correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {
        return view('Almacen.show', compact('almacen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(Almacen $almacen)
    {
        return "hola";
        //return view('Almacen.edit', compact('almacen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Almacen $almacen)
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $almacen->fill($request->all());
        $almacen->fecha = $mytime;
        $almacen->save();
        $almacenes = Almacen::all();
        return view('Almacen.index', compact('almacenes'))->with('notificacion','Se Registro un cliente correctamente');;;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almacen $almacen)
    {
        //
    }

    public function balones_prestados(Almacen $almacen)
    {
        $clientes = Cliente::where('balones_prestados','=','si')->select('nombre')->get();
        return $clientes;
    }


}
