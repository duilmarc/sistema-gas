<?php

namespace App\Http\Controllers;

use App\Moto;
use Illuminate\Http\Request;

class MotoController extends Controller
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
        $motos = Moto::all();
        return view('Moto.index', compact('motos'));
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
        $placa  = $request->input('placa');
        $user = Moto::find($placa);
        if($user){
            return redirect()->back()->with('notificacion_cross','Error, el numero de placa ya esta registrado');
        }
        else{
            $moto = new Moto();
            $moto->placa = $request->input('placa');
            $moto->color = $request->input('color');
            $moto->fecha = $request->input('fecha');
            $moto->descripcion = $request->input('descripcion');
            $moto->save();
        }
        return redirect()->back()->with('notificacion','Se Registro una moto correctamente');
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Moto  $moto
     * @return \Illuminate\Http\Response
     */
    public function show(Moto $moto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Moto  $moto
     * @return \Illuminate\Http\Response
     */
    public function edit(Moto $moto)
    {
        return view('Moto.edit', compact('moto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Moto  $moto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moto $moto)
    {
        $moto->fill($request->all());
        $moto->save();
        $motos = Moto::all();
        //return "bien";
        return view('Moto.index', compact('motos'))->with('notificacion','Se Registro un cliente correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Moto  $moto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moto $moto)
    {
        //
    }
}
