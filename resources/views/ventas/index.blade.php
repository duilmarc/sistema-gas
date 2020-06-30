@extends('layouts.dashboard')
@section('titulo')
<title>Sistema- Inicio</title>
@endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Ventas - Fecha:  @php echo Carbon\Carbon::today()->toFormattedDateString() @endphp</h1>
    <p class="mb-4"></p>

    <!-- Content Row -->
    <div class="row">
      @if($alerta)
      <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissible">
          <h4><i class="icon fa fa-exclamation-triangle"></i> Aviso!</h4>
          {{$alerta}}
        </div>
      </div>
      @endif
        <!-- Border Left Utilities -->
      <div class="col-lg-8">
        <div class="card shadow mb-4  border-left-primary">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Registrar venta</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="/ventas">
                    @csrf
                  <div class="form-row align-items-center">
                      <div class="col-auto col-sm-4">
                      <label class="sr-only" for="inlineFormInputGroup">Telefono</label>
                      <div class="input-group mb-2">
                        <input type="text" name="telefono" class="form-control" id="inlineFormInputGroup" placeholder="Telefono">
                      </div>
                    </div>
            
                    <div class="col-8 col-sm-6">
                      <label class="sr-only" for="inlineFormInput">Direccion</label>
                      <input type="text" name="direccion" class="form-control mb-2" id="inlineFormInput" placeholder="Dirección">
                    </div>
                    <div class="col-auto">
                      <label class="sr-only" for="inlineFormInputGroup">Tipo balon</label>
                        <div class="input-group mb-2">
                          <select class="form-control" name="balon" id="exampleFormControlSelect1">
                            <option value="normal">normal</option>
                            <option value="premium">premium</option>
                            <option value="vacio_normal">vacio normal</option>
                            <option value="vacio_premium">vacio premium</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <label class="sr-only" for="inlineFormInputGroup">precio</label>
                      <div class="input-group mb-2">
                        <input type="number" name="precio" class="form-control" id="inlineFormInputGroup" placeholder="Precio">
                      </div>
                    </div>
            
                    <div class="col-12">
                      <label class="sr-only" for="inlineFormInputGroup">Referencia</label>
                      <div class="input-group mb-2">
                        <input type="text" name="referencia" class="form-control" id="inlineFormInputGroup" placeholder="Referencia">
                      </div>
                    </div>
            
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        </div>
        <div class="col-lg-4">
          <div class="row">
            <div class="col-xl-6 col-md-6 mb-6">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-l font-weight-bold text-info text-uppercase mb-1">Balones Normales Restantes</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $almacen[0]->balon_lleno_normal }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-6">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-l font-weight-bold text-info text-uppercase mb-1">Balones Premium Restantes</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $almacen[0]->balon_lleno_premiun }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-xl-6 col-md-6 mb-6">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-l font-weight-bold text-info text-uppercase mb-1">Comision promedio por balon</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">{{$comision}}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @if(session('notificacion')))
        <div class="col-lg-12">
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Aviso!</h4>
            {{session('notificacion')}}
          </div>
        </div>
        @endif
        <div class="col-lg-12">
            <div class="card shadow mb-4  border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ventas en Proceso</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead >
                        <tr>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Balon</th>
                            <th>Precio</th>
                            <th>Referencia</th>
                            <th>Repartidor</th>
                            <th>Realizado</th>
                            <th>Cancelado</th>
                            <th>Estado</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($ventas as $venta)
  
                                <td> {{ $venta->telefono  }} </td>
                                <td> {{ $venta->direccion  }} </td>
                                <td> {{ $venta->balon  }} </td>
                                <td> {{ $venta->precio  }} </td>
                                <td> {{ $venta->referencia  }} </td>
                                @if ($venta->nombre)
                                <td>
                                  <div class="dropdown mb-4">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      {{$venta->nombre}}
                                    </button>
                                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                      @foreach ($empleados as $empleado)
                                      <a class="dropdown-item" href="/ventas/asignar/{{ $venta->id }}/{{ $empleado->id }}"> {{ $empleado->nombre }}</a>
                                      @endforeach
                                    </div>
                                  </div>   
                                </td>  
                                    <td>
                                      <a class="btn btn-success" href="{{ url('/ventas/a/'.$venta->id) }}" aria-label="Settings">
                                          Entregado
                                      </a>
                                    </td>
                                @else 
                                <td>
                                  <div class="dropdown mb-4">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Seleccionar Repartidor
                                    </button>
                                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                      @foreach ($empleados as $empleado)
                                        <a class="dropdown-item" href="/ventas/asignar/{{ $venta->id }}/{{ $empleado->id }}"> {{ $empleado->nombre }}</a>
                                      
                                      @endforeach
                                    </div>
                                  </div>   
                                </td>  
                                  <td><center>
                                    <button type="submit" class="btn disabled btn-success mb-2">Entregado</button>
                                    </center>
                                  </td>
                                </form>
                                @endif
                                <td>
                                  <a class="btn btn-danger" href="{{ url('/ventas/c/'.$venta->id) }}" aria-label="Settings">
                                    Cancelar
                                </a>
                                </td>
                                
                                <td>{{ $venta->estado }}</td>
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
    <!-- /.container-fluid -->
  
@endsection
@section('footers')

  <!-- Page level plugins -->
  <script src="{{ asset('css/fuentes/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('css/fuentes/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js')}}"></script>

@endsection