@extends('layouts.dashboard')
@section('titulo')
<title>Sistema- Inicio</title>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-dark">

                      <h4> Lista de Repartidores</h4>
                      Seleccione el repartidor que desea ver sus ventas realizadas
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover text-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead >
                        <tr>
                            <th>Nombre</th>
                            <th>Ventas</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($repartidores as $repartidor)
  
                                <td> {{ $repartidor->nombre  }} </td>
                                <td> <a class="btn btn-success" href="{{ url('/ventas/ventas_realizadas/'.$repartidor->id) }}" aria-label="Settings">
                                  Ver
                              </a> </td>

                            </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
