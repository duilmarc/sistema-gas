<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  @yield('titulo')

  <!-- Bootstrap core CSS -->

  _<link href="{{ asset('css/fuentes/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/one-page-wonder.css') }}"  rel="stylesheet">

</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        GAS A DOMICILIO
      </a>
    </div>
  </nav>

@yield('content')



  <!-- Footer -->
  <footer class="py-5 bg-black">
    <div class="container">
      <p class="m-0 text-center text-white small">Copyright &copy; Apps Core</p>
      <p class="m-0 text-center text-white small">2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('css/fuentes/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('css/fuentes/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
