@extends('layouts.dashboard')
@section('titulo')
<title>Sistema- Asistencia</title>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
      @if(session('notificacion')))
      <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Notificacion!</h4>
          {{session('notificacion')}}
        </div>
      </div>
      @endif
      <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header text-dark">
                      <h4> Lista asistencia </h4> 
                      Dia: @php echo Carbon\Carbon::today()->toFormattedDateString() @endphp
                </div>
                @if (sizeof($asistencias)>0)
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover text-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead >
                        <tr>
                            <th>Nombre</th>
                            <th><center>Condicion</center></th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($asistencias as $asistencia)

                                <td> {{ $asistencia->nombre  }} </td>
                                <td> {{ strtoupper($asistencia->condicion)  }} </td>
                            </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        @else
        <div class="card-body">
          Aun no se ha registrado la asistencia de Nadie
            </div>
        </div>
      </div>
        @endif

        <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="card">
                <div class="card-header text-dark">
                      <h4> Repartidores </h4> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover text-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead >
                        <tr>
                            <th>Nombre</th>
                            <th><center>Marcar Asistencia</center></th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($repartidores as $repartidor)
  
                                <td> {{ $repartidor->nombre  }} </td>
                                <td> <center>
                                    <a class="btn btn-success" href="{{ url('/repartidores/asistencia/'.$repartidor->id) }}" aria-label="Settings">
                                        <i class="fa fa-check"></i>
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

    </div>
</div>
@endsection
