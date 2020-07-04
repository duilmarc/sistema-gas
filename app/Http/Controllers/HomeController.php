<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Empleado;
use App\Almacen;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $mytime = Carbon::today();
        $mytime = $mytime->toDateString();
        $almacen = Almacen::where('fecha','=',$mytime)
        ->first();
        $total_dia = DB::table("ventas")->where('ventas.fecha','=',$mytime)
        ->where([
            ['ventas.estado', '=', 'realizado'],
        ])->get()->sum("ganancia");
        $faltantes= DB::table('ventas')
        ->leftJoin('empleados', 'empleados.id', '=', 'ventas.repartidor')   
        ->where([
            ['ventas.estado', '=', 'pendiente'],
            ['ventas.fecha','=',$mytime],
        ])
        ->orWhere([
            ['ventas.estado', '=', 'asignado'],
            ['ventas.fecha','=',$mytime]
        ])->count();
        $total_repartidores = Empleado::count();
        return view('home',compact('total_dia','total_repartidores','faltantes','almacen'));
    }
}
