@extends('layouts.dashboard')
@section('titulo')
<title>Sistema- Inicio</title>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="alert alert-warning alert-dismissible">
                    
                        <h4><i class="icon fa fa-exclamation-triangle"></i> Mensaje</h4>
                        {{ $notificacion }}
                    </div>
                </div>

                <div class="card-body">
                    <a href="{{ url('/home') }}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                          <i class="fas fa-caret-right"></i>
                        </span>
                        <span class="text">Regresar</span>
                      </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
