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
      <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card  border-left-danger border-bottom-danger">
                <div class="card-header text-dark">
                      <h4> Cartera del Día </h4> 
                      Dia: @php echo Carbon\Carbon::today()->toFormattedDateString() @endphp
                      <br> Aqui se muestra la cartera del día de los distintos repartidores, actualizada con cada venta que se consigue realizar por repartidor
                </div>
                @if (sizeof($carteras)>0)
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover text-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead >
                        <tr>
                            <th>Nombre</th>
                            <th><center>Monto en cartera</center></th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      @foreach ($carteras as $cartera)

                                <td> {{ $cartera->nombre  }} </td>
                                <td> <center>S/.{{ $cartera->monto }}</center> </td>
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
          Aun no se ha registrado la cartera de nadie
            </div>
        </div>
      </div>
        @endif

        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card border-left-success border-bottom-success">
                <div class="card-header text-dark">
                      <h4> Repartidores </h4> 
                      Añade dinero a la cartera de los repartidores o quitar estableciendo en negativo los valores
                      ejemplo 24 : añade 24 soles a su cartera, -24 resta 24 soles a su cartera
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover text-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead >
                        <tr>
                            <th>Nombre</th>
                            <th><center>Añadir/Quitar Cantidad</center></th>
                            <th>Motivo</th>
                            <th>Registrar</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                                <form method="GET" action="/ventas/cartera">
                                    @method('GET')
                                    @csrf
                                <td> 
                                    <select  class="form-control" name="id" id="repartidor">
                                 @foreach ($repartidores as $repartidor)
                                    <option value="{{ $repartidor->id }}">{{ $repartidor->nombre  }}</option>
                                 @endforeach 
                                </select> 
                                </td>
                               
                                <td> <center>
                                    <input type="number" name="monto" class="form-control" id="inlineFormInputGroup" placeholder="monto" required>
                                </center>
                                </td>
                                <td>  <input type="text" name="descripcion" class="form-control" id="inlineFormInputGroup" placeholder="descripcion"> </td>
                                <td>  <button type="submit" class="btn btn-primary mb-2">Registrar</button></td>
                                </form>
                            </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <br>
        </div>
        <div class="col-lg-12 col-md-6 col-sm-8">
            <div class="card border-left-info border-bottom-info ">
                <div class="card-header text-dark">
                      <h4> Descripcion de las transacciones de la cartera </h4> 
                      Dia: @php echo Carbon\Carbon::today()->toFormattedDateString() @endphp <br>
                      Aqui se visualiza la extracción de dinero o si se añade mas dinero a la cartera del repartido que se van registrando durante el dia
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover text-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead >
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Monto</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($descripciones as $descripcion)
  
                                <td> {{ $descripcion->nombre  }} </td>
                                <td> {{ $descripcion->motivo }}</td>
                                <td> {{ $descripcion->monto }}</td>

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
