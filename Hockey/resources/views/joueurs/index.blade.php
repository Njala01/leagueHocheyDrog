@extends ('layouts.master')

@section('content')

<h3>Équipes en direct de NHL.com<h3>
<table>
<tr>
	<td>ID</td>
	<td>Nom</td>
	<td>Points</td>
	<td>But</td>
	<td>Assist</td>
	<td>Penalite</td>
	</tr>
	@foreach($joueur as $j)
	<tr>
	    <td>{{ $j->id }}</td> 
	    <td><a href='#'>{{ $j->name }}</a></td>
	    <td>{{ $j->points }}</td>
	    <td>{{ $j->but }}</td>
	    <td>{{ $j->assist }}</td>
	</tr>
	@endforeach
</table>
@endsection