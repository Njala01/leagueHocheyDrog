@extends ('layouts.master')

@section('content')

<h3>Marquer une partie</h3>

<input hidden="hidden" id="idPartie" value="{{$id}}"/>

<button class="btn btn-default AjouterBut">Ajouter un but</button>
<button class="btn btn-default AjouterPenalite">Ajouter une pénalité</button>
<button class="btn btn-default TerminerPartie">Terminer la partie</button>

<div style="display: none;" id="EquipeDiv">
<h4>Quelle équipe?</h4>
<select class="form-control Equipe">
<option value="">Sélectionner</option>
<option value="{{$local->id}}">{{$local->name}}</option>
<option value="{{$visitor->id}}">{{$visitor->name}}</option>
</select>
</div>

<div style="display: none;" id="LocalDiv">
<h4>Quel joueur?</h4>
<select class="form-control local_team">
<option value="">Sélectionner</option>
@foreach ($local->joueurs as $joueur)
<option value="{{$joueur->id}}">{{$joueur->name}}</option>
@endforeach
</select>
<input type="checkbox" class="Assist">Assistance par un autre joueur?</input>
<br/>
</div>

<div style="display: none;" id="VisitorDiv">
<h4>Quel joueur?</h4>
<select class="form-control visitor_team">
<option value="">Sélectionner</option>
@foreach ($visitor->joueurs as $joueur)
<option value="{{$joueur->id}}">{{$joueur->name}}</option>
@endforeach
</select>
<input type="checkbox" class="Assist">Assistance par un autre joueur?</input>
<br/>
</div>

<div style="display: none;" id="AssistLocalDiv">
<h4>Quel autre joueur?</h4>
<select class="form-control AssistLocal_team">
<option value="">Sélectionner</option>
@foreach ($local->joueurs as $joueur)
<option value="{{$joueur->id}}">{{$joueur->name}}</option>
@endforeach
</select>
<br/>
</div>

<div style="display: none;" id="AssistVisitorDiv">
<h4>Quel autre joueur?</h4>
<select class="form-control AssistVisitor_team">
<option value="">Sélectionner</option>
@foreach ($visitor->joueurs as $joueur)
<option value="{{$joueur->id}}">{{$joueur->name}}</option>
@endforeach
</select>
<br/>
</div>

<button class="btn btn-primary AjouterButSubmit" style="display: none;">Enregistrer le but</button>
          
@endsection

@section('scripts')
<script>
$(document).ready(function() {

	//Lorsque le bouton ajouterBut est appuyé, on demande l'équipe
	$('body').on('click', '.AjouterBut', function()
	{
		$("#EquipeDiv").css('display', 'inline');
	});

	//Lorsque qu'un équipe est sélectionné, on affiche les joueurs
	$('body').on('change', '.Equipe', function()
	{
		if($('.Equipe').val() == {{$local->id}})
		{
			$("#VisitorDiv").css('display', 'none');
			$("#LocalDiv").css('display', 'inline');
		} else if($('.Equipe').val() == {{$visitor->id}})
		{
			$("#LocalDiv").css('display', 'none');
			$("#VisitorDiv").css('display', 'inline');
		} else 
		{
			$("#VisitorDiv").css('display', 'none');
			$("#LocalDiv").css('display', 'none');
		}
	});

	//Si on coche assistance par un autre joueur
	$('body').on('change', '.Assist', function()
	{
		if($('.Assist').is(':checked'))
		{
			if($('.Equipe').val() == {{$local->id}})
			{
				$("#AssistVisitorDiv").css('display', 'none');
				$("#AssistLocalDiv").css('display', 'inline');
			} else 
			{
				$("#AssistLocalDiv").css('display', 'none');
				$("#AssistVisitorDiv").css('display', 'inline');
			}
		} else 
		{
			$("#AssistLocalDiv").css('display', 'none');
			$("#AssistVisitorDiv").css('display', 'none');
		}
	});

	//Lorsque qu'un joueur est sélectionné, on affiche les joueurs
	$('body').on('change', '.local_team,.visitor_team', function()
	{
		$(".AjouterButSubmit").css('display', 'inline');
	});

	//Lorsque qu'on appuie sur ajouter un but, on ajoute le but pour l'équipe, le joueur, les points et l'assist au besoin
	$('body').on('click', '.AjouterButSubmit', function()
	{
		var equipe = $('.Equipe').val();
		var joueurBut = "";
		var joueurAssist = "";
			if($('.Equipe').val() == {{$local->id}})
			{
				joueurBut = $('.local_team').val();
				if($('.Assist').is(':checked'))
				{
			 	joueurAssist = $('.AssistLocal_team').val();
			 	}	
			} else 
			{
				joueurBut = $('.visitor_team').val();
				if($('.Assist').is(':checked'))
				{
				joueurAssist = $('.AssistVisitor_team').val();
				}
			}

			console.log(equipe, joueurBut, joueurAssist);

		$.ajax({
			type: "PUT",
			url: '/api/parties/marquerUnePartie/but/' + $('#idPartie').val(),
			data: {
				equipe: equipe,
				joueurBut: joueurBut,
				joueurAssist: joueurAssist
			},
			success: function(data) {
				console.log(data);
				$("#VisitorDiv").css('display', 'none');
				$("#LocalDiv").css('display', 'none');
				$("#AssistLocalDiv").css('display', 'none');
				$("#AssistVisitorDiv").css('display', 'none');
			}
		});
	});

	//Lorsque qu'on click sur terminer la partie, la partie se termine et enregistre le vainqueur/perdant, etc.
	$('body').on('click', '.TerminerPartie', function()
	{
		$.ajax({
			type: "PUT",
			url: '/api/parties/marquerUnePartie/terminer/' + $('#idPartie').val(),
			success: function(data) {
				console.log(data);
				window.location.replace("/saisons");
			},
			error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr, thrownError);
			} 
		});

	});

});
</script>
@endsection