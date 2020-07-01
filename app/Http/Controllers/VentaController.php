<?php

namespace App\Http\Controllers;

use App\Venta;
use App\Cliente;
use App\Empleado;
use App\Almacen;
use App\Gastos;
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
        $comision = $this->show_comision_por_balon();
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $empleados = Empleado::all();
        $ventas= DB::table('ventas')
            ->leftJoin('empleados', 'empleados.id', '=', 'ventas.repartidor')   
            ->where([
                ['ventas.estado', '=', 'pendiente'],
                ['ventas.fecha','=',$mytime],
            ])
            ->orWhere([
                ['ventas.estado', '=', 'asignado'],
                ['ventas.fecha','=',$mytime]
            ])
            ->select('ventas.id','ventas.total','ventas.cantidad','ventas.telefono', 'ventas.direccion', 'empleados.nombre','ventas.balon','ventas.precio','ventas.referencia','ventas.estado')
            ->get();
        $almacen = Almacen::where('fecha','=',$mytime)
        ->get();
        $almacen = json_encode($almacen);
        $almacen = json_decode($almacen);
        if(sizeof($almacen)== 0)
            return view('ventas.error')->with('notificacion','Debes registrar primero la cantidad de balones en tu almacen');
        if ($almacen[0]->balon_lleno_normal <= 20 or $almacen[0]->balon_lleno_premiun <= 10 )
        {
            $alerta = 'Queda pocon balones disponibles';
            return view('ventas.index',compact('ventas','empleados','almacen','comision','alerta'));
        }
        else
            $alerta  = "";
            return view('ventas.index',compact('ventas','empleados','almacen','comision','alerta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function repartidores()
    {
        $repartidores = Empleado::all();
        return view('ventas.repartidor',compact('repartidores'));
    }
    
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
        if( $user  == null){
            $cliente = new Cliente();
            $cliente->telefono = $request->input('telefono');
            $cliente->direccion = $request->input('direccion');
            $cliente->save();
        }
        $venta = new Venta();
        $venta->telefono = $telefono;
        $venta->direccion = $request->direccion;
        $venta->balon = $request->balon;
        $venta->precio = $request->input('precio');
        
        if($request->referencia){
            $venta->referencia = $request->referencia;
        }
        $venta->cantidad = $request->input('cantidad');
        $venta->total = $venta->cantidad * $venta->precio;
        $venta->estado = 'pendiente';
        $venta->fecha = $mytime;
        $venta->save();

        return redirect()->back()->with('notificacion','Se Registro la compra correctamente');
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
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        
        $venta = Venta::find($requesta->id);
        $tipo_balon = $venta->balon;
        $venta->estado = 'realizado';  
     
       
        $query = DB::table('almacenes')
        ->where('fecha','=',$mytime);                                     
      
        if($tipo_balon == 'normal')// venta balon normal
        {
            $query->increment('balon_vacio_normal',$venta->cantidad);
            $query->decrement('balon_lleno_normal',$venta->cantidad);
        }
        else if($tipo_balon == 'vacio_normal') //venta balon vacio normal
        {
            $query->decrement('balon_vacio_normal',$venta->cantidad);
        }
        else if($tipo_balon == 'vacio_premium') //venta balon vacio premium
        {
            $query->decrement('balon_vacio_premiun',$venta->cantidad);
        }
        else
        {
            $query->increment('balon_vacio_premiun',$venta->cantidad);//venta balon premium
            $query->decrement('balon_lleno_premiun',$venta->cantidad);
        }
        $venta->push();
        $query = DB::table('cartera')->where('fecha','=',$mytime)->where('id','=',$venta->repartidor);
        if(sizeof($query->get())==0)
        {
            DB::insert('insert into cartera (id, fecha,monto) values (?, ?, ?)', [$venta->repartidor, $mytime,$venta->total]);
        }
        else{
            $query->increment('monto',$venta->total);
        }
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
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $total = DB::table("ventas")->where('ventas.fecha','=',$mytime)
        ->where([
            ['ventas.estado', '=', 'realizado'],
        ])->get()->sum("total");
        $ventas= DB::table('ventas')
            ->leftJoin('empleados', 'empleados.id', '=', 'ventas.repartidor')   
            ->where('ventas.fecha','=',$mytime)
            ->where([
                ['ventas.estado', '=', 'realizado'],
            ])
            ->get();
        return view('ventas.realizadas',compact('ventas','total'));
    }

    public function show_cancel()
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $ventas= DB::table('ventas')
        ->leftJoin('empleados', 'empleados.id', '=', 'ventas.repartidor')   
        ->where('ventas.fecha','=',$mytime)
        ->where([
            ['ventas.estado', '=', 'cancelado'],
        ])
        ->get();
        return view('ventas.cancelados',compact('ventas'));
    }


    public function show_comision_por_balon()
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();

        $gasto_balon = Gastos::where('fecha','=',$mytime)->where('tipo_gasto','=','gas')->select('monto')->get();
        $almacen = Almacen::where('fecha','=',$mytime)->get();
        $venta = Venta::where('fecha','=',$mytime)->select('precio')->get();

        /////////////////////////////////////////////////////////////
        ///Control de error si no hay almacen o gastos registrados///
        /////////////////////////////////////////////////////////////
   
        if(sizeof($gasto_balon)>0 && sizeof($almacen)>0 && sizeof($venta)>0){
            $gasto_balon = json_encode($gasto_balon);
            $gasto_balon = json_decode($gasto_balon);

            $almacen = json_encode($almacen);
            $almacen = json_decode($almacen);
            $precioXbalon = $gasto_balon[0]->monto/ ($almacen[0]->balon_lleno_normal + $almacen[0]->balon_lleno_premiun);


            $gasto_balon = json_encode($gasto_balon);
            $gasto_balon = json_decode($gasto_balon);
            return ($venta[0]->precio - $precioXbalon);
        }
        return 0;

    }


}
    