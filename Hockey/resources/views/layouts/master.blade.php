<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>NHL.com</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script
        src="https://code.jquery.com/jquery-1.9.1.min.js"
        integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ="
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body style="background-color: #ffff99">

  @include('layouts.nav')


    <div class="container" style="min-height:800px;background-color: #eeeeee">

      <div class="row">
      
         @yield('content')

      </div><!-- /.row -->

    </div><!-- /.container -->

    @include('layouts.footer')

  </body>
</html>
