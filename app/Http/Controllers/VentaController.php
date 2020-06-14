<?php

namespace App\Http\Controllers;

use App\Venta;
use App\Cliente;
use App\Empleado;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $empleados = Empleado::all();
        $ventas= DB::table('ventas')
            ->leftJoin('empleados', 'empleados.id', '=', 'ventas.repartidor')   
            #->where('ventas.fecha','=',$mytime)
            ->where([
                ['ventas.estado', '=', 'pendiente'],
            ])
            ->orWhere([
                ['ventas.estado', '=', 'asignado'],
            ])
            ->select('ventas.id','ventas.telefono', 'ventas.direccion', 'empleados.nombre','ventas.balon','ventas.precio','ventas.referencia','ventas.estado')
            ->get();
        return view('ventas.index',compact('ventas','empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $telefono  = $request->input('telefono');
        $user = Cliente::find($telefono);
        if($user){
            $venta = new Venta();
            $venta->telefono = $telefono;
            $venta->direccion = $request->direccion;
            $venta->balon = $request->balon;
            $venta->precio = $request->precio;
            if($request->referencia){
                $venta->referencia = $request->referencia;
            }
            $venta->estado = 'pendiente';
            $venta->fecha = $mytime;
            $venta->save();
        }
        else
        {
            $cliente = new Cliente();
            $cliente->telefono = $request->input('telefono');
            $cliente->direccion = $request->input('direccion');
            $cliente->save();
            $venta = new Venta();
            $venta->telefono = $telefono;
            $venta->direccion = $request->direccion;
            $venta->balon = $request->balon;
            $venta->precio = $request->precio;
            if($request->referencia){
                $venta->referencia = $request->referencia;
            }
            $venta->estado = 'pendiente';
            $venta->fecha = $mytime;
            $venta->save();


        }
        return redirect()->back()->with('notificacion','Se Registro la compra correctamente');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
    
    public function realizado(Request $requesta)
    {
        $venta = Venta::find($requesta->id);
        $venta->estado = 'realizado';
        $venta->push();
        return back()->with('notificacion',' Guardado correctamente!');

    }

        
    public function cancelado(Request $requesta)
    {
        $venta = Venta::find($requesta->id);
        $venta->estado = 'cancelado';
        $venta->push();
        return back()->with('notificacion',' Cancelado!');
       
    }

    public function asignar_repartidor($id_venta,$id_repartidor){
        $venta = venta::find($id_venta);
        $venta->repartidor = $id_repartidor;
        $venta->estado = 'asignado';
        $venta->push();
        return back()->with('notificacion','Se cambio/asigno el repartidor Correctamente!');       
    }
    public function show_accept()
    {
        $ventas= DB::table('ventas')
            ->leftJoin('empleados', 'empleados.id', '=', 'ventas.repartidor')   
            #->where('ventas.fecha','=',$mytime)
            ->where([
                ['ventas.estado', '=', 'realizado'],
            ])
            ->select('ventas.id','ventas.telefono', 'ventas.direccion', 'empleados.nombre','ventas.balon','ventas.precio','ventas.referencia','ventas.estado')
            ->get();
        return view('ventas.realizadas',compact('ventas'));
    }

    public function show_cancel()
    {
        $ventas= DB::table('ventas')
        ->leftJoin('empleados', 'empleados.id', '=', 'ventas.repartidor')   
        #->where('ventas.fecha','=',$mytime)
        ->where([
            ['ventas.estado', '=', 'cancelado'],
        ])
        ->select('ventas.id','ventas.telefono', 'ventas.direccion', 'empleados.nombre','ventas.balon','ventas.precio','ventas.referencia','ventas.estado')
        ->get();
        return view('ventas.cancelados',compact('ventas'));
    }
}
