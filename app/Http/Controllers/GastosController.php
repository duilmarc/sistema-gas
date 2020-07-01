<?php

namespace App\Http\Controllers;

use App\Gastos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GastosController extends Controller
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
        $gastos = Gastos::all()->sortByDesc('fecha');
        return view('Gastos.index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $gasto = new Gastos();
            $gasto->tipo_gasto = $request->input('tipo_gasto');
            $gasto->monto = $request->input('monto');
            $gasto->fecha = $mytime;
            $gasto->descripcion = $request->input('descripcion');
            $gasto->save();

        return redirect()->back()->with('notificacion','Se Registro un gasto correctamente');;;
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function show(Gastos $gastos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function edit(Gastos $gastos)
    {
        //return view('Gastos.edit', compact('gastos'));
        //return $gastos->monto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gastos $gastos)
    {
        $gasto->fill($request->all());
        $gasto->save();
        $gastos = Gastos::all();
        return view('Gastos.index', compact('gastos'))->with('notificacion','Se Registro un gasto correctamente');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gastos $gastos)
    {
        //
    }

    
    
}
