@extends('layouts.masterNoSidebar')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modifier votre compte</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Demander un rôle</label>
                            <div class="col-md-6">
                                <select class="form-control role">
                                <option value="">Sélectionner</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button id="submit" type="submit" class="btn btn-primary">
                                    Poursuivre
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('body').on('click', '#submit', function()
    {
        if({{Auth::check()}})
        {
            var user = {{Auth::user()->id}};
            $.ajax({
                type: "POST",
                url: '/api/auth/role/' + user,
                data: { 
                role: $(".role").val()
            },
                success: function(data) {
                    console.log(data);
                }
            });
        }
    });
});
</script>
@endsection
