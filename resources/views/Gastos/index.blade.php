@extends('layouts.dashboard')



@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Gastos</h1>
  <p class="mb-4"></p>
  <div class="col-lg-12">
    <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Registrar Gastos</h6>
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
      <form method="POST" action="/gastos">
        @csrf
        <div class="form-row align-items-center">

                    <div class="col-auto">
                      <label class="sr-only" for="inlineFormInputGroup">Tipo Gasto</label>
                        <div class="input-group mb-2">
                          <select class="form-control" name="tipo_gasto" id="exampleFormControlSelect1" required>
                            <option value="sueldo">sueldo</option>
                            <option value="combustible">combustible</option>
                            <option value="gas">gas</option>
                            <option value="otro">otro</option>
                          </select>
                      </div>
                    </div>

          <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Monto</label>
            <input type="number" step="0.1" name="monto" class="form-control mb-2" id="inlineFormInput" placeholder="Monto" required>
          </div>

          <div class="col-auto">
            <label class="sr-only" for="inlineFormInputGroup">Descripcion</label>
            <div class="input-group mb-2">
              <input type="text" name="descripcion" class="form-control" id="inlineFormInputGroup" placeholder="Descripcion">
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
                    <h6 class="m-0 font-weight-bold text-primary">Visualizar Gastos</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-dark table-sm table-bordered " bg="white" id="sorteable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                            <th>Tipo de gasto</th>
                            <th>Monto</th>
                            <th>Descripcion</th>
                            <th>Fecha</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($gastos as $gasto)     
                          <td>{{$gasto->tipo_gasto}}</td>
                          <td>{{$gasto->monto}}</td>
                          <td>{{$gasto->descripcion}}</td>
                          <td>{{$gasto->fecha}}</td>
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