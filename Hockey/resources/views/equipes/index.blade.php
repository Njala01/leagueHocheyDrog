@extends ('layouts.master')

@section('content')

<h3>Équipes en direct de NHL.com<h3>

          @foreach ($equipes as $equipe)
            @include('equipes.equipe')  
          @endforeach
          
@endsection