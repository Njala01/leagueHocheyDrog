@extends ('layouts.master')

@section('content')

<h3>Équipes en direct de NHL.com<h3>

	@foreach($saisons as $s)
	    <li>{{ $s->id }} - {{ $s->name }}</li>
	    <table style="margin-left: 1em;">
	    	<tr>
	    		<td>match ID</td>
	    		<td>Equipe Local</td>
	    		<td>Equipe Visiteur</td>
	    		<td>Score Local</td>
	    		<td>Score visiteur</td>
	    	</tr>
	    @foreach($s->partie as $match)
	   	<tr>
	   		<td>{{$match->id}}</td>
	   		<td>{{$match->getEquipe($match->local_team)}}</td>
	   		<td>{{$match->getEquipe($match->visitor_team)}}</td>
	   		@if($match->final_score_local != null)
	   		<td>{{$match->final_score_local}}</td>
	   		<td>{{$match->final_score_visitor}}</td>
	   		@else
	   		<td>Non fait</td>
	   		<td>Non fait</td>
	   		<td><a href="#">Marquer</a></td> 
	   		@endif


	   	</tr>
	    @endforeach
	    <tr>
	    	<td><button type="button" class="btn btn-default">Nouveau Match</button></td>
	    </tr>
	    </table>

	@endforeach

@endsection