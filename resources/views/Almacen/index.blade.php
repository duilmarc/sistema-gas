@extends('layouts.dashboard')

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
                        <th scope="col">balon lleno normal</th>
                        <th scope="col">balon lleno premiun</th>
                        <th scope="col">balon vacio normal</th>
                        <th scope="col">balon vacio premiun</th>
                        <th scope="col">precio x balon</th>
                        <th scope="col">balones prestados</th>
				   </tr>
			</thead>
		</table>
			<form method="POST" action="/almacen">
				@csrf
			  <div class="form-row align-items-center">

			    <div class="col">
			      <label class="sr-only" for="inlineFormInput">balon lleno normal</label>
			      <input type="number" name="balon_lleno_normal" class="form-control mb-2" id="inlineFormInput" value="{{$almacenes[0]->balon_lleno_normal}}" placeholder="balon_lleno_normal" required>
			    </div>

			    <div class="col">
			      <label class="sr-only" for="inlineFormInputGroup">balon lleno premiun</label>
			      <div class="input-group mb-2">
			        <input type="number" name="balon_lleno_premiun" class="form-control" id="inlineFormInputGroup" value="{{$almacenes[0]->balon_lleno_premiun}}" placeholder="balon_lleno_premiun" required>
			      </div>
			    </div>
			    <div class="col">
			      <label class="sr-only" for="inlineFormInputGroup">balon vacio normal</label>
			      <div class="input-group mb-2">
			        <input type="number" name="balon_vacio_normal" class="form-control" id="inlineFormInputGroup" value="{{$almacenes[0]->balon_vacio_normal}}" placeholder="balon_vacio_normal" required>
			      </div>
			    </div>


			    <div class="col">
			      <label class="sr-only" for="inlineFormInputGroup">balon vacio premiun</label>
			      <div class="input-group mb-2">
			        <input type="number" name="balon_vacio_premiun" class="form-control" id="inlineFormInputGroup" value="{{$almacenes[0]->balon_vacio_premiun}}"placeholder="balon_vacio_premiun" required>
			      </div>
			    </div>
			    <div class="col">
			      <label class="sr-only" for="inlineFormInputGroup">precio x balon</label>
			      <div class="input-group mb-2">
			        <input type="number" step="0.1" name="precioxbalon" class="form-control" id="inlineFormInputGroup" value="{{$almacenes[0]->precioxbalon}}" placeholder="precioxbalon" required>
			      </div>
			    </div>
			    <div class="col">
			      <label class="sr-only" for="inlineFormInputGroup">balones prestados</label>
			      <div class="input-group mb-2">
			        <input type="number" name="balones_prestados" class="form-control" id="inlineFormInputGroup" value="{{$total}}">
			      </div>
			    </div>

			    <div class="col">
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
                    <table class="table table-hover table-dark table-sm table-bordered " bg="white" id="sorteable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                            <th>Almacen</th>
                            <th>balon lleno normal</th>
                            <th>balon lleno premiun</th>
                            <th>balon vacio normal</th>
                            <th>balon vacio premiun</th>
                            <th>precio x balon</th>
                            <th>balones prestados</th>
                            <th>Fecha Registro</th>
                            <th>Actualizado</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($almacenes as $alma)     
							      <td>{{$alma->almacen}}</td>
							      <td>{{$alma->balon_lleno_normal}}</td>
							      <td>{{$alma->balon_lleno_premiun}}</td>
							      <td>{{$alma->balon_vacio_normal}}</td>
							      <td>{{$alma->balon_vacio_premiun}}</td>
							      <td>{{$alma->precioxbalon}}</td>
							      <td>{{$alma->balones_prestados}}</td>
							      <td>{{$alma->fecha}}</td>
							      <td>{{$alma->updated_at}}</td>
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
  <script src="{{ asset('css/fuentes/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('css/fuentes/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js')}}"></script>

@endsection