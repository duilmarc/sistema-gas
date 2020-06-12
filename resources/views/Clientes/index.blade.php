@extends('layouts.dashboard')

@section('titulo','Clientes');

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Clientes</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Registrar Cliente</h6>
	    </div>
		<table class="table table-dark">
			<thead>
				   <tr>
				      <th scope="col">Telefono</th>
				      <th scope="col">Nombres</th>
				      <th scope="col">Apellido</th>
				      <th scope="col">Direccion</th>
				      <th scope="col">Latitud</th>
				      <th scope="col">Longitud</th>
				   </tr>
			</thead>
		</table>
			<form method="POST" action="/clientes">
				@csrf
			  <div class="form-row align-items-center">
			  	<div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Telefono</label>
			      <div class="input-group mb-2">
			        <input type="text" name="telefono" class="form-control" id="inlineFormInputGroup" placeholder="Telefono">
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInput">Nombre</label>
			      <input type="text" name="nombre" class="form-control mb-2" id="inlineFormInput" placeholder="Nombre">
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Apellido</label>
			      <div class="input-group mb-2">
			        <input type="text" name="apellido" class="form-control" id="inlineFormInputGroup" placeholder="Apellido">
			      </div>
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Direccion</label>
			      <div class="input-group mb-2">
			        <input type="text" name="direccion" class="form-control" id="inlineFormInputGroup" placeholder="Direccion">
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Latitud</label>
			      <div class="input-group mb-2">
			        <input type="text" name="latitud" class="form-control" id="inlineFormInputGroup" placeholder="Latitud">
			      </div>
			    </div>

			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Longitud</label>
			      <div class="input-group mb-2">
			        <input type="text" name="longitud" class="form-control" id="inlineFormInputGroup" placeholder="Longitud">
			      </div>
			    </div>

			    <div class="col-auto">
			      <button type="submit" class="btn btn-primary mb-2">Registrar</button>
			    </div>		    
			  </div>
			</form>
		</div>

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
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th>Ver mas...</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($clientes as $cliente)     
							      <td>{{$cliente->telefono}}</td>
							      <td>{{$cliente->nombres}}</td>
							      <td>{{$cliente->apellidos}}</td>
							      <td>{{$cliente->direccion}}</td>
							      <td>{{$cliente->latitud}}</td>
							      <td>{{$cliente->longitud}}</td>
                                <td><center>
                                    <a class="btn btn-info" href="/clientes/{{$cliente->telefono}}" aria-label="Settings">
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
</div>


@endsection


@section('footers')

  <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js')}}"></script>

@endsection