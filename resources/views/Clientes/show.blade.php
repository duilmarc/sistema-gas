@extends('layouts.dashboard')
@section('titulo')
<title>Sistema- Inicio</title>
@endsection
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Clientes</h1>
	<p class="mb-4"></p>
		<div class="col-lg-12">
            <div class="card shadow mb-4  border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Visualizar Clientes</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" bg="red" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                            <th>Telefono Contacto</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Ver mas...</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                            
							      <td>{{$cliente->telefono}}</td>
							      <td>{{$cliente->nombres}}</td>
							      <td>{{$cliente->apellidos}}</td>
							      <td>{{$cliente->direccion}}</td>
                                <td><center>
                                    <a class="btn btn-info" href="/clientes/{{$cliente->telefono}}" aria-label="Settings">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    </center>
                                </td>
                            </tr>
                       
                        
                      </tbody>
                    </table>
                  </div>
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