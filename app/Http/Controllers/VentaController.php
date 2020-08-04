<?php

namespace App\Http\Controllers;

use App\Venta;
use App\Cliente;
use App\Empleado;
use App\Almacen;
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
        public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($user= null)
    {
        $telefono = null;
        if(is_string($user))
        {
            $telefono = $user;
            $user=null;
        }
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
            ->select('ventas.*', 'empleados.nombre' )
            ->orderBy('ventas.updated_at','desc')
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
            return view('ventas.index',compact('ventas','empleados','almacen','alerta','user','telefono'));
        }
        else
            $alerta  = "";
            return view('ventas.index',compact('ventas','empleados','almacen','alerta','user','telefono'));
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
        $comision = $this->show_comision_por_balon();
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $telefono  = $request->input('telefono');
        $user = Cliente::find($telefono);
        if( $user  == null){
            $cliente = new Cliente();
            $cliente->telefono = $request->input('telefono');
            $cliente->direccion = $request->input('direccion');
            $cliente->frecuencia = 0;
            $cliente->save();
        }
        $venta = new Venta();
        $venta->telefono = $telefono;
        $venta->direccion = $request->direccion;
        $venta->balon = $request->balon;
        $venta->maps = $request->input('maps');
        $venta->precio = $request->input('precio');
        if($request->referencia){
            $venta->referencia = $request->referencia;
        }
        $venta->cantidad = $request->input('cantidad');
        $venta->total = $venta->cantidad * $venta->precio;
        $venta->ganancia = $venta->total - $comision*$venta->cantidad;
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
        
        DB::beginTransaction();
        try {
            // aumento de frencuencia de cliente
            $query = DB::table('clientes')
            ->where('telefono','=',$venta->telefono); 
            $query->increment('frecuencia');

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
            DB::commit();
            return back()->with('notificacion',' Guardado correctamente!');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('alerta',' No se registro correctamente, intentelo nuevamente!');
            // something went wrong
        }


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
        $ganancia = DB::table("ventas")->where('ventas.fecha','=',$mytime)
        ->where([
            ['ventas.estado', '=', 'realizado'],
        ])->get()->sum("ganancia");
        $ventas= DB::table('ventas')
            ->leftJoin('empleados', 'empleados.id', '=', 'ventas.repartidor')   
            ->where('ventas.fecha','=',$mytime)
            ->where([
                ['ventas.estado', '=', 'realizado'],
            ])
            ->orderBy('ventas.updated_at','desc')
            ->select('ventas.*','empleados.nombre')
            ->get();
        return view('ventas.realizadas',compact('ventas','total','ganancia'));
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
        ->select('ventas.*','empleados.nombre')
        ->orderBy('ventas.updated_at','desc')
        ->get();
        return view('ventas.cancelados',compact('ventas'));
    }

    public function buscar_cliente(Request $requesta){
        $telefono  = $requesta->input('telefono');
        $user = Cliente::find($telefono);
        if( $user  == null)
            return $this->index($telefono);
        else
            return $this->index($user);
    }

    public function show_comision_por_balon()
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();

        $almacen = Almacen::where('fecha','=',$mytime)->select('precioxbalon')->get();
          
        if(sizeof($almacen)>0){
            $precio_compra = $almacen[0]->precioxbalon;
            return $precio_compra;
        }
        return 0;

    }


}
    