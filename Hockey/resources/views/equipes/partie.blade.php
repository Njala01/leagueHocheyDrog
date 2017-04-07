          <div class="partie">
            <h2 class="partie-title">
            <a href="/partie/{{$partie->id}}">
              {{ $partie->titre }}
            </a>
            </h2>
            <p class="blog-post-meta"> 
            	{{ $partie->lieu}} à
            	{{ $partie->date->toFormattedDateString()}} 
            </p>

            {{ $partie->body }}

          </div><!-- /.blog-post -->