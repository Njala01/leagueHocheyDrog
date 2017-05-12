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
	   			@if($match->winning_team != null && $match->losing_team != null)
	   				<td>{{$match->final_score_local}}</td>
	   				<td>{{$match->final_score_visitor}}</td>
	   			@else
	   				<td>Non fait</td>
	   				<td>Non fait</td>
	   				<td><a href="/parties/marquerUnePartie/{{$match->id}}">Marquer</a></td> 
	   			@endif
	   		</tr>
	    @endforeach
	    <tr  id="{{$s->id}}">
	    	<td><button type="button" class="btn btn-default GererMatch">Gerer les Match</button></td>
	    </tr>
	    </table>

	@endforeach

@endsection

@section('scripts')
<script>
$(document).ready(function() {
$('body').on('click', '.GererMatch', function(){
		var tr = $(this).closest('tr').attr('id');
		window.location.href = 'saisons/' +tr+ '/parties/edit'
	});
});

</script>
@endsection