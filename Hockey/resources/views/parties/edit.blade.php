@extends ('layouts.master')

@section('content')

<h3>Les parties</h3>

<table class="table table-striped table-bordered">
	<tr>
		<th>Équipe local</th>
		<th>Équipe Distante</th>
		<th>Saison</th>
		<th>Titre</th>
		<th>Lieu</th>
		<th>Date</th>
		<th></th>
	</tr>
	@foreach ($parties as $partie)
	<tr id="{{$partie->id}}">
		<td><select class="form-control local_team">
		@foreach ($equipes as $equipe)
		@if($equipe->id == $partie->local_team)
		<option selected="true" value="{{$equipe->id}}">{{$equipe->name}}</option>
		@else
		<option value="{{$equipe->id}}">{{$equipe->name}}</option>
		@endif
		@endforeach
		</select></td> 
		<td><select class="form-control visitor_team">
		@foreach ($equipes as $equipe)
		@if($equipe->id == $partie->visitor_team)
		<option selected="true" value="{{$equipe->id}}">{{$equipe->name}}</option>
		@else
		<option value="{{$equipe->id}}">{{$equipe->name}}</option>
		@endif
		@endforeach
		</select></td> 
		<td><select class="form-control saison_id">
		@foreach ($saisons as $saison)
		@if($saison->id == $partie->saison_id)
		<option selected="true" value="{{$saison->id}}">{{$saison->name}}</option>
		@else
		<option value="{{$saison->id}}">{{$saison->name}}</option>
		@endif
		@endforeach
		</select></td> 
		<td><input class="form-control titre" name="titre" value="{{$partie->titre}}"></td> 
		<td><input class="form-control lieu" name="lieu" value="{{$partie->lieu}}"></td> 
		<td><input class="form-control date" name="date" value="{{$partie->date}}"></td>
		<td><button class="btn btn-danger EffacerPartie"><span class="glyphicon glyphicon-trash"></span></button></td>
	</tr>
	@endforeach

	<tr>
		<td><select class="form-control NEWlocal_team">
		@foreach ($equipes as $equipe)
		<option value="{{$equipe->id}}">{{$equipe->name}}</option>
		@endforeach
		</select></td> 
		<td><select class="form-control NEWvisitor_team">
		@foreach ($equipes as $equipe)
		<option value="{{$equipe->id}}">{{$equipe->name}}</option>
		@endforeach
		</select></td> 
		<td><select class="form-control NEWsaison_id">
		@foreach ($saisons as $saison)
		@if($saison->id == $id)
		<option selected="true" value="{{$saison->id}}">{{$saison->name}}</option>
		@else
		<option value="{{$saison->id}}">{{$saison->name}}</option>
		@endif
		@endforeach
		</select></td>
		<td><input class="form-control NEWtitre" name="NEWtitre" value=""></td>
		<td><input class="form-control NEWlieu" name="NEWlieu" value=""></td>
		<td><input class="form-control NEWdate" name="NEWdate" value=""></td>
		<td><button id="AjouterPartie" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save"></span></button></td>
	 </tr>

</table>
          
@endsection

