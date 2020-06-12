@extends('layouts.dashboard')

@section('titulo','Almacenes');

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Almacenes</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Registrar Almacen</h6>
	    </div>
		<table class="table table-dark">
			<thead>
				   <tr>
				        <th scope="col">Almacen</th>
                        <th scope="col">balon_lleno_normal</th>
                        <th scope="col">balon_lleno_premiun</th>
                        <th scope="col">balon_vacio_normal</th>
                        <th scope="col">balon_vacio_premiun</th>
				   </tr>
			</thead>
		</table>
			<form method="POST" action="/almacen">
				@csrf
			  <div class="form-row align-items-center">
			  	<div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">almacen</label>
			      <div class="input-group mb-2">
			        <input type="text" name="almacen" class="form-control" id="inlineFormInputGroup" placeholder="Almacen">
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInput">balon_lleno_normal</label>
			      <input type="text" name="balon_lleno_normal" class="form-control mb-2" id="inlineFormInput" placeholder="balon_lleno_normal">
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">balon_lleno_premiun</label>
			      <div class="input-group mb-2">
			        <input type="text" name="balon_lleno_premiun" class="form-control" id="inlineFormInputGroup" placeholder="balon_lleno_premiun">
			      </div>
			    </div>
			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">balon_vacio_normal</label>
			      <div class="input-group mb-2">
			        <input type="text" name="balon_vacio_normal" class="form-control" id="inlineFormInputGroup" placeholder="balon_vacio_normal">
			      </div>
			    </div>


			    <div class="col-auto">
			      <label class="sr-only" for="inlineFormInputGroup">balon_vacio_premiun</label>
			      <div class="input-group mb-2">
			        <input type="text" name="balon_vacio_premiun" class="form-control" id="inlineFormInputGroup" placeholder="balon_vacio_premiun">
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
                    <h6 class="m-0 font-weight-bold text-primary">Visualizar Almacenes</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" bg="red" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                            <th>Almacen</th>
                            <th>balon_lleno_normal</th>
                            <th>balon_lleno_premiun</th>
                            <th>balon_vacio_normal</th>
                            <th>balon_vacio_premiun</th>
                            <th>Ver mas...</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($almacenes as $alma)     
							      <td>{{$alma->almacen}}</td>
							      <td>{{$alma->balon_lleno_normal}}</td>
							      <td>{{$alma->balon_lleno_premiun}}</td>
							      <td>{{$alma->balon_vacio_normal}}</td>
							      <td>{{$alma->balon_vacio_premiun}}</td>
                                <td><center>
                                    <a class="btn btn-info" href="/Almacen/{{$alma->almacen}}" aria-label="Settings">
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