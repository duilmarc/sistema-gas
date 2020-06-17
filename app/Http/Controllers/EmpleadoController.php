<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::all();
        return view('Empleado.index', compact('empleados'));
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
        $telefono  = $request->input('telefono');
        $user = Empleado::find($telefono);
        if($user){
            return redirect()->back()->with('notificacion_cross','Error, el numero de telefono ya esta registrado');;;
        }
        else{
            $empleado = new Empleado();
            $empleado->id = $request->input('telefono');
            $empleado->telefono = $request->input('telefono');
            $empleado->nombre = $request->input('nombres');
            $empleado->direccion = $request->input('direccion');
            $empleado->salario = $request->input('salario');
            $empleado->save();
        }
        return redirect()->back()->with('notificacion','Se Registro un cliente correctamente');;;
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {

        return view('Empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $empleado->fill($request->all());
        $empleado->save();
        $empleados = Empleado::all();
        return view('Empleado.index', compact('empleados'))->with('notificacion','Se Registro un repartidor correctamente');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
