@extends('layouts.dashboard')

@section('titulo','Almacen Create');

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Almacen</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Editar Almacen</h6>
	    </div>
		<table class="table table-dark">
			<thead>
				   <tr>
				      <th scope="col-auto">balon_lleno_normal</th>
				      <th scope="col-auto">balon_lleno_premium</th>
				      <th scope="col-auto">balon_vacio_normal</th>
				      <th scope="col-auto">balon_vacio_premium</th>
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
			<form method="POST" action="/Almacen/{{$almacen->balon_lleno_normal}}" >
				@method('PUT')
				@csrf
			  <div class="form-row align-items-center">
			  	<div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">balon_lleno_normal</label>
			      <div class="input-group mb-2">
			        <input type="text" name="balon_lleno_normal" class="form-control" id="inlineFormInputGroup" value="{{$almacen->balon_lleno_normal}}">
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInput">balon_lleno_premium</label>
			      <input type="text" name="balon_lleno_premium" class="form-control mb-2" id="inlineFormInput" value="{{$almacen->balon_lleno_premium}}">
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">balon_vacio_normal</label>
			      <div class="input-group mb-2">
			        <input type="text" name="balon_vacio_normal" class="form-control" id="inlineFormInputGroup" value="{{$almacen->balon_vacio_normal}}">
			      </div>
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">balon_vacio_premium</label>
			      <div class="input-group mb-2">
			        <input type="text" name="balon_vacio_premium" class="form-control" id="inlineFormInputGroup" value="{{$almacen->balon_vacio_premium}}">
			      </div>
			    </div>

			    <div class="col-auto">
			      <button type="submit" class="btn btn-primary mb-2">Editar</button>
			    </div>		    
			  </div>
			</form>
		</div>


@endsection


