@extends ('layouts.master')

@section('content')

<h3>Les Saisons</h3>

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
		<td><select class="form-control Ligue">
		@foreach ($ligues as $ligue)
		@if($ligue->id === $saison->ligue_id)
		<option selected="true" value="{{$ligue->id}}">{{$ligue->name}}</option>
		@else
		<option value="{{$ligue->id}}">{{$ligue->name}}</option>
		@endif
		@endforeach
		</select></td> 
		<td><input class="form-control Debut" name="Debut" value="{{$saison->start_date}}"></td>
		<td><input class="form-control Fin" name="Fin" value="{{$saison->end_date}}"></td>
		<td style="min-width:190px;"><button class="btn btn-danger EffacerSaison"><span class="glyphicon glyphicon-trash"></span></button>
		<button class="btn btn-default GererParties">Gérer Parties</button></td>
	</tr>
	@endforeach

	<tr>
		<td><input class="form-control NewNom" name="NewNom" value=""></td> 
		<td><select class="form-control NewLigue">
		@foreach ($ligues as $ligue)
		<option value="{{$ligue->id}}">{{$ligue->name}}</option>
		@endforeach
		</select></td>	
		<td><input class="form-control NewDebut" name="NewDebut" value=""></td>
		<td><input class="form-control NewFin" name="NewFin" value=""></td> 
		<td><button id="AjouterSaison" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save"></span></button></td>
	 </tr>

</table>
          
@endsection

@section('scripts')
<script>
$(document).ready(function() {

	$('body').on('click', '.GererParties', function(){
		var tr = $(this).closest('tr').attr('id');
		window.location.href = '/saisons/'+tr+'/parties/edit'
	});

	//Sur le click du bouton ajouter, on ajoute l'équipe avec les infos données
	$('body').on('click', '#AjouterSaison', function(){
		var tr = $(this).closest('tr');
		var test = $(this).closest('tr').find('.NewLigue').val();

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
					var listeString = '<select class="form-control Ligue">';
					$.each(data.ligues, function(index, element)
					{

						if(element.id == data.saison.ligue_id)
						{
							listeString += '<option value="' + element.id + '" selected="true">' + element.name + '</option>';
						} else 
						{
							listeString += '<option value="' + element.id + '">' + element.name + '</option>';
						}
					});
					listeString += '</select>'

				$('table tr:last').prev().after('<tr id="' + data.saison.id + '"><td><input class="form-control Nom" name="Nom" value="' + data.saison.name + '"></td><td>' + listeString + '</td><td><input class="form-control Debut" name="Debut" value="' + data.saison.start_date + '"></td><td><input class="form-control Fin" name="Fin" value="' + data.saison.end_date + '"></td><td><button class="btn btn-danger EffacerSaison"><span class="glyphicon glyphicon-trash"></span></button><button class="btn btn-default GererParties">Gérer Parties</button></td></tr>').fadeIn(500);				

				$('table tr:last').find('.NewNom').val('');
				$('table tr:last').find('.NewLigue').val('1');
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
		});
	});

	//Quand le bouton supprimer est appuyé, on effface la donnée
	$('body').on('click', '.EffacerSaison', function(){
		$(this).closest('tr').remove();
		
		//$.ajaxSetup({async:false}); //ne pas effacer quand ce n'est pas un success
		$.ajax({
			type: "DELETE",
			url: '/api/saisons/edit/' + $(this).closest('tr').attr('id'),
			success: function(data) {
				console.log(data);
			}
		});
		//$.ajaxSetup({async:true});
	});
});
</script>
@endsection