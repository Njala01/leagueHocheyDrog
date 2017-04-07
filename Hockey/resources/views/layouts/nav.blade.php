<nav class="navbar navbar-default inline">
  <div style="margin:0 2%;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img style="width:15%; min-width: 15%; max-width: 15%"  src="NHL_LOGO.png" align="left"></img>
      <a class="navbar-brand" style="font:bold; font-size:3.5em; color:black; margin-left:-30px;" href="/">NHL</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Les Parties</a></li>
        <li><a href="#">Les Saisons</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NHL <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Voir les Équipes</a></li>
            <li><a href="#">Voir les joueurs</a></li>
            <li><a href="#">Voir les ligues</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Statistiques des parties</a></li>
            <li><a href="#">Statistiques des joueurs</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Rechercher">
        </div>
        <button type="submit" class="btn btn-default">Rechercher</button>
      </form>

      <ul class="nav navbar-nav navbar-right">

        @if(Auth::check())

          @if(Auth::user()->hasEditorRole())
            <li>
              <a href="/posts/create">Publier</a>
            </li>
          @endif

        @endif

        <li class="dropdown">

          @if(Auth::check() == false)
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Se connecter <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/register">Créer un compte</a></li>
              <li><a href="/login">Se connecter</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">À propos de Drugs and Hookers</a></li>
            </ul>
          @endif

          @if(Auth::check())

            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}<span class="caret"></span>
            </a>

            <ul class="dropdown-menu">
              <li><a href="#">Mon compte</a></li>

              @if(Auth::user()->hasAdminRole())
                <li><a href="/editer">Gérer les articles</a></li>
              @endif

              @if(Auth::user()->hasEditorRole())
                <li><a href="/editer/{{Auth::user()->id}}">Mes articles</a></li>
              @endif

              <li role="separator" class="divider"></li>

              <li><a href="/logout">Se déconnecter</a></li>

          @endif

        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>