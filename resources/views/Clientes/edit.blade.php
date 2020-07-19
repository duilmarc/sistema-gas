@extends('layouts.dashboard')
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
				      <th scope="col-auto">Telefono</th>
				      <th scope="col-auto">Nombres</th>
				      <th scope="col-auto">Apellido</th>
				      <th scope="col-auto">Direccion</th>
				      <th scope="col-auto">Balon prestado</th>
				      <th scope="col-auto">Deuda</th>
				   </tr>
			</thead>
		</table>
		@if(session('notificacion'))
		        <div class="col-lg-12">
		          <div class="alert alert-success alert-dismissible">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            <h4><i class="icon fa fa-check"></i> Aviso!</h4>
		            {{session('notificacion')}}
		          </div>
		        </div>
		        @endif
		        @if(session('notificacion_cross'))
		        <div class="col-lg-12">
		          <div class="alert alert-danger alert-dismissible">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            <h4><i class="icon fa fa-times"></i> Aviso!</h4>
		            {{session('notificacion_cross')}}
		          </div>
		        </div>
        @endif
			<form method="POST" action="/clientes/{{$cliente->telefono}}" >
				@method('PUT')
				@csrf
			  <div class="form-row align-items-center">
			  	<div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Telefono</label>
			      <div class="input-group mb-2">
			        <input type="number" name="telefono" class="form-control" id="inlineFormInputGroup" placeholder="telefono" value="{{$cliente->telefono}}" required>
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInput">Nombre</label>
			      <input type="text" name="nombres" class="form-control mb-2" id="inlineFormInput" placeholder="nombre" value="{{$cliente->nombres}}">
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Apellido</label>
			      <div class="input-group mb-2">
			        <input type="text" name="apellidos" class="form-control" id="inlineFormInputGroup" placeholder="apellidos" value="{{$cliente->apellidos}}">
			      </div>
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Direccion</label>
			      <div class="input-group mb-2">
			        <input type="text" name="direccion" class="form-control" id="inlineFormInputGroup" placeholder="direccion" value="{{$cliente->direccion}}">
			      </div>
			    </div>
            <div class="col-auto">
              <label class="sr-only" for="inlineFormInputGroup">Balon prestado</label>
              <div class="input-group mb-2">
                <input type="text" name="balon_prestado" class="form-control" id="inlineFormInputGroup" placeholder="balon_prestado" value="{{$cliente->balon_prestado}}">
              </div>
          </div>
          <div class="col-auto">
              <label class="sr-only" for="inlineFormInputGroup">Deuda</label>
              <div class="input-group mb-2">
                <input type="number" step='0.01' name="deuda" class="form-control" id="inlineFormInputGroup" placeholder="deuda" value="{{$cliente->deuda}}">
              </div>
          </div>
      <div class="col-auto">
          <label class="sr-only" for="inlineFormInputGroup">Coment</label>
          <div class="input-group mb-2">
            <input type="text"  name="comentarios" class="form-control" id="inlineFormInputGroup" value="{{$cliente->comentarios}}" placeholder="Comentarios">
          </div>
      </div>

			    <div class="col-auto">
			      <button type="submit" class="btn btn-primary mb-2">Editar</button>
			    </div>		    
			  </div>
			</form>
		</div>


@endsection


