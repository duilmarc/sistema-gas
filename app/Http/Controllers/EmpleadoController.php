<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;
use App\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
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
        return redirect()->back()->with('notificacion','Se Registro un cliente correctamente');
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */

    public function ventas($id)
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $ventas = Venta::where('repartidor','=',$id)->where('fecha','=',$mytime)
        ->get();
        $total = collect($ventas)->sum('precio');
        $repartidor = Empleado::where('id','=',$id)->first();
        if(sizeof($ventas))
        {
            $notificacion = false;
            return view('ventas.ventas_realizadas',compact('ventas','total','repartidor','notificacion'));
        }
        else
        {   
            return view('ventas.error')->with('notificacion','El repartidor no ha realizado ninguna venta el dia de hoy');
        }
    }

    public function asistencia()
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $asistencias = DB::table('asistencia')
            ->join('empleados', 'empleados.id', '=', 'asistencia.id')
            ->select('asistencia.*', 'empleados.nombre')
            ->where('asistencia.fecha','=',$mytime)
            ->get();
        $repartidores = Empleado::all();
      
        return view('Empleado.asistencia',compact('repartidores','asistencias'));
    }

    public function marcar_asistencia($id)
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        DB::insert('insert into asistencia (id, fecha,condicion) values (?, ?, ?)', [$id, $mytime,'asistio']);
        return redirect()->back()->with('notificacion','Se Registro la asistencia correctamente');
    }
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
