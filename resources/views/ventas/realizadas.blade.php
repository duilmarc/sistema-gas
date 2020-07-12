@extends('layouts.dashboard')
@section('titulo')
<title>Realizados</title>
@endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Ventas Realizadas- Fecha:  @php echo Carbon\Carbon::today()->toFormattedDateString() @endphp</h1>
    <h3 class="h3 mb-1 text-gray-800">Total Ganancia en ventas Bruta del dia : S/{{ $total }}</h3>
    <h3 class="h3 mb-1 text-gray-800">Total Ganancia en ventas Neta del dia : S/{{ $ganancia }}</h3>
    <p class="mb-4"></p>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4  border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabla de Ventas Realizadas</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-info text-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead >
                        <tr>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Balon</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Ganancia</th>
                            <th>Total</th>
                            <th>Referencia</th>
                            <th>Repartidor</th>
                            <th>Hora de solicitud</th>
                            <th>Hora exacta entrega</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($ventas as $venta)
  
                                <td> {{ $venta->telefono  }} </td>
                                <td> {{ $venta->direccion  }} </td>
                                <td> {{ $venta->balon  }} </td>
                                <td> {{ $venta->precio  }} </td>
                                <td> {{ $venta->cantidad  }} </td>
                                <td> {{ $venta->ganancia }}</td>
                                <td> {{ $venta->total  }} </td>
                                <td> {{ $venta->referencia  }} </td>
                                <td> {{ $venta->nombre  }}</td>
                                <th>{{ $venta->created_at }}</th>
                                <td>{{ $venta->updated_at }}</td>
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