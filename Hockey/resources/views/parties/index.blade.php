@extends ('layouts.master')

@section('content')

<h3>Parties en direct de NHL.com<h3>

          @foreach ($parties as $partie)
            @include('parties.partie')  
          @endforeach
          
@endsection