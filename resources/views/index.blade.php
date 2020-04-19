@extends('layouts.welcome')

@section('titulo')
<title>Bienvenido a Cruz Roja</title>
@endsection

@section('content')

  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">Sistema de horas</h1>
        <h2 class="masthead-subheading mb-0">y control de servicios</h2>
        
        
        @auth
        <a href="{{ url('/home') }}"  class="btn btn-primary btn-xl rounded-pill mt-5">Volver al Sistema</a>
        @else
        <a href="{{ route('login') }}"  class="btn btn-primary btn-xl rounded-pill mt-5">Iniciar Sesión</a>
        @endauth
      </div>
    </div>
    
  </header>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid" src="{{ asset('img/undraw_collaborators_prrw.svg') }}" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">La Cruz Roja Peruana Filial Arequipa...</h2>
            <p>En busca de la mejora continua del trabajo con los voluntarios, se diseño e implemento un 
              sistema que busca mejorar la relación de los voluntarios y sus actividades que realizan en 
              la filial. Esperamos que sea de mucha ayuda.
               </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="p-5">
            <img class="img-fluid" src="{{ asset('img/undraw_spreadsheet_69ax.svg') }}" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">Sistema de control de horas y servicios!</h2>
            <p>En este sistema podras visualizar las horas y los servicios que realizas en la filial, asi como también podrás realizar comentarios referentes a los servicios
              que asistes, lo que permite tener una constante retroalimentación de la información y nos permite mejorar como
              institución.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid" src="{{ asset('img/undraw_the_world_is_mine_nb0e.svg') }}" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Nunca dejes de ser  la fuerza que sostiene al mundo!</h2>
            <p></p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection