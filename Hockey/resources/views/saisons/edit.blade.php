@extends ('layouts.master')

@section('content')

<h3>Les Saisons</h3>

<select class="form-control LigueList">
@foreach ($ligues as $ligue)
<option value="{{$ligue->id}}">{{$ligue->name}}</option>
@endforeach
</select>


<table class="table table-striped table-bordered">
	<tr>
		<th>Nom</th>
		<th>Ligue</th>
		<th>Début</th>
		<th>Fin</th>
		<th></th>
	</tr>
	@foreach ($saisons as $saison)
	<tr id="{{$saison->id}}">
		<td><input class="form-control Nom" name="Nom" value="{{$saison->name}}"></td> 
		<td><input class="form-control Ligue" name="Ligue" value="{{$saison->ligue_id}}"></td> 
		<td><input class="form-control Debut" name="Debut" value="{{$saison->start_date}}"></td>
		<td><input class="form-control Fin" name="Fin" value="{{$saison->end_date}}"></td>
		<td><button class="btn btn-danger EffacerSaison"><span class="glyphicon glyphicon-trash"></span></button></td>
	</tr>
	@endforeach

	<tr>
		<td><input class="form-control NewNom" name="NewNom" value=""></td> 
		<td><input class="form-control NewLigue" name="NewLigue" value=""></td>	
		<td><input class="form-control NewDebut" name="NewDebut" value=""></td>
		<td><input class="form-control NewFin" name="NewFin" value=""></td> 
		<td><button id="AjouterSaison" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save"></span></button></td>
	 </tr>

</table>
          
@endsection

@section('scripts')
<script>
$(document).ready(function() {

	//Sur le click du bouton ajouter, on ajoute l'équipe avec les infos données
	$('body').on('click', '#AjouterSaison', function(){
		var tr = $(this).closest('tr');

		$.ajax({
			type: 'POST',
			url: "/api/saisons/edit",
			data: {
				name: $(this).closest('tr').find('.NewNom').val(),
				ligue_id: $(this).closest('tr').find('.NewLigue').val(),
				start_date: $(this).closest('tr').find('.NewDebut').val(),
				end_date: $(this).closest('tr').find('.NewFin').val()
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

						$.each(data.errors, function(key, value) {
							if(key != undefined)
							errorString += key + ': ' + value + '\n';
						});
					
					alert(errorString);

				} else 
				{
					tr.removeClass('danger');

				$('table tr:last').prev().after('<tr id="' + data.saison.id + '"><td><input class="form-control Nom" name="Nom" value="' + data.saison.name + '"></td><td><input class="form-control Ligue" name="Ligue" value="' + data.saison.ligue_id + '"></td><td><input class="form-control Debut" name="Debut" value="' + data.saison.start_date + '"></td><td><input class="form-control Fin" name="Fin" value="' + data.saison.end_date + '"></td><td><button class="btn btn-danger EffacerSaison"><span class="glyphicon glyphicon-trash"></span></button></td></tr>').fadeIn(500);				

				$('table tr:last').find('.NewNom').val('');
				$('table tr:last').find('.NewLigue').val('');
				$('table tr:last').find('.NewDebut').val('');
				$('table tr:last').find('.NewFin').val('');
			}
			},
			error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, thrownError);
			} 	
		});
	});

	//Quand le focus est perdu sur un champ, on sauvegarde
	$('body').on('blur', '.Nom,.Ligue,.Debut,.Fin', function(){

		var tr = $(this).closest('tr');
		$.ajax({
			type: "PUT",
			url: '/api/saisons/edit/' + $(this).closest('tr').attr('id'),
			data: { 
				id: $(this).closest('tr').attr('id'),
				name: $(this).closest('tr').find('.Nom').val(),
				ligue_id: $(this).closest('tr').find('.Ligue').val(),
				start_date: $(this).closest('tr').find('.Debut').val(),
				end_date: $(this).closest('tr').find('.Fin').val()
			},
			success: function(data) {
				//pour deboguer
				console.log(data);

				if(data.success === false) 
				{
					tr.addClass('danger');

					var errorString = "";

						$.each(data.errors, function(key, value) {
							if(key != undefined)
							errorString += key + ': ' + value + '\n';
						});
					
					alert(errorString);

				} else 
				{
					tr.removeClass('danger');
				}
			},
			complete: function (data) {

				tr.addClass('danger');
				var errorString = "";

					$.each(data.errors, function(key, value) {
						if(key != undefined)
						errorString += key + ': ' + value + '\n';
					});
				
				alert(errorString);
			}
		});
	});

	//Quand le bouton supprimer est appuyé, on effface la donnée
	$('body').on('click', '.EffacerSaison', function(){

		$(this).closest('tr').remove();

		$.ajax({
			type: "DELETE",
			url: '/api/saisons/edit/' + $(this).closest('tr').attr('id'),
			success: function(data) {
				console.log(data);
			}
		});
	});
});
</script>
@endsection