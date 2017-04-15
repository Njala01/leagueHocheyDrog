@extends ('layouts.master')

@section('content')

<h3>Les parties<h3>

<table class="table table-responsive table-striped">
	<tr>
		<th>Saison</th>
		<th>Titre</th>
		<th>Lieu</th>
		<th>Date</th>
		<th></th>
          @foreach ($parties as $partie)
          <tr id="{{$partie->id}}">
            <td><input class="form-control id_saison" name="saison_id" value="{{$partie->id_saison}}"></td> 
            <td><input class="form-control titre" name="titre" value="{{$partie->titre}}"></td> 
            <td><input class="form-control lieu" name="lieu" value="{{$partie->lieu}}"></td> 
			<td><input class="form-control date" name="date" value="{{$partie->date}}"></td>
			<td><button class="btn btn-danger EffacerPartie">Effacer</button></td>
			</tr>
          @endforeach

          <tr>
          	<td><input class="form-control NEWid_saison" name="NEWid_saison" value=""></td>
          	<td><input class="form-control NEWtitre" name="NEWtitre" value=""></td>
          	<td><input class="form-control NEWlieu" name="NEWlieu" value=""></td>
          	<td><input class="form-control NEWdate" name="NEWdate" value=""></td>
          	<td><button id="AjouterPartie" class="btn btn-default">Ajouter une partie</button></td>
          	</tr>

</table>
          
@endsection

@section('scripts')
<script>
$(document).ready(function() {

	$('body').on('click', '#AjouterPartie', function(){

		$.ajax({
			type: 'POST',
			url: "/parties/edit",
			data: {
			id_saison: $(this).closest('tr').find('.NEWid_saison').val(),
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

				$('table tr:last').prev().after('<tr id="' + data.p.id + '"><td><input class="form-control" id="id_saison" name="id_saison" value="' + data.p.id_saison + '"></td><td><input class="form-control" id="titre" name="titre" value="' + data.p.titre + '"></td><td><input class="form-control" id="lieu" name="lieu" value="' + data.p.lieu + '"></td><td><input class="form-control" id="date" name="date" value="' + data.p.date + '"></td><td><button class="btn btn-danger EffacerPartie">Effacer</button></td></tr>');

				$('table tr:last').find('.NEWid_saison').val('');
				$('table tr:last').find('.NEWtitre').val('');
				$('table tr:last').find('.NEWlieu').val('');
				$('table tr:last').find('.NEWdate').val('');
			},
			error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, thrownError);
			} 	
		});
	});

	$('body').on('blur', '.saison_id,.titre,.lieu,.date', function(){

		$.ajax({
			type: "PUT",
			url: '/parties/edit',
			data: { 
				id: $(this).closest('tr').attr('id'),	
				id_saison: $(this).closest('tr').find('.id_saison').val(),
				titre: $(this).closest('tr').find('.titre').val(),
				lieu: $(this).closest('tr').find('.lieu').val(),
				date: $(this).closest('tr').find('.date').val()
			},
			success: function(data) {
				console.log(data);
			}
		});
	});

	$('body').on('click', '.EffacerPartie', function(){

		$.ajax({
			type: "DELETE",
			url: '/parties/edit',
			data: { 
				id: $(this).closest('tr').attr('id')
			},
			success: function(data) {
				console.log(data);
			}
		});
	});
});
</script>
          @endsection
