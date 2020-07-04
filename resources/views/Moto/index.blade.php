@extends('layouts.dashboard')

@section('titulo')
<title>Sistema- Motos</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
  <h1 class="h3 mb-1 text-gray-800">Motos</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Registrar motos</h6>
	    </div>
		<table class="table table-dark">
			<thead>
				   <tr>
				      <th scope="col">Placa</th>
				      <th scope="col">Color</th>
              <th scope="col">Ultimo mantenimiento</th>
              <th scope="col">Descripcion</th>
				   </tr>
			</thead>
		</table>
    <form method="POST" action="/motos">
        @csrf
        <div class="form-row align-items-center">
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Placa</label>
            <div class="input-group mb-2">
              <input type="text" name="placa" class="form-control" id="inlineFormInputGroup" placeholder="placa" required>
            </div>
          </div>


          <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Color</label>
            <input type="text" name="color" class="form-control mb-2" id="inlineFormInput" placeholder="color">
          </div>
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Ultimo mantenimiento</label>
            <input type="date" name="fecha" class="form-control mb-2" id="inlineFormInput" placeholder="ultimo mantenimiento">
          </div>
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Descripcion</label>
            <input type="text" name="descripcion" class="form-control mb-2" id="inlineFormInput" placeholder="descripcion">
          </div>
          
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">Registrar</button>
          </div>        
        </div>
      </form>



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
        <div class="col-lg-12">
            <div class="card shadow mb-4  border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Visualizar Motos</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                            <th>Placa</th>
                            <th>Color</th>
                            <th>Ultimo mantenimiento</th>
                            <th>Descripcion</th>
                            <th>Editar...</th>

                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($motos as $moto)     
                        <td>{{$moto->placa}}</td>
                        <td>{{$moto->color}}</td>
                        <td>{{$moto->fecha}}</td>
                        <td>{{$moto->descripcion}}</td>
                        <td><center>
                                    <a class="btn btn-info" href="/motos/{{$moto->placa}}/edit" aria-label="edit">
                                        <i class="fa fa-motorcycle" aria-hidden="true"></i>
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


@endsection
@section('footers')

  <!-- Page level plugins -->
  <script src="{{ asset('css/fuentes/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('css/fuentes/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js')}}"></script>

@endsection