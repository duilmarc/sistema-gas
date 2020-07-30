@extends('layouts.dashboard')

@section('titulo')
<title>Sistema- Clientes</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-1 text-gray-800">Clientes</h1>
        <p class="mb-4"></p>
        <div class="col-lg-12">
        <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Registrar Cliente</h6>
          </div>
        <table class="table table-dark">
          <thead>
                <tr>
                  <th scope="col">Telefono</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Direccion</th>
                  <th scope="col">Balon prestado</th>
                  <th scope="col">Deuda</th>
                  <th scope="col">Comentario</th>

                </tr>
          </thead>
        </table>
          <form method="POST" action="/clientes">
            @csrf
            <div class="form-row align-items-center">
              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Telefono</label>
                <div class="input-group mb-2">
                  <input type="number" name="telefono" class="form-control" id="inlineFormInputGroup" placeholder="Telefono" required>
                </div>
              </div>


              <div class="col-auto">
                <label class="sr-only" for="inlineFormInput">Nombre</label>
                <input type="text" name="nombre" class="form-control mb-2" id="inlineFormInput" placeholder="Nombre">
              </div>
              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Apellido</label>
                <div class="input-group mb-2">
                  <input type="text" name="apellido" class="form-control" id="inlineFormInputGroup" placeholder="Apellido">
                </div>
              </div>
              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup">Direccion</label>
                <div class="input-group mb-2">
                  <input type="text" name="direccion" class="form-control" id="inlineFormInputGroup" placeholder="Direccion">
                </div>
              </div>
                <div class="col-auto">
                  <label class="sr-only" for="inlineFormInputGroup">Balon prestado</label>
                  <div class="input-group mb-2">
                    <input type="text" name="balon_prestado" class="form-control" id="inlineFormInputGroup" placeholder="Balones prestados">
                  </div>
              </div>
              <div class="col-auto">
                  <label class="sr-only" for="inlineFormInputGroup">Deuda</label>
                  <div class="input-group mb-2">
                    <input type="number" step='0.01' name="deuda" class="form-control" id="inlineFormInputGroup" placeholder="Deuda">
                  </div>
              </div>
              <div class="col-auto">
                  <label class="sr-only" for="inlineFormInputGroup">Coment</label>
                  <div class="input-group mb-2">
                    <input type="text"  name="comentarios" class="form-control" id="inlineFormInputGroup" placeholder="Comentarios">
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
                              <h6 class="m-0 font-weight-bold text-primary">Visualizar Clientes</h6>
                          </div>
                            <div class="card-body">
                                        <div class="table-responsive">
                                          <table class="table table-hover table-dark table-sm table-bordered "bg="white" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                      <tr>
                                                          <th>Telefono Contacto</th>
                                                          <th>Nombre</th>
                                                          <th>Apellido</th>
                                                          <th>Dirección</th>
                                                          <th>Balon Prestado</th>
                                                          <th>Deuda</th>
                                                          <th>Frecuencia</th>
                                                          <th>Comentarios</th>
                                                          <th>Fecha y hora</th>
                                                          <th>Editar...</th>
                                                      </tr>
                                                    </thead>
                                                      
                                                      <tbody>
                                                        @foreach ($clientes as $cliente)     
                                      							      <td>{{$cliente->telefono}}</td>
                                      							      <td>{{$cliente->nombres}}</td>
                                      							      <td>{{$cliente->apellidos}}</td>
                                      							      <td>{{$cliente->direccion}}</td>
                                                          <td>{{$cliente->balon_prestado}}</td>
                                                          <td>{{$cliente->deuda}}</td>
                                                          <td>{{$cliente->frecuencia}}</td>
                                                          <td>{{$cliente->comentarios}}</td>
                                                          <td>{{$cliente->updated_at}}</td>
                                                                <td><center>
                                                                    <a class="btn btn-info" href="/clientes/{{$cliente->telefono}}/edit" aria-label="edit">
                                                                       <i class="fa fa-user-circle" aria-hidden="true"></i>
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
  <script src="{{ asset('css/fuentes/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('css/fuentes/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js')}}"></script>

@endsection