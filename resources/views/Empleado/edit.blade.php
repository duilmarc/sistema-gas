@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Repartidores</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Editar repartidor</h6>
	    </div>
		<table class="table table-dark">
			<thead>
				   <tr>
				      <th scope="col-auto">Telefono</th>
				      <th scope="col-auto">Nombres</th>
				      <th scope="col-auto">Salario</th>
				      <th scope="col-auto">Direccion</th>
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
			<form method="POST" action="/empleados/{{$empleado->telefono}}" >
				@method('PUT')
				@csrf
			  <div class="form-row align-items-center">
			  	<div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Telefono</label>
			      <div class="input-group mb-2">
			        <input type="number" name="telefono" class="form-control" id="inlineFormInputGroup" value="{{$empleado->telefono}}" required>
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInput">Nombre</label>
			      <input type="text" name="nombre" class="form-control mb-2" id="inlineFormInput" value="{{$empleado->nombre}}" required>
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Salario</label>
			      <div class="input-group mb-2">
			        <input type="text" name="salario" class="form-control" id="inlineFormInputGroup" value="{{$empleado->salario}}" required>
			      </div>
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Direccion</label>
			      <div class="input-group mb-2">
			        <input type="text" name="direccion" class="form-control" id="inlineFormInputGroup" value="{{$empleado->direccion}}" required>
			      </div>
			    </div>

			    <div class="col-auto">
			      <button type="submit" class="btn btn-primary mb-2">Editar</button>
			    </div>		    
			  </div>
			</form>
		</div>


@endsection


