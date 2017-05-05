@extends ('layouts.master')

@section('content')

<h3>Les ligues</h3>

<table class="table table-striped table-bordered">
	<tr>
		<th>Nom</th>
		<th>Catégorie</th>
		<th></th>
	</tr>
	@foreach ($ligues as $ligue)
	<tr id="{{$ligue->id}}">
		<td><input class="form-control Nom" name="Nom" value="{{$ligue->name}}"></td> 
		<td><input class="form-control Category" name="Category" value="{{$ligue->category}}"></td> 
		<td style="min-width:180px;">
			<button class="btn btn-danger EffacerLigue"><span class="glyphicon glyphicon-trash"></span></button>
			<button class="btn btn-default GererEquipes">Gérer Équipes</button>
		</td>
	</tr>
	@endforeach

	<tr>
		<td><input class="form-control NewNom" name="NewNom" value=""></td> 
		<td><input class="form-control NewCategory" name="NewCategory" value=""></td>
		<td><button id="AjouterLigue" class="btn btn-default"><span class="glyphicon glyphicon-floppy-save"></span></button></td>
	 </tr>

</table>
          
@endsection

@section('scripts')
<script>
$(document).ready(function() {

	//Sur le click du bouton ajouter, on ajoute l'équipe avec les infos données
	$('body').on('click', '#AjouterLigue', function(){
		var tr = $(this).closest('tr');

		$.ajax({
			type: 'POST',
			url: "/api/ligues/edit",
			data: {
				name: $(this).closest('tr').find('.NewNom').val(),
				category: $(this).closest('tr').find('.NewCategory').val()
	      	},
			dataType: 'json',
			beforeSend: function (xhr) {
		        var token = $('meta[name="_token"]').attr('content');

		        if (token) 
		        {
		            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	        	}
			},
			complete: function(data) {
				console.log(data.responseText.ligue);

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

				$('table tr:last').prev().after('<tr id="' + data.ligue.id + '"><td><input class="form-control Nom" name="Nom" value="' + data.ligue.name + '"></td><td><input class="form-control Category" name="Category" value="' + data.ligue.category + '"></td><td><button class="btn btn-danger EffacerLigue"><span class="glyphicon glyphicon-trash"></span></button><button class="btn btn-default GererEquipes">Gérer Équipes</button></td></tr>').fadeIn(500);				

				$('table tr:last').find('.NewNom').val('');
				$('table tr:last').find('.NewCategory').val('');
			}
			},
			error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, thrownError);
			} 	
		});
	});

	//Quand le focus est perdu sur un champ, on sauvegarde
	$('body').on('blur', '.Nom,.Category', function(){

		var tr = $(this).closest('tr');
		$.ajax({
			type: "PUT",
			url: '/api/ligues/edit/' + $(this).closest('tr').attr('id'),
			data: { 
				id: $(this).closest('tr').attr('id'),
				name: $(this).closest('tr').find('.NewNom').val(),
				category: $(this).closest('tr').find('.NewCategory').val(),
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
	$('body').on('click', '.EffacerLigues', function(){

		$(this).closest('tr').remove();

		$.ajax({
			type: "DELETE",
			url: '/api/ligues/edit/' + $(this).closest('tr').attr('id'),
			success: function(data) {
				console.log(data);
			}
		});
	});
});
</script>
@endsection