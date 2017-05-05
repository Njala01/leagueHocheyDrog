@extends ('layouts.master')

@section('content')

<h3>Équipes en direct de NHL.com<h3>

	@foreach($saisons as $s)
	    <li>{{ $s->id }} - {{ $s->name }}</li>
	    <table style="margin-left: 1em;">
	    @foreach($s->partie as $match)
	   	<tr>
	   		<td>{{$match->id}}</td>
	   		<td>{{$match->}}</td>
	   		<td>{{$match->id}}</td>
	   	</tr>
	    	

	    @endforeach
	    </table>

	@endforeach

@endsection