@extends('layouts.app')

@section('titulo','Clientes Create');

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Clientes</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Editar Cliente</h6>
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
			<form method="POST" action="/clientes/{{$cliente->telefono}}" >
				@method('PUT')
				@csrf
			  <div class="form-row align-items-center">
			  	<div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Telefono</label>
			      <div class="input-group mb-2">
			        <input type="text" name="telefono" class="form-control" id="inlineFormInputGroup" value="{{$cliente->telefono}}">
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInput">Nombre</label>
			      <input type="text" name="nombre" class="form-control mb-2" id="inlineFormInput" value="{{$cliente->nombres}}">
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Apellido</label>
			      <div class="input-group mb-2">
			        <input type="text" name="apellido" class="form-control" id="inlineFormInputGroup" value="{{$cliente->apellidos}}">
			      </div>
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Direccion</label>
			      <div class="input-group mb-2">
			        <input type="text" name="direccion" class="form-control" id="inlineFormInputGroup" value="{{$cliente->direccion}}">
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Latitud</label>
			      <div class="input-group mb-2">
			        <input type="text" name="latitud" class="form-control" id="inlineFormInputGroup" value="{{$cliente->latitud}}">
			      </div>
			    </div>

			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Longitud</label>
			      <div class="input-group mb-2">
			        <input type="text" name="longitud" class="form-control" id="inlineFormInputGroup" value="{{$cliente->longitud}}">
			      </div>
			    </div>

			    <div class="col-auto">
			      <button type="submit" class="btn btn-primary mb-2">Registrar</button>
			    </div>		    
			  </div>
			</form>
		</div>


@endsection


