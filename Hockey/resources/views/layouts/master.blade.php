<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Icon -->
    <link rel="icon" href="../../../public/NHL_LOGO.png">

    <title>NHL.com</title>

        <!-- Styles -->
    <link href="{{ asset('css/hockey.css') }}" rel="stylesheet">

        <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
  </head>

  <body style="background-color: #ececec">

  @include('layouts.nav')


    <div class="container" style="min-height:800px;">

      <div class="row">

      <div class="col-lg-8 col-md-12">
         @yield('content')
      </div>
      <div class="col-lg-4 col-md-12">
         @include('layouts.sidebar')
      </div>
      </div><!-- /.row -->

    </div><!-- /.container -->

    @include('layouts.footer')

    <!-- Scripts -->
    <script
    src="https://code.jquery.com/jquery-1.9.1.min.js"
    integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ="
    crossorigin="anonymous">
    </script>

    <script 
    type="text/javascript" 
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>

    @yield('scripts')

  </body>
</html>
