@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">moto</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Editar motos</h6>
	    </div>
		<table class="table table-dark">
			<thead>
				   <tr>
				      <th scope="col-auto">Placa</th>
				      <th scope="col-auto">Color</th>
				      <th scope="col-auto">Ultimo mantenimiento</th>
				      <th scope="col">Descripcion</th>
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
			<form method="POST" action="/motos/{{$moto->placa}}" >
				@method('PUT')
				@csrf
			  <div class="form-row align-items-center">
			  	<div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">Placa</label>
			      <div class="input-group mb-2">
			        <input type="text" name="id" class="form-control" id="inlineFormInputGroup" value="{{$moto->placa}}" required="">
			      </div>
			    </div>

			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInput">Color</label>
			      <input type="text" name="color" class="form-control mb-2" id="inlineFormInput" value="{{$moto->color}}" required>
			    </div>
			    <div class="col-auto">
		            <label class="sr-only" for="inlineFormInput">Ultimo mantenimiento</label>
		            <input type="date" name="fecha" class="form-control mb-2" id="inlineFormInput" value="{{$moto->fecha}}" >
          		</div>
          		<div class="col-auto">
		            <label class="sr-only" for="inlineFormInput">Descripcion</label>
		            <input type="text" name="descripcion" class="form-control mb-2" id="inlineFormInput" value="{{$moto->descripcion}}">
		        </div>

			    <div class="col-auto">
			      <button type="submit" class="btn btn-primary mb-2">Editar</button>
			    </div>		    
			  </div>
			</form>
		</div>


@endsection


