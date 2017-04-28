@extends ('layouts.master')

@section('content')

<h3>Équipes en direct de NHL.com<h3>
<table>
<tr>
	<td>ID</td>
	<td>Nom</td>
	<td>Points</td>
</tr>
	@foreach($equipes as $e)
	<tr>
	    <td>{{ $e->id }}</td> <td><a href='#'>{{ $e->name }}</a></td>
	    <td>{{ $e->getPoint($e->id) }}</td>
	</tr>
	@endforeach
</table>
@endsection