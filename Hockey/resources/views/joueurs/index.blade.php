@extends ('layouts.master')

@section('content')

<h3>Équipes en direct de NHL.com<h3>
<table style="font-size: 80%;">
<tr>
	<td>ID</td>
	<td>Nom</td>
	<td>Equipe</td>
	<td>Points</td>
	<td>But</td>
	<td>Assist</td>

	</tr>
	@foreach($joueurs as $j)
	<tr>
	    <td>{{ $j->id }}</td> 
	    <td><a href='#'>{{ $j->name }}</a></td>
	    <td>{{ $j->equipe->first()->name}}</td>
	    <td>{{ $j->points }}</td>
	    <td>{{ $j->but }}</td>
	    <td>{{ $j->assist }}</td>
	    
	</tr>
	@endforeach
</table>
@endsection