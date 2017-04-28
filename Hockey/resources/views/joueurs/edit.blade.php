@extends ('layouts.master')

@section('content')

<h3>Les équipes {{ $id }}</h3>

<table class="table table-striped table-bordered">
	<tr>
		<th>Nom</th>
		<th>Position</th>
		<th>Équipe</th>
		<th></th>
	</tr>
	@foreach ($joueurs as $joueur)
	<tr id="{{$joueur->id}}">
		<td><input class="form-control Nom" name="Nom" value="{{$joueur->name}}"></td> 
		<td><input class="form-control Position" name="Position" value="{{$joueur->position}}"></td>
		<td><input class="form-control Equipe" name="Equipe" value="{{$joueur->equipe->name}}"></td>
		<td><button class="btn btn-danger EffacerJoueur"><span class="glyphicon glyphicon-trash"></span></button></td>
	</tr>
	@endforeach

	<tr>
		<td><input class="form-control NewNom" name="NewNom" value=""></td> 
		<td><input class="form-control NewPosition" name="NewPosition" value=""></td>
		<td><button id="AjouterJoueur" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save"></span></button></td>
	 </tr>

</table>
          
@endsection

@section('scripts')
<script>
$(document).ready(function() {

	//Sur le click du bouton ajouter, on ajoute l'équipe avec les infos données
	$('body').on('click', '#AjouterJoueur', function(){
		var tr = $(this).closest('tr');

		$.ajax({
			type: 'POST',
			url: "/api/joueurs/edit",
			data: {
				name: $(this).closest('tr').find('.NewNom').val(),
				position: $(this).closest('tr').find('.NewPosition').val(),
				equipe_name: {{ $id }}
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

				$('table tr:last').prev().after('<tr id="' + data.joueur.id + '"><td><input class="form-control Nom" name="Nom" value="' + data.joueur.name + '"></td><td><input class="form-control Admin" name="Admin" value="' + data.joueur.position + '"></td> <td><input class="form-control id_saison" name="id_saison" value="' + data.joueur.equipe_name + '"></td><td><button class="btn btn-danger EffacerPartie"><span class="glyphicon glyphicon-trash"></span></button></td></tr>').fadeIn(500);				

				$('table tr:last').find('.NewNom').val('');
				$('table tr:last').find('.NewPosition').val('');
			}
			},
			error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, thrownError);
			} 	
		});
	});

	//Quand le focus est perdu sur un champ, on sauvegarde
	$('body').on('blur', '.Nom,.Position,.Equipe', function(){

		var tr = $(this).closest('tr');
		$.ajax({
			type: "PUT",
			url: '/api/joueurs/edit/' + $(this).closest('tr').attr('id'),
			data: { 
				id: $(this).closest('tr').attr('id'),
				name: $(this).closest('tr').find('.Nom').val(),
				position: $(this).closest('tr').find('.Position').val(),	
				equipe_name: $(this).closest('tr').find('.Equipe').val()
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
	$('body').on('click', '.EffacerJoueur', function(){

		$(this).closest('tr').remove();

		$.ajax({
			type: "DELETE",
			url: '/api/joueurs/edit/' + $(this).closest('tr').attr('id'),
			success: function(data) {
				console.log(data);
			}
		});
	});
});
</script>
@endsection