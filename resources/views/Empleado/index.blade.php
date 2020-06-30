@extends('layouts.dashboard')

@section('titulo')
<title>Sistema- Repartidor</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
  <h1 class="h3 mb-1 text-gray-800">Repartidores</h1>
	<p class="mb-4"></p>
	<div class="col-lg-12">
		<div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Registrar Repartidor</h6>
	    </div>
		<table class="table table-dark">
			<thead>
				   <tr>
				      <th scope="col">Telefono</th>
				      <th scope="col">Nombres</th>
				      <th scope="col">Salario</th>
				      <th scope="col">Direccion</th>
				   </tr>
			</thead>
		</table>
    <form method="POST" action="/empleados">
        @csrf
        <div class="form-row align-items-center">
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Telefono</label>
            <div class="input-group mb-2">
              <input type="number" name="telefono" class="form-control" id="inlineFormInputGroup" placeholder="Telefono" required>
            </div>
          </div>


          <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Nombres</label>
            <input type="text" name="nombres" class="form-control mb-2" id="inlineFormInput" placeholder="nombres" required>
          </div>
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Salario</label>
            <div class="input-group mb-2">
              <input type="text" name="salario" class="form-control" id="inlineFormInputGroup" placeholder="Salario" required>
            </div>
          </div>
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Direccion</label>
            <div class="input-group mb-2">
              <input type="text" name="direccion" class="form-control" id="inlineFormInputGroup" placeholder="Direccion" required>
            </div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Visualizar Repartidor</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-dark table-sm table-bordered " bg="white" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                            <th>Telefono Contacto</th>
                            <th>Nombres</th>
                            <th>Direccion</th>
                            <th>Salario</th>
                            <th>Editar...</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($empleados as $empleado)     
                        <td>{{$empleado->telefono}}</td>
                        <td>{{$empleado->nombre}}</td>
                        <td>{{$empleado->direccion}}</td>
                        <td>{{$empleado->salario}}</td>
                                <td><center>
                                    <a class="btn btn-info" href="/empleados/{{$empleado->telefono}}/edit" aria-label="edit">
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