@section('scripts')
<script>
$(document).ready(function() {

	$('body').on('click', '.GererJoueurs', function(){
		var tr = $(this).closest('tr').attr('id');
		window.location.href = '/equipes/'+tr+'/joueurs/edit'
	});

	$('body').on('click', '#AjouterPartie', function(){

		var tr = $(this).closest('tr');

		$.ajax({
			type: 'POST',
			url: "/api/parties/edit",
			data: {
				local_team: $(this).closest('tr').find('.NEWlocal_team').val(),
				visitor_team: $(this).closest('tr').find('.NEWvisitor_team').val(),
				saison_id: $(this).closest('tr').find('.NEWsaison_id').val(),
				titre: $(this).closest('tr').find('.NEWtitre').val(),
				lieu: $(this).closest('tr').find('.NEWlieu').val(),
				date: $(this).closest('tr').find('.NEWdate').val(),
	      	},
			dataType: 'json',
			beforeSend: function (xhr) {
		        var token = $('meta[name="_token"]').attr('content');

		        if (token) {
		            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
		        	}
			},
			success: function(data) {
				console.log(data);

				if(data.success === false) 
				{
					tr.addClass('danger');

					var errorString = "";

						$.each(data[0], function(key, value) {
							if(key != undefined)
							errorString += key + ': ' + value + '\n';
						});
					
					alert(errorString);

				} else 
				{
					tr.removeClass('danger');

					var listeLocalString = '<select class="form-control local_team">';
					var listeVisitorString = '<select class="form-control visitor_team">';
					$.each(data.equipes, function(index, element)
					{

						if(element.id == data.p.local_team)
						{
							listeLocalString += '<option value="' + element.id + '" selected="true">' + element.name + '</option>';
						} else
						{
							listeLocalString += '<option value="' + element.id + '">' + element.name + '</option>';
						}

						if(element.id == data.p.visitor_team)
						{
							listeVisitorString += '<option value="' + element.id + '">' + element.name + '</option>';
						} else 
						{
							listeVisitorString += '<option value="' + element.id + '">' + element.name + '</option>';
						}
					});
					listeLocalString += '</select>'
					listeVisitorString += '</select>'

					var listeSaisonString = '<select class="form-control saison_id">';
					$.each(data.saisons, function(index, element)
					{

						if(element.id == data.p.saison_id)
						{
							listeSaisonString += '<option value="' + element.id + '" selected="true">' + element.name + '</option>';
						} else 
						{
							listeSaisonString += '<option value="' + element.id + '">' + element.name + '</option>';
						}
					});
					listeSaisonString += '</select>'

				$('table tr:last').prev().after('<tr id="' + data.p.id + '"><td>' + listeLocalString + '</td><td>' + listeVisitorString + '</td> <td>' + listeSaisonString + '</td><td><input class="form-control titre" name="titre" value="' + data.p.titre + '"></td><td><input class="form-control lieu" name="lieu" value="' + data.p.lieu + '"></td><td><input class="form-control date" name="date" value="' + data.p.date + '"></td><td><button class="btn btn-danger EffacerPartie"><span class="glyphicon glyphicon-trash"></span></button></td></tr>').fadeIn(500);				

				$('table tr:last').find('.NEWlocal_team').val('');
				$('table tr:last').find('.NEWvisitor_team').val('');
				$('table tr:last').find('.NEWsaison_id').val('');
				$('table tr:last').find('.NEWtitre').val('');
				$('table tr:last').find('.NEWlieu').val('');
				$('table tr:last').find('.NEWdate').val('');
			}
			},
			error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, thrownError);
			} 	
		});
	});

	$('body').on('blur', '.local_team,.visitor_team,.saison_id,.titre,.lieu,.date', function(){
		var tr = $(this).closest('tr');
		$.ajax({
			type: "PUT",
			url: '/api/parties/edit/' + $(this).closest('tr').attr('id'),
			data: { 
				id: $(this).closest('tr').attr('id'),
				local_team: $(this).closest('tr').find('.local_team').val(),
				visitor_team: $(this).closest('tr').find('.visitor_team').val(),	
				saison_id: $(this).closest('tr').find('.saison_id').val(),
				titre: $(this).closest('tr').find('.titre').val(),
				lieu: $(this).closest('tr').find('.lieu').val(),
				date: $(this).closest('tr').find('.date').val()
			},
			success: function(data) {
				//pour deboguer
				console.log(data);

				if(data.success === false) 
				{
					tr.addClass('danger');

					var errorString = "";

						$.each(data[0], function(key, value) {
							if(key != undefined)
							errorString += key + ': ' + value + '\n';
						});
					
					alert(errorString);

				} else 
				{
					tr.removeClass('danger');
				}
			}
		});
	});

	$('body').on('click', '.EffacerPartie', function(){

		$(this).closest('tr').remove();

		$.ajax({
			type: "DELETE",
			url: '/api/parties/edit/' + $(this).closest('tr').attr('id'),
			success: function(data) {
				console.log(data);
			}
		});
	});
	//datepicker qui rentre en conflit avec les add de tr et les remove de tr
	//$(".date").datepicker({dateFormat: 'yy-mm-dd'});
	//$(".NEWdate").datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
@endsection
