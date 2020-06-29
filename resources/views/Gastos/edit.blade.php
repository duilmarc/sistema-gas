@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Editar Gasto</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Editar Gastos</h6>
	    </div>
		<table class="table table-dark">
			<thead>
				   <tr>
		              <th scope="col">Tipo Gasto</th>
		              <th scope="col">Monto</th>
		              <th scope="col">Descripcion</th>
				   </tr>
			</thead>
		</table>
	</div>
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
		<form method="POST" action="/gastos/{{$gastos->id}}" >
			@method('PUT')
			@csrf
			<div class="form-row align-items-center">
				<div class="col-auto">
	                    <label class="sr-only" for="inlineFormInputGroup">Tipo Gasto</label>
	                    <div class="input-group mb-2">
	                          <select class="form-control" name="tipo_gasto" id="exampleFormControlSelect1" value="{{$gastos->tipo_gasto}}" required>
	                            <option value="sueldo">sueldo</option>
	                            <option value="combustible">combustible</option>
	                            <option value="gas">gas</option>
	                            <option value="otro">otro</option>
	                          </select>
	                    </div>
	            </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInput">Nombre</label>
			      <input type="text" name="monto" class="form-control mb-2" id="inlineFormInput" value="{{$gastos->monto}}">
			    </div>

				    <div class="col-auto">
				      <label class="sr-only" for="inlineFormInput">Descripcion</label>
				      <input type="text" name="descripcion" class="form-control mb-2" id="inlineFormInput" value="{{$gastos->descripcion}}">
				    </div>
				    <div class="col-auto">
				      <button type="submit" class="btn btn-primary mb-2">Editar</button>
				    </div>		    
			</div>
		</form>
</div>


@endsection


