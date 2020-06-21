<?php

namespace App\Http\Controllers;

use App\Almacen;
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
    public function index()
    {
        $almacenes = Almacen::all();
        return view('Almacen.index', compact('almacenes'));
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
        $almacen = new Almacen();
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $almacen->almacen = $request->input('almacen');
        $almacen->balon_lleno_normal = $request->input('balon_lleno_normal');
        $almacen->balon_lleno_premiun = $request->input('balon_lleno_premiun');
        $almacen->balon_vacio_normal = $request->input('balon_vacio_normal');
        $almacen->balon_vacio_premiun = $request->input('balon_vacio_premiun');
        $almacen->fecha = $mytime;
        $almacen->save();

        return redirect()->back();
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
        /*
        $almacen->fill($request->all());
        $almacen->save();
        $almacenes = Almacen::all();
        return view('Almacen.index', compact('almacenes'))->with('notificacion','Se Registro un cliente correctamente');;;
        */
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
}
