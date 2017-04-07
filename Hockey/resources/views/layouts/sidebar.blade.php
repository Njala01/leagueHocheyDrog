
        <div class="col-md-4 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>À propos</h4>
            <p>Alain Paquette enseigne l'informatique au Cégep de Granby. Il est le créateur et l'administrateur de ce blog. Si vous désirez 
            participer à la rédaction d'articles sur Laravel, veuillez le contacter pour obtenir un droit d'édition.</p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">

            @foreach($archives as $archive)
              <li>
                <a href="/?month={{$archive['month']}}&year={{$archive['year']}}"> {{ $archive['month'] . ' ' . $archive['year'] }} </a>
              </li>
            @endforeach

            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Principaux contributeurs</h4>
            <ol class="list-unstyled">
              <li><a href="#">Editor 1</a></li>
              <li><a href="#">Editor 2</a></li>
              <li><a href="#">Editor 3</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->