@extends('layouts.dashboard')

@section('css_require')

    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('titulo')
<title>Servicios</title>
@endsection
@section('content')
<div class="container-fluid">
    <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{sizeof($servicios_general)}}
          </h3>

          <p>Servicios Registrados</p>
        </div>
        <div class="icon">
          <i class="ion ion-medkit"></i>
        </div>
        <a href="{{url('admin/servicios/create')}}" class="small-box-footer">
          Crear Servicio <i class="fa fa-plus-circle"></i>
        </a>
      </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Servicios General</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm table-bordered" bg="red" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Tipo_servicio</th>
                    <th>Area</th>
                    <th>Encargado</th>
                    <th>Ver Mas</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Tipo_servicio</th>
                    <th>Area</th>
                    <th>Encargado</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($servicios_general as $service)
                   @if ($service->estado == 'pendiente')
                    <tr class="table-warning">    
                    @else
                    <tr>
                    @endif
                 
                     <td> {{ $service->nombre  }} </td>
                     <td> {{ $service->hora_inico  }} </td>
                     <td> {{ $service->estado  }} </td>
                     <td> {{ $service->tipo_servicio  }} </td>
                     <td> {{ $service->area  }} </td>
                     @if ($service->encargado)
                        <td> {{ $service->encargado  }} </td>      
                     @else
                        <td> Sin encargado </td>   
                     @endif
                     <td><center>
                        <a class="btn btn-info" href="{{ url('/servicios/'.$service->id) }}" aria-label="Settings">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        </center>
                     </td>
                 </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>

@endsection

@section('footers')

  <!-- Page level plugins -->
  <script src="{{ asset('css/fuentes/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('css/fuentes/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('css/fuentes/demo/datatables-demo.js')}}"></script>

@endsection