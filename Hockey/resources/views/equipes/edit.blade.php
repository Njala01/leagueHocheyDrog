@extends ('layouts.master')

@section('content')

<h3>Les équipes</h3>

<table class="table table-striped table-bordered">
	<tr>
		<th>Nom</th>
		<th>Admin</th>
		<th>Ligue</th>
		<th></th>
	</tr>
	@foreach ($equipes as $equipe)
	<tr id="{{$equipe->id}}">
		<td><input class="form-control Nom" name="Nom" value="{{$equipe->name}}"></td> 
		<td><input class="form-control Admin" name="Admin" value="{{$equipe->admin_id}}"></td> 
		<td><input class="form-control Ligue" name="Ligue" value="{{$equipe->ligue_id}}"></td>
		<td style="min-width:180px;"><button class="btn btn-danger EffacerEquipe"><span class="glyphicon glyphicon-trash"></span></button>
			<button class="btn btn-default GererJoueurs">Gérer Joueurs</button>
		</td>
	</tr>
	@endforeach

	<tr>
		<td><input class="form-control NewNom" name="NewNom" value=""></td> 
		<td><input class="form-control NewAdmin" name="NewAdmin" value=""></td> 
		<td><input class="form-control NewLigue" name="NewLigue" value=""></td>
		<td><button id="AjouterEquipe" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save"></span></button></td>
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

	//Sur le click du bouton ajouter, on ajoute l'équipe avec les infos données
	$('body').on('click', '#AjouterEquipe', function(){
		var tr = $(this).closest('tr');

		$.ajax({
			type: 'POST',
			url: "/api/equipes/edit",
			data: {
				name: $(this).closest('tr').find('.NewNom').val(),
				admin_id: $(this).closest('tr').find('.NewAdmin').val(),
				ligue_id: $(this).closest('tr').find('.NewLigue').val()
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

				$('table tr:last').prev().after('<tr id="' + data.equipe.id + '"><td><input class="form-control Nom" name="Nom" value="' + data.equipe.name + '"></td><td><input class="form-control Admin" name="Admin" value="' + data.equipe.admin_id + '"></td> <td><input class="form-control id_saison" name="id_saison" value="' + data.equipe.ligue_id + '"></td><td><button class="btn btn-danger EffacerEquipe"><span class="glyphicon glyphicon-trash"></span></button></td><button class="btn btn-default GererJoueurs">Gérer Joueurs</button></tr>').fadeIn(500);				

				$('table tr:last').find('.NewNom').val('');
				$('table tr:last').find('.NewAdmin').val('');
				$('table tr:last').find('.NewLigue').val('');
			}
			},
			error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, thrownError);
			} 	
		});
	});

	//Quand le focus est perdu sur un champ, on sauvegarde
	$('body').on('blur', '.Nom,.Admin,.Ligue', function(){

		var tr = $(this).closest('tr');
		$.ajax({
			type: "PUT",
			url: '/api/equipes/edit/' + $(this).closest('tr').attr('id'),
			data: { 
				id: $(this).closest('tr').attr('id'),
				name: $(this).closest('tr').find('.Nom').val(),
				admin_id: $(this).closest('tr').find('.Admin').val(),	
				ligue_id: $(this).closest('tr').find('.Ligue').val()
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
	$('body').on('click', '.EffacerEquipe', function(){

		$(this).closest('tr').remove();

		$.ajax({
			type: "DELETE",
			url: '/api/equipes/edit/' + $(this).closest('tr').attr('id'),
			success: function(data) {
				console.log(data);
			}
		});
	});
});
</script>
@endsection