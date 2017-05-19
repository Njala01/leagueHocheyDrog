@extends ('layouts.master')

@section('content')
@foreach($laPartie as $p)
<h2>Partie entre {{$p->local_team}} et {{$p->visitor_team}}</h2>
@endforeach
@endsection