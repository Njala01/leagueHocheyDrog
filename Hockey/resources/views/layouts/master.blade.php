<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="../../NHL_LOGO.png">

    <title>NHL.com</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script
        src="https://code.jquery.com/jquery-1.9.1.min.js"
        integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ="
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body style="background-color: #ececec">

  @include('layouts.nav')


    <div class="container" style="min-height:800px;">

      <div class="row">

      <div class="col-xs-8">
         @yield('content')
      </div>
      <div class="col-xs-4">
         @include('layouts.sidebar')
      </div>
      </div><!-- /.row -->

    </div><!-- /.container -->

    @include('layouts.footer')

    @yield('scripts')

  </body>
</html>
