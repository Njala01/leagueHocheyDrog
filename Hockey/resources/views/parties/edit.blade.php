@extends ('layouts.master')

@section('content')

<h3>Les parties<h3>

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
		<td><input class="form-control local_team" name="local_team" value="{{$partie->local_team}}"></td> 
		<td><input class="form-control visitor_team" name="visitor_team" value="{{$partie->visitor_team}}"></td> 
		<td><input class="form-control id_saison" name="id_saison" value="{{$partie->id_saison}}"></td> 
		<td><input class="form-control titre" name="titre" value="{{$partie->titre}}"></td> 
		<td><input class="form-control lieu" name="lieu" value="{{$partie->lieu}}"></td> 
		<td><input class="form-control date" name="date" value="{{$partie->date}}"></td>
		<td><button class="btn btn-danger EffacerPartie"><span class="glyphicon glyphicon-trash"></span></button></td>
	</tr>
	@endforeach

	<tr>
		<td><input class="form-control NEWlocal_team" name="NEWlocal_team" value=""></td> 
		<td><input class="form-control NEWvisitor_team" name="NEWvisitor_team" value=""></td> 
		<td><input class="form-control NEWid_saison" name="NEWid_saison" value=""></td>
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

	$('body').on('click', '#AjouterPartie', function(){

		var tr = $(this).closest('tr');

		$.ajax({
			type: 'POST',
			url: "/parties/edit",
			data: {
				local_team: $(this).closest('tr').find('.NEWlocal_team').val(),
				visitor_team: $(this).closest('tr').find('.NEWvisitor_team').val(),
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

				if(data.success === false) 
				{
					tr.addClass('danger');

					var errorString;

					$.each(data, function() {
						$.each(this, function(key, value) {
							errorString += '\n' + key + ': ' + value;
						});
					});
					
					alert(errorString);

				} else 
				{
					tr.removeClass('danger');

				$('table tr:last').prev().after('<tr id="' + data.p.id + '"><td><input class="form-control local_team" name="local_team" value="' + data.p.local_team + '"></td><td><input class="form-control visitor_team" name="visitor_team" value="' + data.p.visitor_team + '"></td> <td><input class="form-control id_saison" name="id_saison" value="' + data.p.id_saison + '"></td><td><input class="form-control" id="titre" name="titre" value="' + data.p.titre + '"></td><td><input class="form-control" id="lieu" name="lieu" value="' + data.p.lieu + '"></td><td><input class="form-control" id="date" name="date" value="' + data.p.date + '"></td><td><button class="btn btn-danger EffacerPartie"><span class="glyphicon glyphicon-trash"></span></button></td></tr>').fadeIn(500);				

				$('table tr:last').find('.NEWlocal_team').val('');
				$('table tr:last').find('.NEWvisitor_team').val('');
				$('table tr:last').find('.NEWid_saison').val('');
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
			url: '/parties/edit/' + $(this).closest('tr').attr('id'),
			data: { 
				id: $(this).closest('tr').attr('id'),
				local_team: $(this).closest('tr').find('.local_team').val(),
				visitor_team: $(this).closest('tr').find('.visitor_team').val(),	
				id_saison: $(this).closest('tr').find('.id_saison').val(),
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

					$.each(data, function() {
						$.each(this, function(key, value) {
							alert(key + ': ' + value);
						});
					});
				} else 
				{
					tr.removeClass('danger');
				}
			}
		});
	});

	$('body').on('click', '.EffacerPartie', function(){

		//cacher car on ne peut pas enlever
		$(this).closest('tr').remove();

		$.ajax({
			type: "DELETE",
			url: '/parties/edit/' + $(this).closest('tr').attr('id'),
			success: function(data) {
				console.log(data);
			}
		});
	});
});
</script>
          @endsection
