@extends ('layouts.master')

@section('content')

<h3>Ligues en direct de NHL.com<h3>

	@foreach($ligues as $l)
	    <li>{{ $l->id }} - {{ $l->name }}</li>

	    <table style=" margin-left: 2em; width:4em;">
	    <th>Equipe</th>
	    	@foreach($l->equipe as $e)
	    	<tr style=" background-color: white; padding: 40px;">
	    		
	    		<td>{{$e->name}}</td>
	    	</tr>
	    	@endforeach
	    	<td id="{{$l->id}}"><button id="gererEquipe" class="btn btn-default gererEquipe">Gerer les equipes</td>
	    </table>
	@endforeach

@endsection

@section('scripts')
<script>
$(document).ready(function() {

	$('body').on('click', '.gererEquipe', function(){
		var tr = $(this).closest('td').attr('id');
		window.location.href = '/equipes/'+tr+'/joueurs/edit'
	});
});
</script>
@endsection