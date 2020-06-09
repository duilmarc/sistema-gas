@extends('layouts.welcome')

@section('titulo')
<title>Sistema Gas</title>
@endsection

@section('content')

  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">Sistema de control de GAS</h1>
        @auth
        <a href="{{ url('/home') }}"  class="btn btn-primary btn-xl rounded-pill mt-5">Volver al Sistema</a>
       
        @else
        <a href="{{ route('login') }}"  class="btn btn-primary btn-xl rounded-pill mt-5">Iniciar Sesión</a>
        @endauth
      </div>
    </div>
    
  </header>


@endsection