@extends('layouts.dashboard')
@section('titulo')
<title>Sistema- Inicio</title>
@endsection
@section('content')
<div class="container">
    @if($notificacion)
        {{ $notificacion}}
    @else
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="d-none d-sm-inline-block "><b>Repartidor:</b> {{ $repartidor->nombre }} <br>Total del dia:  S/{{ $total }}.00</h4>
        <a href="#" class="d-none d-sm-inline-block "><i class="fas fa-download fa-sm text-white-50"></i> Fecha:  @php echo Carbon\Carbon::today()->toFormattedDateString() @endphp</h1></a>
      </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                   <h6 class="m-0 font-weight-bold text-dark">Ventas Registradas</h6>
                </div>
              
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Direccion</th>
                            <th scope="col">Balon</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Precio</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($ventas as $venta)
                            
                            <td> {{ $venta->direccion  }} </td>
                            <td> {{ $venta->balon  }} </td>
                            <td> {{ $venta->telefono  }} </td>
                            <td> S/.{{ $venta->precio  }} </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>

    </div>
    @endif
   
    
</div>

@endsection
