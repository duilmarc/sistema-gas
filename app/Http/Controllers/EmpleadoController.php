<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;
use App\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
class EmpleadoController extends Controller
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
        $ventas = Venta::where('repartidor','=',$id)->where('fecha','=',$mytime)->where('estado','=','realizado')
        ->get();
        $total = collect($ventas)->sum('total');
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
    public function generar_asistencia()
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();

        $repartidores = Empleado::all();
        $asistencia = DB::table('asistencia')->where('fecha','=',$mytime)->get();
        if(sizeof($asistencia)>0)
            return 1;
        else
        {
            foreach ($repartidores as $repartidor) {
                DB::table('asistencia')->insert([
                        "id" => $repartidor->id,
                        "fecha" => $mytime,
                        "condicion" => 'no registrada'
                ]);
            }
            return 0;
        }
        
    }
    public function asistencia()
    {
        $valor = $this->generar_asistencia();
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $asistencias = DB::table('asistencia')
            ->join('empleados', 'empleados.id', '=', 'asistencia.id')
            ->select('asistencia.*', 'empleados.nombre')
            ->where('asistencia.fecha','=',$mytime)
            ->get();
        $repartidores = DB::table('asistencia')
        ->join('empleados', 'empleados.id', '=', 'asistencia.id')
        ->select('asistencia.*', 'empleados.nombre')
        ->where('asistencia.fecha','=',$mytime)
        ->where('asistencia.condicion','=','no registrada')
        ->get();
        return view('Empleado.asistencia',compact('repartidores','asistencias'));
    }

    public function marcar_asistencia($id)
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        DB::table('asistencia')
              ->where('id', $id)->where('fecha',$mytime)
              ->update(['condicion' => 'asistio']);
        return redirect()->back()->with('notificacion','Se Registro la asistencia correctamente');
    }

    public function generar_cartera()
    {
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();

        $repartidores = Empleado::all();
        $carteras = DB::table('cartera')->where('fecha','=',$mytime)->get();
        if(sizeof($carteras)>0)
            return 1;
        else
        {
            foreach ($repartidores as $repartidor) {
                DB::table('cartera')->insert([
                        "id" => $repartidor->id,
                        "fecha" => $mytime,
                        "monto" => 0
                ]);
            }
            return 0;
        }
        
    }
    public function cartera()
    {
        $valor = $this->generar_cartera();
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $carteras = DB::table('cartera')
            ->join('empleados', 'empleados.id', '=', 'cartera.id')
            ->select('cartera.*', 'empleados.nombre')
            ->where('cartera.fecha','=',$mytime)
            ->get();
         $descripciones = DB::table('descripcion_cartera')
            ->join('empleados', 'empleados.id', '=', 'descripcion_cartera.id')
            ->select('descripcion_cartera.*', 'empleados.nombre')
            ->where('descripcion_cartera.fecha','=',$mytime)
            ->get();
        $repartidores = Empleado::all();
      
        return view('Empleado.cartera',compact('repartidores','carteras','descripciones'));
    }

    public function descripcion_cartera()
    {
        $fecha = Carbon::today();
        $fecha = $fecha->toDateString();
        $monto =  Input::get('monto',false);
        $id =  Input::get('id',false);
        $descripcion =  Input::get('descripcion',false);
       
        $query = DB::table('cartera')->where('fecha','=',$fecha)->where('id','=',$id);

        if(sizeof($query->get())==0)
        {
            DB::insert('insert into cartera (id, fecha,monto) values (?, ?, ?)', [$id, $fecha,$monto]);
        }
        else{
            $query->increment('monto',$monto);
        }
        DB::insert('insert into descripcion_cartera (id, monto,motivo,fecha) values (?, ?, ?,?)', [$id, $monto,$descripcion,$fecha]);
        return redirect()->back()->with('notificacion','Se Registro el monto correctamente');    
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
